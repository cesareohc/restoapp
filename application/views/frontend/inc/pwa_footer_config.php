<?php if(isset($page) && $page !='Profile'): ?>

<?php $pwa2 = !empty($settings['pwa_config'])?json_decode($settings['pwa_config']):''; ?>
<?php if(isset($settings['is_pwa']) && $settings['is_pwa']==1 && isset($pwa2->is_pwa_active) && $pwa2->is_pwa_active==1): ?>
	<div class="add-to-2">
		<div class="add-to-area">
				<a href="javascript:;" class="pwaClose"><i class="fa fa-close"></i></a>
	    	<div class="pt-7 pwaContent">
	    		<img src="<?= base_url(!empty($pwa2->logo)? $pwa2->logo:"uploads/pwa/logo.png");?>" alt="">
	    		<div class="pwaDetails">
	    			 <h4><?= $pwa2->title ;?></h4>
	    		  <p><?= base_url(); ;?></p>
	    		</div>
	    	</div>
			<button class="add-to-btn-2 btn btn-primary"><?= lang('add_to_home_screen'); ?></button>
		</div>
	</div>
	<script type="text/javascript">
		if ('serviceWorker' in navigator) {
			navigator.serviceWorker.register('/service-worker-2.js?r=', {
				scope: `/`
			}).then(function (registration) {
          // Registration was successful
          console.log('PWA: ServiceWorker registration successful with scope: ', registration.scope);
        }, function (err) {
          // registration failed :(
          console.log('PWA: ServiceWorker registration failed: ', err);
        });
		}

		let deferredPrompt;
		var div = document.querySelector('.add-to-2');
		var button = document.querySelector('.add-to-btn-2');
		var button2 = document.querySelector('.pwaClose');
		div.style.display = 'none';

		window.addEventListener('beforeinstallprompt', (e) => {
      // Prevent Chrome 67 and earlier from automatically showing the prompt
      e.preventDefault();
      // Stash the event so it can be triggered later.
      deferredPrompt = e;
      div.style.display = 'block';

      setTimeout(function(){ div.style.display='none'; }, 5000);


	      button2.addEventListener('click', (e) => {
	      	 div.style.display = 'none';

	      });



      button.addEventListener('click', (e) => {
      // hide our user interface that shows our A2HS button
      div.style.display = 'none';
      // Show the prompt
      deferredPrompt.prompt();
      // Wait for the user to respond to the prompt
      deferredPrompt.userChoice
      .then((choiceResult) => {
      	if (choiceResult.outcome === 'accepted') {
      		console.log('User accepted the A2HS prompt');
      	} else {
      		console.log('User dismissed the A2HS prompt');
      	}
      	deferredPrompt = null;
      });
    });
    });

  </script>
<?php endif;?>
<?php endif;?>


<?php if(isset($slug)): ?>
<?php $u_info = get_user_info_by_slug($slug); ?>
<?php $u_settings = $this->common_m->get_user_settings($u_info['id']); ?>
		<!-- footer pwa -->
<?php $pwa = !empty($u_settings['pwa_config'])?json_decode($u_settings['pwa_config']):''; ?>
<?php if(isset($settings['is_pwa']) &&$settings['is_pwa']==1 && (isset($pwa->is_pwa_active) && $pwa->is_pwa_active==1)): ?>
		<?php if(is_feature($u_info['id'],'pwa-push')==1 && is_active($u_info['id'],'pwa-push')): ?>
			<div class="add-to">
				   <div class="add-to-area">
				   	<a href="javascript:;" class="pwaClose"><i class="fa fa-close"></i></a>
				    	<div class="pt-7 pwaContent">
				    		<img src="<?= base_url(!empty($pwa->logo)? $pwa->logo:"uploads/pwa/avatar.png");?>" alt="">
				    		<div class="pwaDetails">
				    			 <h4><?= $pwa->title ;?></h4>
				    		   <p><?= url($slug); ;?></p>
				    		</div>
				    	</div>
				   	 	<button class="add-to-btn btn btn-primary"><?= lang('add_to_home_screen'); ?></button>
				   </div>
				</div>
				<script type="text/javascript">
				  if ('serviceWorker' in navigator) {
				        navigator.serviceWorker.register('/service-worker.js?r=<?= $slug ;?>', {
				            scope: `.`
				        }).then(function (registration) {
				            // Registration was successful
				            console.log('PWA: ServiceWorker registration successful with scope: ', registration.scope);
				        }, function (err) {
				            // registration failed :(
				            console.log('PWA: ServiceWorker registration failed: ', err);
				        });
				    }

				    let deferredPrompt;
				    var div = document.querySelector('.add-to');
				    var button = document.querySelector('.add-to-btn');
				    var button2 = document.querySelector('.pwaClose');
				    div.style.display = 'none';

				    window.addEventListener('beforeinstallprompt', (e) => {
				      // Prevent Chrome 67 and earlier from automatically showing the prompt
				      e.preventDefault();
				      // Stash the event so it can be triggered later.
				      deferredPrompt = e;
				      div.style.display = 'block';

				      setTimeout(function(){ div.style.display='none'; }, 5000);
				      	button2.addEventListener('click', (e) => {
				      	 div.style.display = 'none';

				      });

				      button.addEventListener('click', (e) => {
				      // hide our user interface that shows our A2HS button
				      div.style.display = 'none';
				      // Show the prompt
				      deferredPrompt.prompt();
				      // Wait for the user to respond to the prompt
				      deferredPrompt.userChoice
				        .then((choiceResult) => {
				          if (choiceResult.outcome === 'accepted') {
				            console.log('User accepted the A2HS prompt');
				          } else {
				            console.log('User dismissed the A2HS prompt');
				          }
				          deferredPrompt = null;
				        });
				    });
				    });

				</script>
			<?php endif;?><!-- is_feature -->
<?php endif;?>
<?php endif;?>
	<!-- footer pwa -->