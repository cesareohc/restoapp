  <?php $u_info = get_user_info_by_slug($slug); ?>
  <?php $language = $this->admin_m->select_with_status('languages'); ?>
  <?php $settings = settings(); ?>
 <div class="userMenu ">
 	<div class="container">
	 	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
	 		<div class="container">
				  <a class="navbar-brand" href="<?=url($slug) ;?>"><img src="<?=  !empty(restaurant($id)->thumb)? base_url(restaurant($id)->thumb):base_url("assets/frontend/images/logo-example.png") ?>" alt="shopLogo" class="shopLogo">	</a>
				  <ul class="smDropdown">
				  	<?php if($shop['is_language']==1): ?>
					  	<?php if(count($language) > 1): ?>
					  		<li class="dropdownMenu allow-sm"><a class="nav-link p-r" href="javascript:;" ><i class="icofont-globe"></i> <span class=""><?= !empty(auth('site_lang'))?auth('site_lang'):$settings['language'] ;?></span></a>
					  			<div class="dropdownArea dropdownList" style="display: none;">
					  				<ul>
					  					<?php foreach ($language as $ln): ?>
					  						<li><a href="<?= base_url('home/lang_switch/'.$ln['slug']) ;?>"><?= $ln['lang_name'];?></a></li>
					  					<?php endforeach ?>
					  				</ul>
					  			</div>
					  		</li>
					  	<?php endif;?>
				  	<?php endif;?>
				  	
				  	<?php if($shop['is_call_waiter']==1): ?>
				  		<li  class="nav-item allow-sm" ><a class="nav-link" class="nav-link" href="javascript:;" data-toggle="modal" data-target="#waiterModal"><i class="icofont-bell-alt"></i></a></li>
				  	<?php endif;?>
				  </ul>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>
				  <div class="collapse navbar-collapse" id="navbarNavDropdown">
				    <div class="container-fluid">
				    	<div class="userMenu_flex">
					    	<ul class="navbar-nav">
					    	<?php if(is_feature($id,'welcome')==1 && is_active($id,'welcome')): ?>
						      <li class="nav-item <?= isset($page_title) && $page_title=="Profile"?"active":"" ;?>">
						        <a class="nav-link" href="<?= url($slug) ;?>"><?= lang('home');?> <span class="sr-only">(current)</span></a>
						      </li>
						  	<?php endif;?>

						  	<?php if(is_feature($id,'menu')==1 && is_active($id,'menu')): ?>
						      <li class="nav-item <?= isset($page_title) && $page_title=="Menus"?"active":"" ;?>">
						        <a class="nav-link" href="<?= url('menu/'.$slug) ;?>"><?= get_features_name('menu');?></a>
						      </li>
						  	<?php endif;?>

						  	<?php if(is_feature($id,'packages')==1 && is_active($id,'packages')): ?>
						      <li class="nav-item <?= isset($page_title) && $page_title=="Packages"?"active":"" ;?>">
						        <a class="nav-link" href="<?=url('packages/'.$slug) ;?>"><?= get_features_name('packages');?></a>
						      </li>
						  	<?php endif;?>
						  	<?php if(is_feature($id,'specialities')==1 && is_active($id,'specialities')): ?>
						      <li class="nav-item <?= isset($page_title) && $page_title=="Specialties"?"active":"" ;?>">
						        <a class="nav-link" href="<?= url('specialities/'.$slug) ;?>"> <?= get_features_name('specialities');?></a>
						      </li>
						  	<?php endif;?>

						  		<li class="dropdownMenu moreMenuBtn"><a href="javascript:;" class=""><?= lang('more') ;?> <i class="icofont-rounded-down"></i></a>
						  		
						  		<div class="dropdownArea" style="display: none;">
						  			<ul>



								  		<li class="nav-item allow-sm"><a class="nav-link" href="<?= url('track-order/'.$slug) ;?>">  <?= lang('track_order'); ?></a></li>

								  		<?php if(is_feature($id,'reservation')==1 && is_active($id,'reservation')): ?>
								  			<li  class="nav-item allow-sm" ><a class="nav-link" href="<?= url('reservation/'.$slug);?>"> <?= get_features_name('reservation');?></a></li>
								  		<?php endif;?>

								  		<?php if(is_feature($id,'contacts')==1 && is_active($id,'contacts')): ?>
								  		<li  class="nav-item allow-sm" ><a class="nav-link" href="<?= url('contacts/'.$slug);?>"><?= get_features_name('contacts');?></a></li>
								  	<?php endif;?>

									  	<li  class="nav-item allow-sm" ><a class="nav-link" href="<?= url('about-us/'.$slug);?>"><?= lang('about_us'); ?></a></li>

									  	<li  class="nav-item allow-sm" ><a class="nav-link" href="<?= base_url('login') ;?>"><?= lang('login'); ?></a></li>
									  
									  </ul>
						  		</div>
						  		</li>

					    	</ul>
					    	<div class="rightMenu">
						    	<ul>
						    		<li class="cart navCart dis_none" style="display:none;"><a class="nav-link" href="javascript:;"><i class="icofont-cart-alt fa-2x"></i> <span class="cart_count total_count"><?= $this->cart->total_items() ;?></span></a></li>
						    		<?php if($shop['is_language']==1): ?>
								    	<?php if(count($language) > 1): ?>
								    		<li class="dropdownMenu"><a class="nav-link p-r btn" href="javascript:;" ><i class="icofont-globe"></i> <?= !empty(auth('site_lang'))?auth('site_lang'):$settings['language'] ;?></a>
								    			<div class="dropdownArea dropdownList" style="display: none;">
								    				<ul>
									    				<?php foreach ($language as $ln): ?>
									    						<li><a href="<?= base_url('home/lang_switch/'.$ln['slug']) ;?>"><?= $ln['lang_name'];?></a></li>
									    				<?php endforeach ?>
									    			</ul>
								    			</div>
								    		</li>
								    	<?php endif;?>
							    	<?php endif;?>
							    	<?php if($shop['is_call_waiter']==1): ?>
							    		<li class="callwaiter"><a class="nav-link" href="javascript:;" data-toggle="modal" data-target="#waiterModal"><i class="icofont-bell-alt"></i> <?= lang('call_waiter'); ?></a></li>

							    	<?php endif;?>
						    	</ul>
					    	</div>
					    </div>
				    </div>
				  </div>
		  </div>
		</nav>
	</div>
 </div>

<!-- style 1 -->





 <div class="UserResponsive_menu">
 	<div class="UserMobileMenu">
 		<ul>
 		
 				<li data-toggle="tooltip" title="Home" class="<?= isset($page_title) && $page_title=="Profile"?"active":"" ;?>">
 					<?php if(is_feature($id,'welcome')==1 && is_active($id,'welcome')): ?>
	 					<a href="<?= url($slug) ;?>"><i class="icofont-home"></i></a>
	 				<?php endif;?>
 				</li>
 			

 			
	 			<li data-toggle="tooltip" title="<?= lang('track_order');?>" class="<?= isset($page_title) && $page_title=="Track Order"?"active":"" ;?>">
	 					<a href="<?= url('track-order/'.$slug) ;?>"><i class="icofont-direction-sign"></i></a>
	 			</li>
	 		

 			<li data-toggle="tooltip" title=""><a href="javascript:;" class="base"><i class="icofont-gears"></i></a></li>

 			<li data-toggle="tooltip" title="<?= lang('call_waiter'); ?>" class="">
 				<?php if($shop['is_call_waiter']==1): ?>
 					<a  href="javascript:;" data-toggle="modal" data-target="#waiterModal"><i class="icofont-bell-alt"></i></a>
 				<?php endif;?>
 			</li>

 			<li data-toggle="tooltip" title="<?= lang('add_to_cart'); ?>" class="cart navCart <?= $this->cart->total_items() > 0?'active':'' ;?>" >
 				<?php $disable_pages = ['Payment Gateway','All Orders','Checkout']; ?>
 				<?php if(!in_array($page_title,$disable_pages)): ?>
 					<?php if(check_shop_open_status(@$shop_id)==1): ?>
 						<a class="nav-link" href="javascript:;"><i class="icofont-cart-alt fa-2x "></i> <?php if($this->cart->total_items() > 0): ?><span class="cart_count total_count"><?= $this->cart->total_items() ;?></span> <?php endif; ?></a>

 					<?php endif ?>	
 				<?php endif; ?>
 			</li>
 			
	 
	 			
	 

	 			
	 		

 		</ul>
 	</div>
 	<div class="show_menu_details">
 		<a href="javascript:;" class="closeNavMenu"><i class="icofont-close-line"></i></a>
 		<ul>
 			<?php if(is_feature($id,'welcome')==1 && is_active($id,'welcome')): ?>
 				<li class="nav-item allow-sm"><a class="nav-link" href="<?= url($slug) ;?>"><i class="icofont-home"></i> <?= lang('home'); ?></a></li>
 			<?php endif ?>

 		<?php if(is_feature($id,'menu')==1 && is_active($id,'menu')): ?>
	 		<li class="nav-item allow-sm"><a class="nav-link" href="<?= url('menu/'.$slug);?>"><i class="icofont-culinary"></i> <?= lang('menu'); ?></a></li>
	 	<?php endif ?>

		 	<?php if(is_feature($id,'packages')==1 && is_active($id,'packages')): ?>
		 	<li class="nav-item allow-sm"><a class="nav-link" href="<?= url('packages/'.$slug);?>"><i class="icofont-gift"></i> <?= lang('packages'); ?></a></li>
		 <?php endif ?>

		 <?php if(is_feature($id,'specialities')==1 && is_active($id,'specialities')): ?>
		 <li class="nav-item allow-sm"><a class="nav-link" href="<?= url('specialities/'.$slug);?>"><i class="icofont-touch"></i> <?= lang('specialities'); ?></a></li>
		<?php endif ?>


 			<li><a href="<?= url('track-order/'.$slug) ;?>"><i class="fa fa-tasks"></i> <?= lang('track_order'); ?></a></li>
 			<?php if(is_feature($id,'reservation')==1 && is_active($id,'reservation')): ?>
	 			<li><a href="<?= url('reservation/'.$slug);?>"><?= get_features_name('reservation');?></a></li>
	 		<?php endif;?>
 			<?php if(is_feature($id,'contacts')==1 && is_active($id,'contacts')): ?>
	 			<li><a href="<?= url('contacts/'.$slug);?>"><i class="icofont-live-support"></i> <?= get_features_name('contacts');?></a></li>
	 		<?php endif;?>
	 		<?php if($shop['is_call_waiter']==1): ?>
	 			<li><a class="nav-link" href="javascript:;" data-toggle="modal" data-target="#waiterModal"><i class="icofont-bell-alt"></i> <?= lang('call_waiter'); ?></a></li>
	 		<?php endif;?>
	 		<?php if($shop['is_language']==1): ?>
		 		<li class="dropdownMenu allow-sm"><a class="nav-link p-r" href="javascript:;" ><i class="icofont-globe"></i> <?= !empty(auth('site_lang'))?auth('site_lang'):$settings['language'] ;?></a>
		 			<div class="dropdownArea dropdownList" style="display: none;">
		 				<ul>
		 					<?php foreach ($language as $ln): ?>
		 						<li><a href="<?= base_url('home/lang_switch/'.$ln['slug']) ;?>"><?= $ln['lang_name'];?></a></li>
		 					<?php endforeach ?>
		 				</ul>
		 			</div>
		 		</li>
		 	<?php endif;?>
 			<li><a href="<?= url('about-us/'.$slug);?>"><i class="icofont-info-circle"></i> <?= lang('about_us'); ?></a></li>
 			<li><a href="<?= base_url('login') ;?>"><i class="icofont-sign-in"></i> <?= lang('login'); ?></a></li>
 		</ul>
 	</div>

 </div>
 		
 <?php $disable_pages = ['Payment Gateway','All Orders','Checkout']; ?>
 <?php if(isset($page_title) && !in_array($page_title,$disable_pages)): ?>
 	<?php if(check_shop_open_status(@$shop_id)==1): ?>
 		<?php if(empty(auth('is_pos'))): ?>
 			<div class="cart navCart CartIcon <?= $this->cart->total_items() > 0?'active':'' ;?> menu_style_<?= $u_info['menu_style'];?>" ><a class="nav-link" href="javascript:;"><i class="icofont-cart-alt fa-2x"></i> <span class="cart_count total_count"><?= $this->cart->total_items() ;?></span></a></div>
 		<?php endif ?>	
 	<?php endif ?>	
 <?php endif; ?>

 <div class="shopping_cart style_2">
 	<div class="shopping_cart_content">
 		<div class="cart_heading">
			<h4><?= lang('my_cart'); ?> </h4>
			<span class="cartItemList cartActive"><a class="" href="javascript:;"><i class="icofont-close-line-squared fa-2x c_red"></i></a></span>
		</div>

		<?php $time =$this->common_m->get_single_appoinment(date('w'),isset($shop_id)?$shop_id:0); ?>

				<?php if(isset($time) && !empty($time)): ?>
					<?php if(is_feature($id,'order')==1 && is_active($id,'order')): ?>
							<?php 
								 $total = $this->common_m->count_table_shop_id($shop['id'],'order_user_list');
								 $limit = limit($id,0);
							 ?>
						 
						 <?php if($limit != 0 && $total >= $limit):  ?>
						 	<div class="top_cart_order">
						 		<div class="limit_msg">
									<i class="fa fa-frown fa-3x"></i>
									<h4><?= lang('maximum_order_alert'); ?></h4>
									<a href="<?= url('contacts/'.$slug) ;?>" class="btn btn-info custom_btn mt-15"><?= lang('contact_us'); ?></a>
								</div>
						 	</div>
						 	<?php else: ?>
						 		<?php if(check_shop_open_status($shop_id)==1): ?>
						 			<div class="top_cart_order style_2">
						 				<ul class="cartItems">
						 					<?php include APPPATH.'views/layouts/ajax_cart_item.php'; ?>
						 				</ul>
						 			</div>
						 			<div class="bottom_cart_order">
						 				<div class="sub_total_list">
						 					<h4><?= lang('total'); ?>: <?= lang('qty'); ?> <span class="cart_count"><?= $this->cart->total_items();?></span> =  <?= lang('price'); ?> <span class="total_price"><?= currency_position($this->cart->total(),$shop['id'])  ;?></span></h4>
						 				</div>

						 				<a href="<?= url('checkout/'.$slug);?>" class="btn btn-info btn-block order-btn"><?= !empty(lang('checkout'))?lang('checkout'):'Checkout'  ;?></a>

						 			</div>
						 		<?php else: ?>
						 			<div class="top_cart_order">
										<div class="limit_msg">
											<i class="fa fa-frown fa-3x"></i>
											<h4><?= lang('today_remaining_off'); ?></h4>
											<a href="<?= url('contacts/'.$slug) ;?>" class="btn btn-info custom_btn mt-15"><?= lang('contact_us'); ?></a>
										</div>
									</div>
						 		<?php endif; ?>
						 	<?php endif;?>

					<?php else: ?> <!-- is_active by pcakage-->
						<div class="top_cart_order">
							<div class="limit_msg">
								<i class="fa fa-frown fa-3x"></i>
								<h4><?= lang('sorry_cant_take_order'); ?></h4>
								<a href="<?= url('contacts/'.$slug) ;?>" class="btn btn-info custom_btn mt-15"><?= lang('contact_us'); ?></a>
							</div>
						</div>
					<?php endif;?> <!-- is_active -->
			<?php else: ?>
				<div class="top_cart_order">
					<div class="limit_msg">
						<i class="fa fa-frown fa-3x"></i>
						<h4><?= lang('today_remaining_off'); ?></h4>
						<a href="<?= url('contacts/'.$slug) ;?>" class="btn btn-info custom_btn mt-15"><?= lang('contact_us'); ?></a>
					</div>
				</div>
		<?php endif;?> <!-- empty time -->
 	</div>
 </div>


<!-- cart notify -->
<div class="cartNotify_wrapper">
	
</div>
<!-- cart notify -->

 <!-- Modal -->
<div class="modal fade itemPopupModal" id="itemModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" id="item_details">
    
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="orderModal"  data-backdrop="static">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content" id="showOrderModal">
        
    </div>
  </div>
</div>

<!--  -->
<div class="modal" id="closeModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"><?= lang('alert'); ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="closeShop">
        	<i class="fa fa-frown fa-2x"></i>
        	<div class="mt-10">
        		<h4><?= !empty(lang('sorry_we_are_closed'))?lang('sorry_we_are_closed'):"Sorry We are closed" ;?></h4>
        		<p><?= !empty(lang('please_check_the_available_list'))?lang('please_check_the_available_list'):"please check the available list" ;?></p>
        	</div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><?= lang('close'); ?></button>
      </div>

    </div>
  </div>
</div>

<?php  include APPPATH."views/layouts/waiterModal.php";?>