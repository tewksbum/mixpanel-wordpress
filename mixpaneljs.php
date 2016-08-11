<!-- start Mixpanel -->
<script type="text/javascript">
	(function(e,b){if(!b.__SV){var a,f,i,g;window.mixpanel=b;b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
	for(g=0;g<i.length;g++)f(c,i[g]);b._i.push([a,e,d])};b.__SV=1.2;a=e.createElement("script");a.type="text/javascript";a.async=!0;a.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"file:"===e.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";f=e.getElementsByTagName("script")[0];f.parentNode.insertBefore(a,f)}})(document,window.mixpanel||[]);

	function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
	}

	mixpanel.init("<?php echo $settings['token_id']; ?>");
	mixpanel.identify();

	let raf = getParameterByName('raf');
  let ls = getParameterByName('ls');
	mixpanel.people.set_once({ leadSource: raf || ls || 'organic' });
  mixpanel.register_once({ leadSource: raf || ls || 'organic' });
	if (raf) {
      mixpanel.people.set({ raf });
      mixpanel.register({ raf });
  }

</script>

<?php
/*
 * https://gist.github.com/LeCoupa/916c7518df5af0c0b8f1
 * Apply mixpanel settings from Wordpress admin settings page
 */
?>
<script type="text/javascript">
mixpanel.set_config({
	// cross_subdomain_cookie: <?php echo $settings['subdomain_cookie'] === 'true' ? 'true' : 'false'; ?>,
	cross_subdomain_cookie: 'true',
	debug: <?php echo $settings['debug_mode'] === 'true' ? 'true' : 'false'; ?>
});
</script>
<!--q end Mixpanel -->
