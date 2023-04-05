<div class="row">
	<?php if(isset($is_create) && $is_create==TRUE): ?>
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"> <?= lang('create_category'); ?></h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
				</div>
			</div>
			<!-- /.box-header -->
			<form action="<?= base_url('admin/menu/add_category') ?>" method="post" class="skill_form" enctype= "multipart/form-data">
				<div class="box-body">

					<!-- csrf token -->
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

					<div class="row">
						<div class="form-group col-md-12">
					      	<label for="title"><?= !empty(lang('category_name'))?lang('category_name'):"Category Name";?> *</label>
					        <input type="text" name="name" id="name" class="form-control" placeholder="<?= !empty(lang('category_name'))?lang('category_name'):"Category Name";?>" value="<?= !empty($data['name'])?html_escape($data['name']):set_value('name'); ?>">
					    </div>
					    
					    <div class="form-group col-md-6">
					      	<label for="title"><?= !empty(lang('type'))?lang('type'):"Type";?></label>
					        <select name="type" class="form-control">
					        	<option value=""><?= lang('select_type'); ?></option>
					        	<?php foreach (get_size_type() as $key => $size): ?>
					        		<option value="<?= $key ;?>" <?= isset($data['type']) && $data['type']==$key?"selected":"" ;?>><?= !empty(lang($key))?lang($key):$key ;?></option>
					        	<?php endforeach ?>
					        	
					        	
					        	<option value="0" <?= isset($data['type']) && $data['type']=="0"?"selected":"" ;?>><?= lang('others'); ?></option>
					        </select>
					    </div>
					    <div class="form-group col-md-6">
					      	<label for="title"><?= !empty(lang('order'))?lang('order'):"order";?></label>
					        <input type="text" name="orders" class="form-control" value="<?= !empty($data['orders'])?html_escape($data['orders']):0; ?>">
					    </div>
					    <div class="col-md-12 mb-10">
							<label><?= !empty(lang('details'))?lang('details'):"Details";?></label>
							<textarea name="details" id="" cols="5" rows="5" class="form-control" placeholder=" <?= !empty(lang('details'))?lang('details'):"Details";?>"><?= !empty($data['details'])?html_escape($data['details']):set_value('details'); ?></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label class="defaultImg square">
								<?php if(isset($data['id']) && !empty($data['id'])): ?>
								<a href="<?= base_url('admin/restaurant/delete_img/'.$data['id'].'/items');?>" class="deleteImg <?= isset($data['thumb']) && !empty($data['thumb'])?"":"opacity_0"?>" data-msg="<?= !empty(lang('want_to_delete'))?lang('want_to_delete'):"want to delete";?>"><i class="fa fa-close"></i></a>
							<?php endif;?>

							<img src="<?= isset($data['thumb']) && !empty($data['thumb'])?base_url($data['thumb']):""?>" alt=""  class="imgPreview <?= isset($data['thumb']) && !empty($data['thumb'])?"":"opacity_0"?>">

							<div class="imgPreviewDiv <?= isset($data['thumb']) && !empty($data['thumb'])?"opacity_0":""?>">
								<i class="fa fa-upload"></i>
								<h4><?= lang('upload_image'); ?></h4>
								<p class="fw_normal mt-3"><?= lang('max'); ?>: 500 x 500 px</p>
							</div>

							<input type="file" name="file[]" class="imgFile opacity_0" data-width="500" data-height="500" >
						</label>
						<span class="img_error"></span>
						</div>
					</div>
					
				    <input type="hidden" name="id" value="<?= isset($data['id']) && $data['id'] !=0?html_escape($data['id']):0 ?>">
				</div><!-- /.box-body -->
				<div class="box-footer">
					<div class="pull-left">
		          		<a href="<?= base_url('admin/menu/category'); ?>" class="btn btn-default btn-block btn-flat"><?= !empty(lang('cancel'))?lang('cancel'):"cancel";?></a>
		          	</div>
		          	<div class="pull-right">
		          		<button type="submit" name="register" class="btn btn-primary btn-block btn-flat"><?= !empty(lang('submit'))?lang('submit'):"submit";?></button>
		          	</div>
				</div>
			</form>
		</div>
	</div>
<?php endif;?>

	<div class="col-md-6">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><?= lang('categories'); ?> &nbsp; &nbsp; 
					
				</h3>
				<div class="box-tools pull-right">
					<?php if(is_access('add')==1): ?>
						<a href="<?= base_url('admin/menu/create_category') ;?>" class="btn btn-secondary"><i class="fa fa-plus"></i> &nbsp;<?= !empty(lang('add_new'))?lang('add_new'):"Add New";?> </a>
					<?php endif; ?>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="upcoming_events">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th><?= !empty(lang('sl'))?lang('sl'):"sl";?></th>
									<th><?= lang('image'); ?></th>
									<th><?= lang('title'); ?></th>
									<th><?= lang('type'); ?></th>
									<th><?= lang('status'); ?></th>
									<th><?= lang('action'); ?></th>
								</tr>
							</thead>
							<tbody id="sortable" class="sortable sorting">
								<?php $i=1; foreach ($menu_type as $row): ?>
									<tr id='<?= $row['id']; ?>'>
										<td class="handle"><?= $i;?></td>
										<td class="handle">
											<div class="serviceImgs">
												<img src="<?= get_img($row['thumb'],'',1) ;?>" alt="">
											</div>
											
										</td>
										<td class="handle"><?= html_escape($row['name']); ?></td>
										
										<td><?= !empty($row['type']) || $row['type'] != 0?html_escape($row['type']):lang('others'); ?></td>
										<td>
											<?php if(is_access('change-status')==1): ?>
												<a href="javascript:;" data-id="<?= html_escape($row['id']);?>" data-status="<?= html_escape($row['status']);?>" data-table="menu_type" class="label <?= $row['status']==1?'label-success':'label-danger'?> change_status"> <i class="fa <?= $row['status']==1?'fa-check':'fa-close'?>"></i>&nbsp; <?= $row['status']==1?(!empty(lang('live'))?lang('live'):"Live"): (!empty(lang('hide'))?lang('hide'):"Hide");?></a>
											<?php endif; ?>
										</td>

										<td>
											
										<div class="btn-group">
											<a href="javascript:;" class="dropdown-btn dropdown-toggle btn btn-danger btn-sm btn-flat" data-toggle="dropdown" aria-expanded="false">
												<span class="drop_text"><?= lang('action'); ?> </span> <span class="caret"></span>
											</a>

											<ul class="dropdown-menu dropdown-ul" role="menu">
											<?php if(is_access('update')==1): ?>
												<li class="cl-info-soft"><a href="<?= base_url('admin/menu/edit_category/'.html_escape($row['id'])); ?>" ><i class="fa fa-edit"></i> <?= !empty(lang('edit'))?lang('edit'):"edit";?></a></li>
											<?php endif; ?>
											<?php if(is_access('delete')==1): ?>
												<li class="cl-danger-soft"><a href="<?= base_url('delete-item/'.html_escape($row['id']).'/menu_type'); ?>" class=" action_btn" data-msg="<?= !empty(lang('want_to_delete'))?lang('want_to_delete'):"want to delete";?>"><i class="fa fa-trash"></i> <?= !empty(lang('delete'))?lang('delete'):"Delete";?></a></li>
											<?php endif; ?>


											</ul>
										</div><!-- button group -->

									</td>
									</tr>
								<?php $i++; endforeach ?>
								<a href="javascript:;" data-id="menu_type" id="tables"></a>
							</tbody>
						</table>
					</div>
				</div>	
			</div><!-- /.box-body -->
			<div class="box-footer makeChanges text-right" style="display:none;">
				<a href="javascript:;" class="btn btn-secondary reload"><?= lang('save'); ?></a>
			</div>
		</div>
	</div>


	<?php if(isset($is_size) && $is_size == TRUE): ?>
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"> <?= lang('sizes'); ?></h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
					</div>
				</div>
				<!-- /.box-header -->
				<form action="<?= base_url('admin/menu/add_sizes') ?>" method="post" class="skill_form" enctype= "multipart/form-data">
					<div class="box-body">

						<!-- csrf token -->
						<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered">
										<?php $limit = 5 ?>
										<thead>
											<th><?= lang('type'); ?></th>
											<th><?= lang('size'); ?> 1</th>
											<th><?= lang('size'); ?> 2</th>
											<th><?= lang('size'); ?> 3</th>
											<th><?= lang('size'); ?> 4</th>
											<th><?= lang('size'); ?> 5</th>
										</thead>
										<tbody>
											<?php foreach (get_size_type() as $key => $type): ?>

												<tr>
													<td><?= !empty(lang($key))?lang($key):$key ;?></td>
													<?php for($i=1;$i<=$limit;$i++): ?>
														<?php $title = size($key,auth('id'),$i-1); ?>
														<td>

															<input type="text" name="p_size[]" class="form-control" placeholder="<?= lang('size_name'); ?>" value="<?= isset($title['title']) && !empty($title['title'])?$title['title']:'' ;?>">
															<input type="hidden" name="slug[]" value="<?= $type;?><?= $i; ;?>">
															<input type="hidden" name="type[]" value="<?= $key;?>">
														</td>

													<?php endfor; ?>
												</tr>
											<?php endforeach;  ?>


										</tbody>

										

									</table>

								</div>

							</div>
						</div>


					</div><!-- /.box-body -->
					<div class="box-footer">
						<div class="pull-right">
							<?php if(is_access('add')==1): ?>
								<button type="submit" name="register" class="btn btn-primary btn-block btn-flat"><?= !empty(lang('submit'))?lang('submit'):"submit";?></button>
							<?php endif; ?>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php endif;?>
</div>

