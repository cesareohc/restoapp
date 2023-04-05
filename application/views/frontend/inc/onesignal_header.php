<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" defer></script>
<script>
	window.OneSignal = window.OneSignal || [];
	OneSignal.push(function() {
		OneSignal.init({
			appId: `<?= $appID ;?>`,
		});
	});
</script>