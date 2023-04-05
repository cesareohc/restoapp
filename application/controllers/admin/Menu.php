<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller {

	public function __construct(){
		parent::__construct();
		is_login();
		check_valid_user();
	}

	
	/**
	  ** Items
	**/
	public function item()
	{
		$data = array();
		$data['page_title'] = "Items";
        $data['page'] = "Menu";
        $data['data'] = false;
        $data['all_items'] = $this->admin_m->get_all_items('0');
        $data['allergens'] = $this->admin_m->select('allergens');
        $data['menu_type'] = $this->admin_m->select_all_by_user_by_order('menu_type');
		$data['main_content'] = $this->load->view('backend/menu/items', $data, TRUE);
		$this->load->view('backend/index',$data);
	}


	public function item_list($id)
	{
		$data = array();
		$data['page_title'] = "Items";
        $data['page'] = "Menu";
        $data['data'] = false;
        $data['all_items'] = $this->admin_m->get_all_items($id);
		$data['main_content'] = $this->load->view('backend/menu/item_list', $data, TRUE);
		$this->load->view('backend/index',$data);
	}


	public function create_item()
	{
		$data = array();
		$data['page_title'] = "Items";
        $data['page'] = "Menu";
        $data['data'] = false;
        $data['allergens'] = $this->admin_m->select('allergens');
        $data['menu_type'] = $this->admin_m->select_all_by_user_by_order('menu_type');
		$data['main_content'] = $this->load->view('backend/menu/create_items', $data, TRUE);
		$this->load->view('backend/index',$data);
	}


	/**
	  ** edit about
	**/

	public function edit_item($id)
	{
		$data = array();
		$data['page_title'] = "Items";
        $data['page'] = "Menu";
        $data['data_type'] = false;
        $data['data'] =$this->admin_m->single_select_by_auth_id($id,'items');
        $data['allergens'] = $this->admin_m->select('allergens');
        $data['extras'] = $this->admin_m->get_extras($id,restaurant()->id);
        $data['extras_libraries'] = $this->admin_m->select_all_by_shop(restaurant()->id,'extra_libraries');

        if(empty($data['data'])):
	        valid_user($data['data']['user_id']);
	    endif;
	    $data['menu_type'] = $this->admin_m->select_all_by_user_by_order('menu_type');
		$data['main_content'] = $this->load->view('backend/menu/create_items', $data, TRUE);
		$this->load->view('backend/index',$data);
	}

		/**
	  *** add items
	**/ 
	public function add_items(){
		is_test();
		$is_size_check = $this->input->post('is_size',true);
		$img_type = $this->input->post('img_type',true);
		$this->form_validation->set_rules('cat_id', 'Category', 'trim|required|xss_clean');
		$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('overview', 'Small Description', 'trim|xss_clean');
		$this->form_validation->set_rules('veg_type', 'Veg Type', 'trim|xss_clean');
		$this->form_validation->set_rules('allergen_id[]', 'Allergen', 'trim|xss_clean');
		$this->form_validation->set_rules('in_stock', 'In stock', 'trim|xss_clean');
		if($img_type==2){
			$this->form_validation->set_rules('img_url', 'Image URL', 'trim|xss_clean|required');
		}
		if(!isset($is_size_check)):
			$this->form_validation->set_rules('price', 'Price', 'required|trim|callback_number_check|xss_clean');
		endif;
		$this->form_validation->set_rules('details', 'Details', 'trim');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			$this->create_item();
			}else{	
				$id = $this->input->post('id');
				if($id==0):
					$total = $this->admin_m->check_limit_by_table('items');
		        	$limit = limit(auth('id'),1);
		        	if($limit !=0){
		        		$total_up = $total+1;

		        		if($total_up > $limit){
		        			$check =0;
		        			$this->session->set_flashdata('error', 'Sorry You Uploaded maximum Items');
		        			redirect(base_url('admin/menu/item'));
		        			exit();
		        		}else if($total > $limit){
		        			$check =0;
		        			$this->session->set_flashdata('error', 'Sorry You reached the maximum limit');
		        			redirect(base_url('admin/menu/item'));
		        			exit();
		        		}else{
		        			$check =1;
		        		}
		        		
		        	}else{
		        		$check = 1; // for unlimited
	        		}
        	else:
        		$check = 1;
        	endif;

        	if($check==1):

				$veg_type = $this->input->post('veg_type',true);
				
				if(isset($is_size_check) && $is_size_check==1):
					$is_size=1;
					$item_size=[];
					if(isset($_POST['is_price']) && !empty($_POST['is_price'])){
						foreach ($_POST['is_price'] as $key => $p) {
							$slug = $_POST['slug'][$key];
								$items = array(
									$slug => $p 
								);
								$item_size += $items;
						}
					}
					$price = json_encode($item_size);
				else:
					$is_size=0;
					$price = $this->input->post('price',true);
				endif;
				$is_feature = $this->input->post('is_features');
				$cat_id = $this->input->post('cat_id',true);
				$data = array(
					'cat_id' => $cat_id,
					'title' => $this->input->post('title',true),
					'allergen_id' => json_encode($this->input->post('allergen_id[]')),
					'veg_type' => isset($veg_type) && !empty($veg_type)?$veg_type:0,
					'user_id' => auth('id'),
					'shop_id' => restaurant()->id,
					'overview' => $this->input->post('overview'),
					'details' => $this->input->post('details'),
					'orders' => $this->input->post('orders'),
					'tax_fee' => $this->input->post('tax_fee',true),
					'tax_status' => $this->input->post('tax_status',true),
					'in_stock' => !empty($this->input->post('in_stock'))?$this->input->post('in_stock'):0,
					'is_features' => isset($is_feature)?1:0,
					'price' => $price,
					'img_type' => $img_type,
					'img_url' => $this->input->post('img_url',true),
					'is_size' => $is_size,
					'created_at' => d_time(),
				);


				$is_copy_extras = $this->input->post('is_copy_extra');
				$is_copy = $this->input->post('is_copy');

				if(isset($is_copy) && $is_copy==1){
					$insert = $this->admin_m->insert($data,'items');
					if($img_type==1):
						$img_data = array(
							'images' => $this->input->post('images'),
							'thumb' => $this->input->post('thumb'),
						);

						$this->admin_m->update($img_data,$insert,'items');
					endif;

				}else{
					if($id==0){
						$insert = $this->admin_m->insert($data,'items');
					}else{
						$insert = $this->admin_m->update($data,$id,'items');
					}

				}

				

				if($insert){
					$ex_data = [];
					if(isset($is_copy_extras) && $is_copy_extras==1){
						$item_extras = $this->admin_m->get_extras($id,restaurant()->id);

						$order_list_arr = ['item_id'=>$insert];
						foreach ($item_extras as $key => $value) {
							$parray = array_merge($value,$order_list_arr);
							array_splice($parray, 0, 1);
							$ex_data[] = $parray;
						}
						 $this->admin_m->insert_all($ex_data,'item_extras');

					}


					$this->upload_m->upload_img($insert,'items');
					$this->session->set_flashdata('success', !empty(lang('success_text'))?lang('success_text'):'Save Change Successful');
					redirect(base_url('admin/menu/item_list/'.$cat_id));
				}else{
					$this->session->set_flashdata('error', !empty(lang('error_text'))?lang('error_text'):'Somethings Were Wrong!!');
					redirect(base_url('admin/menu/item_list/'.$cat_id));
				}	
			endif; //end check
		}
	}


	public function add_images($id){

		if(!empty($_FILES['file']['name'])){
			$up_load = $this->upload_m->upload(400);
			if($up_load['st']==1):
				$old = single_select_by_id($id,'items');
				if(!empty($old['extra_images'])){
					$images = json_encode(array_merge(json_decode($old['extra_images'], true),$up_load['data']));
				}else{
					$images = json_encode($up_load['data']);
				};
				$this->admin_m->update(['extra_images'=>$images],$id,'items');
			else:
				echo json_encode(['st'=>0,'msg'=>$up_load['data']['error']]);
			endif;
			echo json_encode(['st'=>1]);
		}else{
			echo json_encode(['st'=>0]);
		}

	}


	public function delete_extra_img($id){
		if(isset($_GET['img'])){
			$old = single_select_by_id($id,'items');
			$old_img = json_decode($old['extra_images'],TRUE);
			$getImg = $old_img[$_GET['img']];
			
			delete_image_from_server($getImg['thumb']);
			delete_image_from_server($getImg['image']);

			unset($old_img[$_GET['img']]);
			$this->admin_m->update(['extra_images'=>json_encode($old_img)],$id,'items');
			redirect($_SERVER['HTTP_REFERER']);
		}

	}


	public function add_extras(){

		$this->form_validation->set_rules('ex_name', 'name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ex_price', 'Price', 'trim|required|xss_clean|callback_number_check');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect($_SERVER['HTTP_REFERER']);
			}else{	
				$id = $this->input->post('ex_id',true);
				
				$data = array(
					'item_id' => $this->input->post('item_id',true),
					'user_id' => auth('id'),
					'shop_id' => restaurant()->id,
					'ex_name' => $this->input->post('ex_name'),
					'ex_price' => $this->input->post('ex_price'),
				);
				if($id==0){
					$insert = $this->admin_m->insert($data,'item_extras');
				}else{
					$insert = $this->admin_m->update($data,$id,'item_extras');
				}

				if($insert){
					$this->session->set_flashdata('success', !empty(lang('success_text'))?lang('success_text'):'Save Change Successful');
					redirect($_SERVER['HTTP_REFERER']);
				}else{
					$this->session->set_flashdata('error', !empty(lang('error_text'))?lang('error_text'):'Somethings Were Wrong!!');
					redirect($_SERVER['HTTP_REFERER']);
				}	
		}
	}

	public function delete_extra($id)
	{
		$del=$this->admin_m->item_delete($id,'item_extras');
		if($del){
			$this->session->set_flashdata('success', lang('delete_success'));
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$this->session->set_flashdata('error', !empty(lang('error_text'))?lang('error_text'):'Somethings Were Wrong!!');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function category()
	{
		$data = array();
		$data['page_title'] = "Category";
        $data['page'] = "Menu";
        $data['is_create'] = false;
        $data['is_size'] = TRUE;
        $data['data'] = false;
        $data['allergens'] = $this->admin_m->select_all_by_user('allergens');
        $data['menu_type'] = $this->admin_m->select_all_by_user_by_order('menu_type');
        $data['sizes'] = $this->admin_m->select_all_by_user('item_sizes');
		$data['main_content'] = $this->load->view('backend/menu/category', $data, TRUE);
		$this->load->view('backend/index',$data);
	}

	public function create_category()
	{
		$data = array();
		$data['page_title'] = "Category";
        $data['page'] = "Menu";
        $data['is_create'] = true;
        $data['is_size'] = False;
        $data['data'] = false;
        $data['allergens'] = $this->admin_m->select_all_by_user('allergens');
        $data['menu_type'] = $this->admin_m->select_all_by_user_by_order('menu_type');
        $data['sizes'] = $this->admin_m->select_all_by_user('item_sizes');
		$data['main_content'] = $this->load->view('backend/menu/category', $data, TRUE);
		$this->load->view('backend/index',$data);
	}

	
	public function edit_category($id)
	{
		$data = array();
		$data['page_title'] = "Category";
		$data['is_create'] = true;
        $data['is_size'] = False;
        $data['page'] = "Menu";
        $data['data'] = $this->admin_m->single_select_by_auth_id($id,'menu_type');
        $data['menu_type'] = $this->admin_m->select_all_by_user_by_order('menu_type');
        if(empty($data['data'])):
	        valid_user($data['data']['user_id']);
	    endif;
		$data['main_content'] = $this->load->view('backend/menu/category', $data, TRUE);
		$this->load->view('backend/index',$data);
	}

	/**
	  *** add_portfolio_type
	**/ 
	public function add_category(){
		is_test();
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url('admin/menu/category'));
		}else{	
			$data = array(
				'name' => $this->input->post('name',true),
				'type' => $this->input->post('type',true),
				'details' => $this->input->post('details',true),
				'orders' => $this->input->post('orders',true),
				'user_id' => auth('id'),
				'created_at' => d_time(),
			);
			$id = $this->input->post('id');
			if($id==0){
				$insert = $this->admin_m->insert($data,'menu_type');
			}else{
				$insert = $this->admin_m->update($data,$id,'menu_type');
			}

			if($insert){
				$this->upload_m->upload_img($insert,'menu_type');
				$this->session->set_flashdata('success', !empty(lang('success_text'))?lang('success_text'):'Save Change Successful');
				redirect(base_url('admin/menu/category'));
			}else{
				$this->session->set_flashdata('error', !empty(lang('error_text'))?lang('error_text'):'Somethings Were Wrong!!');
				redirect(base_url('admin/menu/category'));
			}	
		}
	}


	public function specialties()
	{
		$data = array();
		$data['page_title'] = "Specialties";
        $data['page'] = "Menu";
        $data['data'] = false;
        $data['specialties'] = $this->admin_m->get_admin_specilities();
		$data['main_content'] = $this->load->view('backend/menu/specialties', $data, TRUE);
		$this->load->view('backend/index',$data);
	}

	
	public function edit_specialties($id)
	{
		$data = array();
		$data['page_title'] = "Specialties";
        $data['page'] = "Menu";
        $data['data'] = $this->admin_m->single_select_by_auth_id($id,'item_packages');
        $data['specialties'] = $this->admin_m->get_admin_specilities();
        if(empty($data['data'])):
	        valid_user($data['data']['user_id']);
	    endif;
		$data['main_content'] = $this->load->view('backend/menu/specialties', $data, TRUE);
		$this->load->view('backend/index',$data);
	}

	/**
	  *** add_portfolio_type
	**/ 
	public function add_specialties(){
		is_test();
		$is_discount = $this->input->post('is_discount',TRUE);
		$price = $this->input->post('price',TRUE);
		$is_home = $this->input->post('is_home',TRUE);
		$this->form_validation->set_rules('package_name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('overview', 'Overview', 'trim|required|xss_clean');
		$this->form_validation->set_rules('in_stock', 'Set stock', 'trim|xss_clean');
		$this->form_validation->set_rules('price', 'Price', 'required|trim|callback_number_check|xss_clean');
		if(isset($is_discount) && $is_discount==1){
			$this->form_validation->set_rules('discount', 'Discount %', 'trim|required|xss_clean');
			$discount_price = $this->input->post('discount',TRUE);
			$final_price = $price - ($discount_price/100)*$price;
			$is_discount = $is_discount;
		}else{
			$discount_price = 0;
			$is_discount = 0;
			$final_price = $price;
		}

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url('admin/menu/specialties'));
		}else{	
			$data = array(
				'package_name' => $this->input->post('package_name',TRUE),
				'price' => $this->input->post('price',TRUE),
				'details' => $this->input->post('details'),
				'overview' => $this->input->post('overview',TRUE),
				'in_stock' => !empty($this->input->post('in_stock'))?$this->input->post('in_stock'):0,
				'final_price' => $final_price,
				'discount' => $discount_price,
				'is_discount' => $is_discount,
				'is_home' => isset($is_home)?1:0,
				'user_id' => auth('id'),
				'shop_id' => restaurant()->id,
				'is_special' => 1,
				'created_at' => d_time(),
			);
			$id = $this->input->post('id');
			if($id==0){
				$insert = $this->admin_m->insert($data,'item_packages');
			}else{
				$insert = $this->admin_m->update($data,$id,'item_packages');
			}

			if($insert){
				$this->upload_m->upload_img($insert,'item_packages');
				$this->session->set_flashdata('success', !empty(lang('success_text'))?lang('success_text'):'Save Change Successful');
				redirect(base_url('admin/menu/specialties'));
			}else{
				$this->session->set_flashdata('error', !empty(lang('error_text'))?lang('error_text'):'Somethings Were Wrong!!');
				redirect(base_url('admin/menu/specialties'));
			}	
		}
	}




	public function number_check($val)
    {
        if (!preg_match('/^[0-9]+(\\.[0-9]+)?$/', $val)) {
            $this->form_validation->set_message('number_check', 'The {field} field must be a number or decimal.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
	public function allergens()
	{
		$data = array();
		$data['page_title'] = "Allergens";
        $data['page'] = "Menu";
        $data['data'] = false;
        $data['allergens'] = $this->admin_m->select('allergens');
		$data['main_content'] = $this->load->view('backend/menu/allergens', $data, TRUE);
		$this->load->view('backend/index',$data);
	}

	public function edit_allergen($id)
	{
		$data = array();
		$data['page_title'] = "Allergens";
        $data['page'] = "Menu";
        $data['data'] = $this->admin_m->single_select_by_id($id,'allergens');
        $data['allergens'] = $this->admin_m->select('allergens');
		$data['main_content'] = $this->load->view('backend/menu/allergens', $data, TRUE);
		$this->load->view('backend/index',$data);
	}
	
	/**
	  *** add allergen
	**/ 
	public function add_allergen(){
		is_test();
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url('admin/menu/allergens'));
			}else{	
				$data = array(
					'name' => $this->input->post('name',TRUE),
					'user_id' => auth('id'),
					'created_at' => d_time(),
				);
				$id = $this->input->post('id');
				if($id==0){
					$insert = $this->admin_m->insert($data,'allergens');
				}else{
					$insert = $this->admin_m->update($data,$id,'allergens');
				}

				if($insert){
					$this->upload_m->upload_img($insert,'allergens');
					$this->session->set_flashdata('success', !empty(lang('success_text'))?lang('success_text'):'Save Change Successful');
					redirect(base_url('admin/menu/allergens'));
				}else{
					$this->session->set_flashdata('error', !empty(lang('error_text'))?lang('error_text'):'Somethings Were Wrong!!');
					redirect(base_url('admin/menu/allergens'));
				}	
		}
	}



	public function extras()
	{
		$data = array();
		$data['page_title'] = "Extras";
        $data['page'] = "Menu";
        $data['data'] = false;
        $data['extra_lists'] = $this->admin_m->select_all_by_user('extra_libraries');
		$data['main_content'] = $this->load->view('backend/menu/extra_list', $data, TRUE);
		$this->load->view('backend/index',$data);
	}

	public function edit_extras($id)
	{
		$data = array();
		$data['page_title'] = "Extras";
        $data['page'] = "Menu";
        $data['data'] = $this->admin_m->single_select_by_id($id,'extra_libraries');
        $data['extra_lists'] = $this->admin_m->select_all_by_user('extra_libraries');
		$data['main_content'] = $this->load->view('backend/menu/extra_list', $data, TRUE);
		$this->load->view('backend/index',$data);
	}
	
	/**
	  *** add allergen
	**/ 
	public function add_extra_list(){
		is_test();
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('price', 'price', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url('admin/menu/allergens'));
			}else{	
				$data = array(
					'name' => $this->input->post('name',TRUE),
					'price' => $this->input->post('price',TRUE),
					'user_id' => auth('id'),
					'shop_id' => restaurant()->id,
					'status' => 1,
				);
				$id = $this->input->post('id');
				if($id==0){
					$insert = $this->admin_m->insert($data,'extra_libraries');
				}else{
					$insert = $this->admin_m->update($data,$id,'extra_libraries');
				}

				if($insert){
					
					$this->session->set_flashdata('success', !empty(lang('success_text'))?lang('success_text'):'Save Change Successful');
					redirect(base_url('admin/menu/extras'));
				}else{
					$this->session->set_flashdata('error', !empty(lang('error_text'))?lang('error_text'):'Somethings Were Wrong!!');
					redirect(base_url('admin/menu/extras'));
				}	
		}
	}

	public function packages()
	{
		$data = array();
		$data['page_title'] = "Packages";
        $data['page'] = "Menu";
        $data['data'] = false;
        $data['packages'] = $this->admin_m->get_all_packages('0');
		$data['main_content'] = $this->load->view('backend/menu/packages', $data, TRUE);
		$this->load->view('backend/index',$data);
	}


	public function edit_packages($id)
	{
		$data = array();
		$data['page_title'] = "Packages";
        $data['page'] = "Menu";
        $data['data'] = $this->admin_m->single_select_by_id($id,'item_packages');
        $data['items'] = $this->admin_m->get_package_items();

		$data['main_content'] = $this->load->view('backend/menu/create_packages', $data, TRUE);
		$this->load->view('backend/index',$data);
	}

	public function create_packages()
	{
		$data = array();
		$data['page_title'] = "Packages";
        $data['page'] = "Menu";
        $data['data'] = false;
        $data['allergens'] = $this->admin_m->select_all_by_user('allergens');
        $data['items'] = $this->admin_m->get_package_items();
		$data['main_content'] = $this->load->view('backend/menu/create_packages', $data, TRUE);
		$this->load->view('backend/index',$data);
	}

	public function add_packages(){
		is_test();
		$is_upcoming = $this->input->post('is_upcoming',TRUE);
		$is_discount = $this->input->post('is_discount',TRUE);
		$is_price = $this->input->post('is_price',TRUE);
		$is_home = $this->input->post('is_home',TRUE);
		
		// for custom price
		if(isset($is_price) && $is_price==1):
			$this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean|callback_number_check');
			$price = $this->input->post('price',TRUE);
		else:
			// for dynamic price
			$packages= $this->input->post('items[]',TRUE);
			$price = 0;
			foreach ($packages as $key => $p) {
				$item = $this->admin_m->single_select_by_id($p,'items');
			    $price += $item['price'];
			}
		endif;


		$this->form_validation->set_rules('package_name', 'Package Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('duration', 'Duration', 'trim|xss_clean');
		$this->form_validation->set_rules('items[]', 'Items', 'trim|required|xss_clean');
		$this->form_validation->set_rules('details', 'Details', 'trim');
		$this->form_validation->set_rules('in_stock', 'In stock', 'trim|xss_clean');

		if(isset($is_discount) && $is_discount==1){
			$this->form_validation->set_rules('discount', 'Discount %', 'trim|required|xss_clean');
			$discount_price = $this->input->post('discount',TRUE);
			$final_price = $price - ($discount_price/100)*$price;
			$is_discount = $is_discount;
		}else{
			$discount_price = 0;
			$is_discount = 0;
			$final_price = $price;
		}

		if(isset($is_upcoming) && $is_upcoming==1){
			$this->form_validation->set_rules('live_date', 'Live Date', 'trim|required|xss_clean');
			$live_date = $this->input->post('live_date',TRUE);
			$is_upcoming = 1;
		}else{
			$live_date = d_time();
			$is_upcoming = 0;
		}

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url('admin/menu/create_packages'));
			}else{	

				$end_date = strtotime("+".$this->input->post('duration')." day", strtotime($live_date));
				$end_date = date('Y-m-d', $end_date);
				$end_dates = $end_date." 23:59:59";

				$data = array(
					'package_name' => $this->input->post('package_name',TRUE),
					'duration' => $this->input->post('duration',TRUE),
					'price' => $price,
					'item_id' => json_encode($this->input->post('items[]',TRUE)),
					'details' => $this->input->post('details'),
					'in_stock' => !empty($this->input->post('in_stock'))?$this->input->post('in_stock'):0,
					'final_price' => $final_price,
					'discount' => $discount_price,
					'is_upcoming' => $is_upcoming,
					'is_discount' => $is_discount,
					'live_date' => $live_date,
					'end_date' => $end_dates,
					'is_home' => isset($is_home)?1:0,
					'is_price' => isset($is_price)?1:0,
					'user_id' => auth('id'),
					'shop_id' => restaurant()->id,
					'created_at' => d_time(),
				);
				
				$id = $this->input->post('id');
				if($id==0){
					$insert = $this->admin_m->insert($data,'item_packages');
				}else{
					$insert = $this->admin_m->update($data,$id,'item_packages');
				}

				if($insert){
					$this->upload_m->upload_img($insert,'item_packages');
					$this->session->set_flashdata('success', !empty(lang('success_text'))?lang('success_text'):'Save Change Successful');
					redirect(base_url('admin/menu/packages'));
				}else{
					$this->session->set_flashdata('error', !empty(lang('error_text'))?lang('error_text'):'Somethings Were Wrong!!');
					redirect(base_url('admin/menu/create_packages'));
				}	
		}
	}



	

	

	

	public function add_sizes(){
		is_test();
		$this->form_validation->set_rules('p_size[]', 'Name', 'trim|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url('admin/menu/category'));
			}else{	
				$size = [];
				if(isset($_POST['p_size'])):
					$this->admin_m->delete_by_user_id('item_sizes');
					foreach ($_POST['p_size'] as $key => $value) {
					    $size[] = array(
					    	'title' => $value,
					    	'slug' => $_POST['slug'][$key],
					    	'type' => $_POST['type'][$key],
					    	'user_id' => auth('id'),
					    	'shop_id' => restaurant()->id,
					    );

					}
					$insert = $this->admin_m->insert_all($size,'item_sizes');
				endif;

				if($insert){
					$this->session->set_flashdata('success', !empty(lang('success_text'))?lang('success_text'):'Save Change Successful');
					redirect(base_url('admin/menu/category'));
				}else{
					$this->session->set_flashdata('error', !empty(lang('error_text'))?lang('error_text'):'Somethings Were Wrong!!');
					redirect(base_url('admin/menu/category'));
				}	
		}
	}


	public function add_library_extras(){
		is_test();
		$this->form_validation->set_rules('ex_id[]', 'Extra Name', 'trim|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect($_SERVER['HTTP_REFERER']);
		}else{	
				$size = [];
				if(isset($_POST['ex_id'])):
					foreach ($_POST['ex_id'] as $key => $value) {
					    $size[] = array(
					    	'ex_id' => $value,
					    	'ex_name' => $_POST['ex_name'][$key],
					    	'ex_price' => $_POST['ex_price'][$key],
					    	'item_id' => $_POST['item_id'],
					    	'user_id' => auth('id'),
					    	'shop_id' => restaurant()->id,
					    );

					}
					$insert = $this->admin_m->insert_all($size,'item_extras');
				endif;

				if($insert){
					$this->session->set_flashdata('success', !empty(lang('success_text'))?lang('success_text'):'Save Change Successful');
					redirect($_SERVER['HTTP_REFERER']);
				}else{
					$this->session->set_flashdata('error', !empty(lang('error_text'))?lang('error_text'):'Somethings Were Wrong!!');
					redirect($_SERVER['HTTP_REFERER']);
				}	
		}
	}


	public function get_cat_info_by_type($id){
		$data = [];
		$data['sizes'] = $this->admin_m->get_cat_info_by_type($id);
		if(!empty($data['sizes'])):
			$load = $this->load->view('backend/menu/ajax_sizes',$data,true);
			echo json_encode(['st'=>1,'data'=>$load]);
		else:
			echo json_encode(['st'=>0,]);
		endif;
	}


	public function notification_off(){
		$data = [];
		$off_data = array(
			'is_ring' =>0,
		);
		$update = $this->admin_m->update_by_type($off_data,restaurant()->id,'shop_id','order_user_list');
		$update = 1;
		if($update){
			$data['orders'] = $this->admin_m->get_new_orders(restaurant()->id);
			$data['notify'] = $this->admin_m->get_todays_notify(restaurant()->id);
			$data['completed_orders'] = $this->admin_m->get_today_completed_order(restaurant()->id);
			$load = $this->load->view('backend/inc/ajax_notification',$data,true);
			echo json_encode(['st'=>1,'data'=>$load]);
		}else{
			echo json_encode(['st'=>0,]);
		}
		
	}



	public function delete($id)
	{
		is_test();

		$del=$this->admin_m->delete($id,'order_user_list');
		$del=$this->admin_m->delete_order_items($id,'order_item_list');
		if($del){
			$this->session->set_flashdata('success', lang('delete_success'));
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$this->session->set_flashdata('error', !empty(lang('error_text'))?lang('error_text'):'Somethings Were Wrong!!');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	public function reset_count($id,$table)
	{

		$up = $this->admin_m->update(['remaining' =>0],$id,$table);
		if($up){
			$this->session->set_flashdata('success', !empty(lang('success_text'))?lang('success_text'):'Save Change Successful');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$this->session->set_flashdata('error', !empty(lang('error_text'))?lang('error_text'):'Somethings Were Wrong!!');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	public function dine_in()
	{
		$data = array();
		$data['page_title'] = "QR Builder";
        $data['page'] = "Menu";
        $data['data'] = false;
        $data['packages'] = $this->admin_m->get_all_dine_in('0');
		$data['main_content'] = $this->load->view('backend/menu/dine_in', $data, TRUE);
		$this->load->view('backend/index',$data);
	}


	public function edit_dine_in($id)
	{
		$data = array();
		$data['page_title'] = "QR Builder";
        $data['page'] = "Menu";
        $data['data'] = $this->admin_m->single_select_by_id($id,'item_packages');
        $data['items'] = $this->admin_m->get_package_items();

        $data['table_list'] = $this->admin_m->select_all_by_user('table_list');

		$data['main_content'] = $this->load->view('backend/menu/create_dine_in', $data, TRUE);
		$this->load->view('backend/index',$data);
	}

	public function create_dine_in()
	{
		$data = array();
		$data['page_title'] = "QR Builder";
        $data['page'] = "Menu";
        $data['data'] = false;
        $data['allergens'] = $this->admin_m->select_all_by_user('allergens');
        $data['items'] = $this->admin_m->get_package_items();
        $data['table_list'] = $this->admin_m->select_all_by_user('table_list');
		$data['main_content'] = $this->load->view('backend/menu/create_dine_in', $data, TRUE);
		$this->load->view('backend/index',$data);
	}

	public function add_dine_in(){
		is_test();
		$is_upcoming = $this->input->post('is_upcoming',TRUE);
		$is_discount = $this->input->post('is_discount',TRUE);
		$is_price = $this->input->post('is_price',TRUE);
		$is_home = $this->input->post('is_home',TRUE);
		
		// for custom price
		if(isset($is_price) && $is_price==1):
			$this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean|callback_number_check');
			$price = $this->input->post('price',TRUE);
		else:
			// for dynamic price
			$packages= $this->input->post('items[]',TRUE);
			$price = 0;
			foreach ($packages as $key => $p) {
				$item = $this->admin_m->single_select_by_id($p,'items');
			    $price += $item['price'];
			}
		endif;


		$this->form_validation->set_rules('package_name', 'Package Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('duration', 'Duration', 'trim|xss_clean');
		$this->form_validation->set_rules('items[]', 'Items', 'trim|required|xss_clean');
		$this->form_validation->set_rules('details', 'Details', 'trim');

		if(isset($is_discount) && $is_discount==1){
			$this->form_validation->set_rules('discount', 'Discount %', 'trim|required|xss_clean');
			$discount_price = $this->input->post('discount',TRUE);
			$final_price = $price - ($discount_price/100)*$price;
			$is_discount = $is_discount;
		}else{
			$discount_price = 0;
			$is_discount = 0;
			$final_price = $price;
		}

		if(isset($is_upcoming) && $is_upcoming==1){
			$this->form_validation->set_rules('live_date', 'Live Date', 'trim|required|xss_clean');
			$live_date = $this->input->post('live_date',TRUE);
			$is_upcoming = 1;
		}else{
			$live_date = d_time();
			$is_upcoming = 0;
		}

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url('admin/menu/create_dine_in'));
			}else{	

				$end_date = strtotime("+".$this->input->post('duration')." day", strtotime($live_date));
				$end_date = date('Y-m-d', $end_date);
				$end_dates = $end_date." 23:59:59";

				$data = array(
					'package_name' => $this->input->post('package_name',TRUE),
					'duration' => $this->input->post('duration',TRUE),
					'price' => $price,
					'item_id' => json_encode($this->input->post('items[]',TRUE)),
					'details' => $this->input->post('details'),
					'in_stock' => 0,
					'final_price' => $final_price,
					'discount' => $discount_price,
					'is_upcoming' => $is_upcoming,
					'is_discount' => $is_discount,
					'live_date' => $live_date,
					'end_date' => $end_dates,
					'is_home' => isset($is_home)?1:0,
					'user_id' => auth('id'),
					'shop_id' => restaurant()->id,
					'is_special' => 2,
					'table_no' => !empty($this->input->post('table_no'))?$this->input->post('table_no'):0,
					'created_at' => d_time(),
				);
				
				$id = $this->input->post('id');
				if($id==0){
					$insert = $this->admin_m->insert($data,'item_packages');
				}else{
					$insert = $this->admin_m->update($data,$id,'item_packages');
				}

				if($insert){
					$this->upload_m->menu_qr($insert,restaurant()->id);
					$this->session->set_flashdata('success', !empty(lang('success_text'))?lang('success_text'):'Save Change Successful');
					redirect(base_url('admin/menu/dine_in'));
				}else{
					$this->session->set_flashdata('error', !empty(lang('error_text'))?lang('error_text'):'Somethings Were Wrong!!');
					redirect(base_url('admin/menu/create_dine_in'));
				}	
		}
	}


	public function add_order(){
		$sort = $_POST['sort'];
		$table = isset($_GET['id']) && !empty($_GET['id'])?$_GET['id']:'';
		$or = explode(",",$sort);
		$order=1;
		foreach ($or as $key => $id) {
			$data = array(
				'orders' => $order,
			);
			$this->admin_m->update($data,$id,$table);

			$order++;
		}
		$msg = lang('moved_successfull');
		echo json_encode(array('st'=>1,'msg'=>$msg));
		
	}



}
