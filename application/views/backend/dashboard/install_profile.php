<div class="row">
	<div class="col-md-6">
		<?php 
			if(!empty(auth('profile')->is_profile) && auth('profile')->is_profile==1):
				$url = 'admin/restaurant/add_reservation/'.md5(restaurant()->id).'?q=create_profile';
			else:
				$url = "admin/auth/install_profile";
			endif;
		 ?>
		<form action="<?= base_url($url);?>" class="validForm" method="post">
			<?= csrf();?>
			<div class="card">
				<div class="card-header"> <h5 class="m-0 mr-5"> </h5></div>
				<div class="card-body">
					<div class="card-content">
						<?php if(!empty(auth('profile')->is_profile) && auth('profile')->is_profile==1): ?>
							<?php include APPPATH.'views/backend/common/available_days.php'; ?>
						<?php else: ?>
						<div class="row">
							<div class="form-group col-md-12">
								<label><?= lang('restaurant_name');?> <span class="alert_text">* </span></label>
								<input type="text" name="name" class="form-control" required>
							</div>
							<div class="form-group col-sm-12">
								<label  class="control-label"><?= !empty(lang('county'))?lang('county'):"county";?><span class="alert_text">* </span></label>

								<div class="">
									<select name="country_id" id="" class="form-control country select2"> 
										<?php foreach ($countries as $key => $country): ?>
											<option <?= isset($restaurant['country_id']) && $restaurant['country_id']== $country['id']?"selected":"";  ;?> value="<?= $country['id'] ;?>" data-dial="<?=  $country['dial_code'];?>" ><?=  $country['name'];?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>


							<div class="form-group col-sm-6">
								<label  class="control-label"><?= !empty(lang('currency'))?lang('currency'):"currency";?><span class="alert_text">* </span></label>

								<div class="">
									<select name="currency" id="" class="form-control currency select2"> 
										<?php foreach ($countries as $key => $country): ?>
											<option <?= isset($restaurant['currency_code']) && $restaurant['currency_code']== $country['currency_code']?"selected":"";  ;?> value="<?= $country['id'] ;?>"><?=  $country['currency_name'].' ('.$country['currency_symbol'].' '.$country['currency_code'].')';?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>

							<div class="form-group col-sm-6">
								<label  class="control-label"><?= !empty(lang('dial_code'))?lang('dial_code'):"dial code";?><span class="alert_text">* </span></label>

								<div class="">
									<input type="text" name="dial_code" class="form-control dial_code" value="<?= !empty($restaurant['dial_code'])?$restaurant['dial_code']:''; ;?>" required>
								</div>
							</div>

							<div class="form-group col-sm-12">
								<label  class="control-label"><?= !empty(lang('phone'))?lang('phone'):"phone";?> <span class="alert_text">* <?= lang('must_unique_english'); ?></span></label>

								<div class="">
									<div class="input-group">
										<span class="input-group-addon dialCcode"><?= restaurant()->dial_code ;?></span>
										<input type="text" name="phone" class="form-control"  placeholder="<?= !empty(lang('phone'))?lang('phone'):"Phone";?>" value="<?= !empty($restaurant['phone'])?$restaurant['phone']:''; ?>" required>
									</div>

								</div>
							</div>

							<div class="form-group col-sm-12">
								<label class="control-label"><?= lang('restaurant_email');?><span class="alert_text">* </span></label>

								<div class="">
									<input type="text" class="form-control"  name="email" placeholder="<?= !empty(lang('email'))?lang('email'):"Email";?>" value="<?= !empty($restaurant['email'])?$restaurant['email']:''; ?>" required>

								</div>
							</div>

							
						</div><!-- row -->
						<?php endif ?>
					</div><!-- card-content -->
				</div><!-- card-body -->
				<div class="card-footer text-right"> 
					<div class="pull-left">
						<a href="<?= base_url("admin/auth/setp_0");?>" class="btn btn-default"><?= lang('back');?></a>
					</div>
					<button type="submit" class="btn btn-secondary"><?= lang('submit');?></button>
				</div>
			</div><!-- card -->
		</form>
	</div>
</div>