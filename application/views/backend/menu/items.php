<div class="row">
	<div class="col-md-6">
		<?php 
			$total = $this->admin_m->check_limit_by_table('items');
		    $limit = limit(auth('id'),1);
		 ?>
		<?php if($limit ==0): ?>
			<div class="single_alert alert alert-info alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <div class="d_flex_alert ">
	                <h4><i class="fas fa-exclamation-triangle"></i> <?= lang('info'); ?></h4>
	                <div class="double_text">
	                    <div class="text-left">
	                        <h5><?= lang('you_can_add'); ?> <b class="underline"> <?= lang('unlimited'); ?> </b>  <?= lang('items'); ?></h5>
	                    </div>
	                    	
	                </div>
	            </div>
	        </div>
	        <?php $active=1; ?>
		<?php elseif($total > $limit): ?>
			<div class="single_alert alert alert-danger alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <div class="d_flex_alert ">
	                <h4> <i class="fas fa-exclamation-triangle"></i> <?= lang('alert'); ?></h4>
	                <div class="double_text">
	                    <div class="text-left">
	                        <h5> <b><?= lang('sorry'); ?></b></h5>
	                        <p><?= lang('you_reached_max_limit'); ?>: <?= $limit ;?></p>
	                    </div>
	                    	
	                </div>
	            </div>
	        </div>
	        <?php $active=0; ?>
        <?php else: ?>
        	<div class="single_alert alert alert-info alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <div class="d_flex_alert ">
	                <h4><i class="fas fa-exclamation-triangle"></i>  <?= lang('info'); ?></h4>
	                <div class="double_text">
	                    <div class="text-left">
	                        <h5><?= lang('you_have_remaining'); ?> <b class="underline"> &nbsp; <?=  ($limit-$total);?> &nbsp;</b> <?= lang('out_of'); ?> <b class="underline"> &nbsp; <?=  ($limit);?> &nbsp;</b></h5>
	                    </div>
	                    	
	                </div>
	            </div>
	        </div>
	        <?php $active=1; ?>
        <?php endif;?>
	</div>
<div class="col-md-12">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title"><?= !empty(lang('items'))?lang('items'):"items";?> &nbsp; &nbsp; 
				
			</h3>
			<div class="box-tools pull-right">
				<?php if(isset($active) && $active==1): ?>
					<?php if(is_access('add')==1): ?>
						<a href="<?= base_url('admin/menu/create_item') ;?>" class="btn btn-secondary btn-flat"><i class="fa fa-plus"></i> &nbsp;<?= !empty(lang('add_new_item'))?lang('add_new_item'):"Add New Item";?> </a>
					<?php endif;?>
				<?php endif;?>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body bg_gray">
			<div class="table-responsives">
				<div class="row">
					<?php foreach ($menu_type as $key => $cat): ?>
						<div class="col-md-3">
							<a href="<?= base_url("admin/menu/item_list/{$cat['id']}"); ?>">
								<div class="single_cat">
									<img src="<?= get_img($cat['thumb'],'',1) ;?>" alt="">
									<div class="catDetails">
										<h4><?= $cat['name'] ;?></h4>
										
										<div class="mt-10">
											<label class="label default-light-soft-active fz-14"><?= $this->admin_m->get_total_item_by_cat_id($cat['id']) ;?> <i class="icofont-cherry"></i></label>
										</div>
									</div>
								</div>
							</a>
						</div>
					<?php endforeach ?>
				</div>
































				
			</div>
		</div><!-- /.box-body -->
	</div>
</div>
</div>