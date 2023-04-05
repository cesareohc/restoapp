<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= !empty(lang('404'))?lang('404'):'404';?></title>

<link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/style.css">
</head>
<body>
	<div class="error_pages">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="not_found_page">
						<div class="invalid_text">
							<img src="<?= base_url('assets/frontend/images/svg/file.svg');?>" alt="">
							<h4>This content is not available right now</h4>
							<p>When it happens, it's usually because the url is not valid.</p>
							<p>Also it happens for invalid user</p>
							<div class="">
								<a href="<?= base_url();?>" class="btn btn-info c_btn">Go to Home page</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

