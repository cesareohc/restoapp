		</div> 
	</div> 
</div>
		
	<a href="<?php echo base_url() ?>" id="base_url"></a>
	<a href="<?php echo $this->security->get_csrf_hash(); ?>" id="csrf_value"></a>
	<?php $country_info = get_country(!empty($settings['country_id'])?$settings['country_id']:15); ?>
	<a href="<?= $country_info['code'];?>" id="code"></a>
	<a href="<?= $country_info['dial_code'];?>" id="dial_code"></a>
	<a href="<?= !empty(lang('yes'))?lang('yes'):"Yes";?>" id="yes"></a>
	<a href="<?= !empty(lang('no'))?lang('no'):"No";?>" id="no"></a>
	<a href="<?= !empty(lang('cancel'))?lang('cancel'):"cancel";?>" id="cancel"></a>
	<a href="<?= !empty(lang('are_you_sure'))?lang('are_you_sure'):"are you sure";?>" id="are_you_sure"></a>
	<a href="<?= !empty(lang('success'))?lang('success'):"Success";?>" id="success"></a>
	<a href="<?= !empty(lang('warning'))?lang('warning'):"Warning";?>" id="warning"></a>
	<a href="<?= !empty(lang('error'))?lang('error'):"error";?>" id="error"></a>
	<a href="<?= !empty(lang('success_text'))?lang('success_text'):'Save Change Successful';?>" id="success_msg"></a>
	<a href="<?= !empty(lang('error_text'))?lang('error_text'):'Somethings Were Wrong!';?>" id="error_msg"></a>
 	<!-- ==========
   		 Default Js
    =============== -->
    

    <script src="<?= base_url();?>assets/frontend/js/popper.min.js" defer="true"></script>
    <script src="<?= base_url();?>assets/frontend/js/bootstrap.min.js"  defer="true"></script>
    <?php if(direction()=='rtl'): ?>
	    <link rel="stylesheet" href="<?= base_url()?>assets/frontend/js/bootstrap-rtl.js" defer="true">
	    <a href="javascript:;" data-id="rtl" id="rtl"></a>
	  <?php endif ?>
	 <?php if(isset($id)): ?>
	 <a href="javascript:;" data-id="<?=  is_xs($id);?>" id="is_xs"></a>
	<?php endif;?>
	<!-- ==========
   		End Default Js
    =============== -->

	<!-- parallax -->
		<script src="<?= base_url()?>assets/frontend/plugins/jstars.js" defer="true"></script>
		<script src="<?= base_url()?>assets/frontend/plugins/parallax.js" defer="true"></script>
	<!-- parallax -->


	<!--isotope-->
		<script src="<?= base_url()?>assets/frontend/plugins/isotope.pkgd.min.js" defer="true"></script>
	<!-- isotope -->

	<!--venobox-->
		 <script src="<?= base_url()?>assets/frontend/plugins/venobox/venobox.min.js" defer="true"></script>
	<!-- venobox -->

    <!-- slick slider js -->
	
		<script src="<?php echo base_url()?>assets/frontend/plugins/sweetalert/sweet-alert.js" defer="true"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"  defer="true"></script>
	<!-- slick slider js -->

	<!-- datetimepicker -->
		<script src="<?= base_url();?>assets/admin/bower_components/moment/min/moment.min.js"  defer="true"></script>
		<script type="text/javascript"  src="<?= base_url();?>assets/frontend/plugins/datetime_picker/datetime.js"  defer="true"></script>
	<!-- datetimepicker -->


	<!-- aos-animation -->
		<script src="<?= base_url();?>assets/frontend/plugins/animation/aos-animation.js" ></script>
	<!-- aos-animation -->



	<!-- wow -->
		<script src="<?= base_url();?>assets/frontend/plugins/animate/wow.js" ></script>
	<!-- wow -->

	<script src="<?php echo base_url()?>assets/admin/plugins/notify/notify.js"></script>

	<?php if(isset($page_title) && $page_title != "Checkout"):?>
		<!-- intelinput -->
		<script src="<?= base_url();?>assets/frontend/plugins/country/intelinput.js" ></script>
		<!-- intelinput -->
	<?php endif;?>

	<!-- appear -->
		<script src="<?= base_url();?>assets/frontend/plugins/jquery.appear.js" ></script>
		<script src="<?= base_url();?>assets/frontend/plugins/editableSelect/editableSelect.js" ></script>
	<!-- appear -->
		<script src="<?= base_url();?>assets/frontend/plugins/jquery.scrollTo.min.js" ></script>
		<script src="<?= base_url();?>assets/frontend/plugins/scroller.js" ></script>

	<!-- pwa config -->
	<?php if(check()==1): ?>
		<?php include 'pwa_footer_config.php'; ?>
	<?php endif ?>
	<!-- pwa config -->

	<?php if(isset($id)): ?>
		<?php $u_info = user_info_by_id($id); ?>
		<?php $shop = restaurant($id); ?>
		
		<!-- restaurant country -->
		<?php $reg_country_info = get_country(!empty($shop->country_id)?$shop->country_id:15); ?>
		<a href="<?= $reg_country_info['code'];?>" id="reg_code"></a>
		<a href="<?= $reg_country_info['dial_code'];?>" id="reg_dial_code"></a>

			<!-- available_time_slot -->
			<?php include 'common/available_time_slot.php'; ?>
			<!-- available_time_slot -->
			<?php if(isset($page_title) && $page_title=="Checkout"): ?>
				<!-- google map settings -->
				<?php include 'common/google_map_settings.php'; ?>
				<!-- google map settings -->
			<?php endif ?>

	 		<?php $user_settings = $this->common_m->get_user_settings($id); ?>
	 		<?php $apps = @!empty($user_settings['extra_config'])?json_decode($user_settings['extra_config']):'' ?>


	 		<?php if(is_feature($id,'pwa-push')==1 && is_active($id,'pwa-push') && check()==1): ?>
	 			<?php $oneSignal = !empty($user_settings['onesignal_config']) ? json_decode($user_settings['onesignal_config']) : ''; ?>
		    	<?php if (isset($oneSignal->is_active_onsignal) && $oneSignal->is_active_onsignal == 1) : ?>
		 			<!-- Onesignal settings -->
		 			<?php include APPPATH.'views/frontend/inc/onsignal_footer.php'; ?>
		 			<!-- Onesignal settings -->
	 			<?php endif; ?>
 			<?php endif; ?><!-- is_feature -->

 			<!-- apps.elfsight.com -->
 			<?php if(isset($is_share) && $is_share==1): ?>
	 			<?php if (isset($apps->elfsight_status) && $apps->elfsight_status == 1) : ?>
	 				<script src="https://apps.elfsight.com/p/platform.js" defer></script>
	 				<div class="<?= isset($apps->app_id)?$apps->app_id:'';?>"></div>
	 				<!-- apps.elfsight.com -->
	 			<?php endif; ?>
	 		<?php endif; ?>

	 		<?php if($u_info['is_active']==0 || $u_info['is_verify']==0 || $u_info['is_expired']==1 || $u_info['is_payment']==0 || $u_info['is_deactived']==1): ?>
				<?php include APPPATH.'views/frontend/inc/popupModal.php'; ?>
			<script>
				$(document).ready(function(){
					$('#popupModal').modal('show');
				});
				$('#popupModal').modal({
				  keyboard: false,
				  backdrop:'static'
				});
			</script>
		<?php endif ?>

		<?php if (isset($apps->is_scroll_top) && $apps->is_scroll_top == 1) : ?>
			<script src="<?= base_url();?>assets/frontend/plugins/jquery.scrollTo.min.js" ></script>
			<div class="scroll-top">
				<a href="javascript:;" class="bounce"><i class="fa fa-chevron-up"></i></a>
			</div>
		<?php endif ?>

	 		
	<?php endif;?>
	
	<?php include APPPATH.'views/frontend/inc/alertMsg.php' ?>

	<!-- main js -->
		<script src="<?= base_url();?>assets/frontend/js/plugins.js?v=<?= settings()['version'];?>&time=<?= time();?>" ></script>
		<script src="<?= base_url();?>assets/frontend/js/auth.js?v=<?= settings()['version'];?>&time=<?= time();?>" ></script>
		<script src="<?= base_url();?>assets/frontend/js/main.js?v=<?= settings()['version'];?>&time=<?= time();?>" ></script>
	<!-- main js -->
		<!--payment Modal -->
  
    </body>
</html>

<script type="text/javascript">
	window.addEventListener('DOMContentLoaded', (event) => {
		setTimeout(function(){ jQuery("#preloader").fadeOut('slow'); }, 1000);
    });
</script>


<script>
	$(document).ready(function(){
		/* Activate scrollspy menu */
		$('body').scrollspy({target: '#nav', offset: 100});

        /* Smooth scrolling */
		$('a.scrollto').on('click', function(e){
            //store hash
			var target = this.hash;    
			e.preventDefault();
			$('body').scrollTo(target, 800, {offset: 10, 'axis':'y'});

		});
		$(".background").parallaxify();
	})
	


</script>

<script>
	$(window).on('load', function(){
		setTimeout(function(){
			amarLeazyLoad();
			amarbgLoad();
		},500);

	});

	var amarbgLoad = function(){
		$('.bg_loader').each(function() {

			var lazy = $(this);
			var src = lazy.data('src');
			lazy.css("background-image", "url(" + src + ")");
			$('.bg_loader').removeClass('bg_loader');
		});
	}

	var amarLeazyLoad = function(){
		$('.img_loader').each(function() {
			var lazy = $(this);
			var src = lazy.data('src');
			lazy.attr('src', src);
			$('.img_loader').removeClass('.bg_loader');

		});
	}
</script>


<?php if(isset($_GET['q']) && $_GET['q']=='table'): ?>
	<script>
		$(document).ready(function(){
			$('#waiterModal').modal('show');

		});
	</script>
<?php endif;?>

<div class="modal fade" id="tableModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<?= $this->session->flashdata('msg'); ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?= lang('close'); ?></button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

