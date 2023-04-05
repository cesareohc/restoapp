<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">New Version Installer</h4>
</div>
<div class="modal-body text-center">
	<div class="modalBody">
		<h4><i class="fa fa-smile-o fa-3x"></i></h4>
		<h4>A New Version Found v<?= $this->config->item('app_version');?></h4>
		<p class="text-muted">Currently You are using Version v<?= settings()['version'];?></p>
	</div>
</div>
<div class="modal-footer" style="display:none;">
	<button type="button" class="btn btn-primary startUpdate" data-update="1">Start Updating</button>
</div>