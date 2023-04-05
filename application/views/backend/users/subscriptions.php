<?php $my_info = user_info_by_id(auth('id')); ?>
<div class="row activePackage">
	<?php if($my_info['account_type']==0): ?>
		<div class="card pricing_3">
			<div class="card-body">
				<div class="card_top">
					<h5 class="card-title text-muted text-uppercase text-center"><?= html_escape('Trial');?></h5>
					<h6 class="card-price text-center"><?= !empty(lang('free'))?lang('free'):'Free';?><span class="period">/ 1 <?= !empty(lang('month'))?lang('month'):'month';?></span></h6>
				</div>
				<hr>
				<div class="list_ul">
					<ul class="sub-ul">
						<?php foreach ($all_features as $key2 => $feature): ?>
							<li><span class="sub-li"><i class="fas fa-check c_green"></i></span> <?= html_escape($feature['features']);?>  <?= html_escape($feature['slug'])=='menu'?' <b>('.limit_text(0).' '.lang('items').') </b>':'' ;?>  <?= html_escape($feature['slug'])=='order'?' <b>('.limit_text(0).') </b>':'' ;?></li>
						<?php endforeach ?>


					</ul>
				</div>
				<div class="active_package_btn">
					<a href="javascript:;" class="bg_success"><i class="fas fa-check"></i> &nbsp; <?= !empty(lang('runing_package'))?lang('runing_package'):"Runing Package" ;?></a>
					<?php if(day_left(d_time(),$my_info['end_date'])['date'] !=0): ?>
						<span><?= lang('account_will_expired'); ?> <?=  day_left(d_time(),$my_info['end_date'])['date'];?> <?= lang('days'); ?></span>
					<?php else: ?>
						<span><?= lang('package_expiration'); ?>: <b> <?= lang('lifetime'); ?></b> </span>
					<?php endif;?>
				</div>		
			</div>			
		</div>
	<?php endif;?>
	<?php if(isset($active_package) && !empty($active_package)): ?>
		<div class="card pricing_3">
			<div class="card-body">
				<div class="card_top">
					<h5 class="card-title text-muted text-uppercase text-center"><?= html_escape($active_package['package_name']);?></h5>
					<?php if($active_package['package_type']=='free'): ?>
						<h6 class="card-price text-center"><?= !empty(lang('free'))?lang('free'):'Free';?></h6>

					<?php elseif($active_package['package_type']=='trial'): ?>
						<h6 class="card-price text-center"><?= !empty(lang('free'))?lang('free'):'Free';?><span class="period">/<?= !empty(lang('month'))?lang('month'):'month';?></span></h6>

					<?php elseif($active_package['package_type']=='weekly'): ?>
						<h6 class="card-price text-center"><?= !empty(lang('free'))?lang('free'):'Free';?><span class="period">/<?= !empty(lang('week'))?lang('week'):'week';?></span></h6>

					<?php elseif($active_package['package_type']=='fifteen'): ?>
						<h6 class="card-price text-center"><?= !empty(lang('free'))?lang('free'):'Free';?><span class="period">/<?= !empty(lang('15_days'))?lang('15_days'):'15 days';?></span></h6>
						
					<?php else: ?>
						<h6 class="card-price text-center"><?= get_currency('icon');?><?= admin_currency_position(html_escape($active_package['price'])) ;?><span class="period"> / <?= !empty($active_package['package_type'])?get_package_type($active_package['package_type'],$active_package['duration'],$active_package['duration_period']):get_package_type($active_package['package_type'],$active_package['duration'],$package['duration_period']);?></span></h6>
					<?php endif;?>
				</div>
				<hr>
				<div class="list_ul">
					<ul class="sub-ul">
						<?php foreach ($all_features as $key2 => $feature): ?>
							<?php $feature_id = get_active_package_features($feature['id'],$active_package['id']); ?>
							<?php if(LICENSE == '6fa1b959a5580d843a4ea03422873009' && $feature['slug'] == 'online-payment'): ?>
							<?php else: ?>
								<?php if(isset($feature_id) && $feature_id==1): ?>
									<li><span class="sub-li"><i class="fas fa-check c_green"></i></span> <?= html_escape($feature['features']);?>  <?= html_escape($feature['slug'])=='menu'?' <b>('.limit_text($active_package['item_limit']).' '.lang('items').') </b>':'' ;?>  <?= html_escape($feature['slug'])=='order'?' <b>('.limit_text($active_package['order_limit']).') </b>':'' ;?></li>
								<?php else: ?>
									<li class="text-muted"><span class="sub-li"><i class="fas fa-times c_red"></i></span> <?= html_escape($feature['features']);?> <?= html_escape($feature['slug'])=='menu'?' <b>('.limit_text($active_package['item_limit']) .' '.lang('items').') </b>':'' ;?>  <?= html_escape($feature['slug'])=='order'?' <b>('.limit_text($active_package['order_limit']).') </b>':'' ;?></li>
								<?php endif;?>
							<?php endif;?>
						<?php endforeach ?>

						<!-- custom fields -->
						<?php $customFields = isset($active_package['custom_fields_config']) && !empty($active_package['custom_fields_config'])?json_decode($active_package['custom_fields_config'],true):[]; ?>
						<?php if(is_array($customFields) && !empty($customFields)): ?>
						<?php foreach ($customFields as $fields): ?>
							<?php if(!empty($fields)): ?>
								<li><span class="fa-li"><i class="fas fa-check c_green"></i></span> <?= $fields;?></li>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
					<!-- custom fields -->


				</ul>
			</div>


			<?php if($active_package['package_type']!='yearly' && $active_package['package_type']!='monthly' ): ?>
				<div class="active_package_btn">
					<a href="javascript:;" class="bg_success"><i class="fas fa-check"></i> &nbsp; <?= !empty(lang('runing_package'))?lang('runing_package'):"Runing Package" ;?></a>

					<?php if(day_left(d_time(),$active_package['end_date'])['date'] !=0): ?>
						<span><?= lang('account_will_expired'); ?> <?=  day_left(d_time(),$active_package['end_date'])['date'];?> <?= lang('days'); ?></span>
					<?php else: ?>
						<span><?= lang('package_expiration'); ?>: <b> <?= lang('lifetime'); ?></b> </span>
					<?php endif;?>
					
				</div>		
			<?php endif;?>
		</div>
	</div>
	<?php endif;?>

	<?php foreach ($all_packages as $key => $row): ?>
		<?php if(isset($row['features']) && count($row['features']) > 0): ?>
		<div class="card pricing_3">

			<div class="card-body">
				<div class="priceTagLayout">
					<div class="card_top">
						<h5 class="card-title text-muted text-uppercase text-center"><?= html_escape($row['package_name']);?></h5>
						<?php if($row['package_type']=='free'): ?>
							<h6 class="card-price text-center"><?= !empty(lang('free'))?lang('free'):'Free';?></h6>
						<?php elseif($row['package_type']=='trial'): ?>
							<h6 class="card-price text-center"><?= !empty(lang('free'))?lang('free'):'Free';?><span class="period">/<?= !empty(lang('month'))?lang('month'):'month';?></span></h6>


						<?php elseif($row['package_type']=='weekly'): ?>
							<h6 class="card-price text-center"><?= !empty(lang('free'))?lang('free'):'Free';?><span class="period">/<?= !empty(lang('week'))?lang('week'):'week';?></span></h6> 

						<?php elseif($row['package_type']=='fifteen'): ?>
							<h6 class="card-price text-center"><?= !empty(lang('free'))?lang('free'):'Free';?><span class="period">/<?= !empty(lang('15_days'))?lang('15_days'):'15 days';?></span></h6>
							
						<?php else: ?>
							<h6 class="card-price text-center"><?= admin_currency_position(html_escape($row['price'])) ;?><span class="period"> / <?= !empty($row['package_type'])?get_package_type($row['package_type'],$row['duration'],$row['duration_period']):get_package_type($row['package_type'],$row['duration'],$row['duration_period']);?></span></h6>
						<?php endif;?>
					</div>
					<hr>
					<div class="list_ul">
						<ul class="sub-ul">
							<?php foreach ($all_features as $key2 => $feature): ?>
								<?php $feature_id = get_price_feature_id($feature['id'],$row['id']); ?>
								<?php if(LICENSE == '6fa1b959a5580d843a4ea03422873009' && $feature['slug'] == 'online-payment'): ?>
								<?php else: ?>

									<?php if(isset($feature_id['feature_id']) && $feature_id['feature_id']==$feature['id']): ?>
										<li><span class="sub-li"><i class="fas fa-check c_green"></i></span> <?= html_escape($feature['features']);?> <?= html_escape($feature['slug'])=='menu'?' <b>('.limit_text($row['item_limit']).' '.lang('items').') </b>':'' ;?>  <?= html_escape($feature['slug'])=='order'?' <b>('.limit_text($row['order_limit']).') </b>':'' ;?></li>
									<?php else: ?>
										<li class="text-muted"><span class="sub-li"><i class="fas fa-times c_red"></i></span> <?= html_escape($feature['features']);?> <?= html_escape($feature['slug'])=='menu'?' <b>('.limit_text($row['item_limit']).' items) </b>':'' ;?>  <?= html_escape($feature['slug'])=='order'?' <b>('.limit_text($row['order_limit']).') </b>':'' ;?></li>
									<?php endif;?>
								<?php endif;?>
							<?php endforeach; ?>


							<!-- custom fields -->
							<?php $customFields = isset($row['custom_fields_config']) && !empty($row['custom_fields_config'])?json_decode($row['custom_fields_config'],true):[]; ?>
							<?php if(is_array($customFields) && !empty($customFields)): ?>
							<?php foreach ($customFields as $fields): ?>
								<?php if(!empty($fields)): ?>
									<li><span class="sub-li"><i class="fas fa-check c_green"></i></span> <?= $fields;?></li>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>
						<!-- custom fields -->


					</ul>
				</div>
			</div><!-- priceTag -->

			<div class="pacakgeActionBtn">
				<?php if($my_info['account_type'] == $row['id']): ?>

					<?php if($my_info['is_expired']==0): ?>

						<?php if($my_info['is_payment']==0){ ?>
							<div class="active_package_btn">
								<a href="<?= base_url('payment-method/'.$my_info['username'].'/'.$row['slug']);?>" class="btn-info"><i class="fas fa-spinner"></i> &nbsp; <?= !empty(lang('pay_now'))?lang('pay_now'):"Pay Now" ;?> </a>
								<span>* <?= lang('payment_not_active_due_to_payment'); ?></span>
							</div>
						<?php }else{ ?>
							<div class="active_package_btn">
								<a href="javascript:;" class="bg_success"><i class="fas fa-check"></i> &nbsp; <?= !empty(lang('runing_package'))?lang('runing_package'):"Runing Package" ;?></a>
								<?php if(day_left(d_time(),$my_info['end_date'])['date'] !=0): ?>
									<span><?= lang('account_will_expired'); ?> <?=  day_left(d_time(),$my_info['end_date'])['date'];?> <?= lang('days'); ?></span>
								<?php else: ?>
									<span><?= lang('package_expiration'); ?>: <b> <?= lang('lifetime'); ?></b> </span>
								<?php endif;?>

							</div>
						<?php }; ?>

						<?php else: ?><!-- is_expired -->
						<div class="active_package_btn">
							<a href="<?= base_url('payment-method/'.$my_info['username'].'/'.$row['slug']);?>" class="btn-danger"><i class="fas fa-repeat"></i> &nbsp; <?= !empty(lang('re_active'))?lang('re_active'):"Re-active";?> </a>
							<span>* <?= lang('package_reactive_msg'); ?></span>
						</div>
						<?php endif;?><!-- is_expired -->

						<?php else: ?><!-- account_type -->
						<div class="active_package_btn">
							<a href="<?= base_url('payment-method/'.$my_info['username'].'/'.$row['slug']);?>" class="btn-primary"><i class="fa fa-exchange"></i> &nbsp; <?= !empty(lang('select_package'))?lang('select_package'):"Select Package";?> </a>
							<span>* <?= lang('select_this_package'); ?></span>
						</div>
						<?php endif;?><!-- account_type -->
					</div><!--pacakgeActionBtn  -->
				</div>
			</div>
		<?php endif;?>
	<?php endforeach; ?>
</div>