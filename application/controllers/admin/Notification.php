<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {
	public function __construct(){
		parent::__construct();
		// is_login();
	}

	public function get_ajax_notification()
	{
		$data = array();
		$data['page_title'] = "Order List";
		$data['orders']= $this->admin_m->get_new_orders(restaurant()->id);
		$data['notify']= $this->admin_m->get_todays_notify(restaurant()->id);
		$data['completed_orders']= $this->admin_m->get_today_completed_order(restaurant()->id);
		$data['reservations']= $this->admin_m->get_todays_reservations(restaurant()->id);

	    $count_notify = $this->admin_m->get_todays_all_notify(restaurant()->id);
		$load_view = $this->load->view('backend/inc/ajax_realtime_notification', $data, TRUE);
		if($count_notify>0):
			echo json_encode(['st'=>1,'load_data'=>$load_view]);
		else:
			echo json_encode(['st'=>0,'load_data'=>'']);
		endif;
	}


	public function get_waiter_notification()
	{
		$data = array();
		$data['page_title'] = "Order List";
		$data['orders']= $this->admin_m->get_waiter_notification(restaurant()->id);
		$data['todays_notify'] = $this->admin_m->get_todays_waiter_notification(restaurant()->id);
		$data['count_notify'] = $this->admin_m->get_todays_waiter_notification(restaurant()->id,1);
		$load_view = $this->load->view('backend/inc/ajax_waiter_notify', $data, TRUE);
		if($data['count_notify']>0):
			echo json_encode(['st'=>1,'load_data'=>$load_view]);
		else:
			echo json_encode(['st'=>0,'load_data'=>'']);
		endif;
	}

	public function table_notification()
	{
		$data = array();
		$data['page_title'] = "Order List";
		$load_view = $this->load->view('backend/inc/ajax_table_notification', $data, TRUE);
		echo json_encode(['st'=>1,'load_data'=>$load_view]);
	}


	public function accept_waiter($id){
		$data = ['is_ring'=>0];
		$update = $this->admin_m->update($data,$id,'call_waiter_list');
		echo json_encode(['st'=>1]);
	}

	public function table_order()
	{
		$data = [];
		$dine = $this->admin_m->get_new_dine_order(restaurant()->id);
		$waiter = $this->admin_m->get_todays_waiter_notification(restaurant()->id,1);

		if($dine > 0 || $waiter > 0){
			$data['table_list'] =$this->common_m->get_table_list(restaurant()->id);
			$load_view = $this->load->view('backend/users/inc/table_orders', $data, TRUE);
			echo json_encode(['st'=>1,'load_data'=>$load_view]);
		}else{
			echo json_encode(['st'=>0,'load_data'=>'']);
		}

		
	}

}

