<?php if(setting('site.google_analytics_tracking_id') !== null) { ?>
<!-- OPTIONAL - Google Analytics -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', '{{ setting('site.google_analytics_tracking_id') }}', 'auto');
    ga('send', 'pageview');
    setTimeout(function() {
        ga('send', 'event', '15_seconds', 'read');
    },15000);
</script>
<script>
    var elementsToTrack = document.getElementsByClassName('ga-track');
    var i = elementsToTrack.length;
    var gaTrackOnClick = function() {
        ga('send', 'event', this.dataset.gaText || this.textContent.trim());
    <?php if(isset($analyticsCategory)) { ?>
        console.log(this.dataset.gaCategory + ' ' + this.dataset.gaAction + ' ' + this.dataset.gaLabel);
        ga('send', 'event', this.dataset.gaCategory, this.dataset.gaAction, this.dataset.gaLabel, 0);
    <?php } ?>
    };
    while(i--) {
        elementsToTrack[i].addEventListener('click', gaTrackOnClick);
    }
</script>
<?php } ?>
<?php if(env('ENABLE_RAKAM_ANALYTICS') == TRUE) { ?>
<!-- Rakam -->
<script type="text/javascript">
    (function(e,t){var n=e.rakam||{};var r=t.createElement("script");r.type="text/javascript";
        r.async=true;r.src="https://d2f7xo8n6nlhxf.cloudfront.net/rakam.min.js";r.onload=function(){
            e.rakam.runQueuedFunctions()};var o=t.getElementsByTagName("script")[0];o.parentNode.insertBefore(r,o);
        function a(e,t){e[t]=function(){this._q.push([t].concat(Array.prototype.slice.call(arguments,0)));
            return this}}var s=function(){this._q=[];return this};var i=["set","setOnce","increment","unset"];
        for(var c=0;c<i.length;c++){a(s.prototype,i[c])}n.User=s;n._q=[];var u=["init","logEvent","logInlinedEvent","setUserId","getUserId","getDeviceId","setSuperProperties","setOptOut","setVersionName","setDomain","setUserProperties","setDeviceId","onload","onEvent","startTimer"];
        for(var l=0;l<u.length;l++){a(n,u[l])}var m=["getTimeOnPreviousPage","getTimeOnPage","isReturningUser"];
        var v=(e.console?e.console.error||e.console.log:null)||function(){};var d=function(e){
            return function(){v("The method rakam."+e+"() must be called inside rakam.init callback function!");
            }};for(l=0;l<m.length;l++){n[m[l]]=d(m[l])}e.rakam=n})(window,document);
    var event = 'pageview';
    if(window.location.href.indexOf("/search") > -1) {
        event = 'search';
    }
    else if(window.location.href.indexOf("/landing") > -1) {
        event = 'landing';
    }
    else if(window.location.href.indexOf("/article") > -1) {
        event = 'article';
    }
    else if(window.location.href.indexOf("/l/") > -1) {
        event = 'link';
    }
    else if(window.location.href.indexOf("/about") > -1) {
        event = 'about';
    }
    else if(window.location.href.indexOf("/subscribe") > -1) {
        event = 'subscribe';
    }
    else if(window.location.href.indexOf("/help") > -1) {
        event = 'help';
    }
    else if(window.location.href.indexOf("/profile") > -1) {
        event = 'profile';
    }
    else if(window.location.href.indexOf("/settings") > -1) {
        event = 'settings';
    }
    else {
        event = 'pageview';
    }
    rakam.init("<?php echo env('RAKAM_API_KEY') ?>", "<?php if(isset(\Auth::user()->auth0id)) { echo \Auth::user()->auth0id; } else { echo "null"; } ?>", {
        apiEndpoint:"<?php echo env('RAKAM_API_ENDPOINT') ?>",
        includeUtm: true,
        trackClicks: true,
        trackForms: true,
        includeReferrer: true
    }, function() {
        var e = document.documentElement, g = document.getElementsByTagName('body')[0],
            x = window.innerWidth || e.clientWidth || g.clientWidth,
            y = window.innerHeight|| e.clientHeight|| g.clientHeight;
        rakam.logEvent(event, {url: window.location.pathname, time_on_page: rakam.getTimeOnPreviousPage(), returning_session: rakam.isReturningUser(), color_depth: window.screen.colorDepth, viewport: x + ' × ' + y, title: document.title});
    });
    <?php if(isset(\Auth::user()->auth0id)) {  ?>
        rakam.setUserId("<?php echo \Auth::user()->id; ?>");
    rakam.setUserProperties({'auth0id': '<?php echo \Auth::user()->auth0id; ?>'});
    rakam.setUserProperties({'name': '<?php echo \Auth::user()->name; ?>'});
    rakam.setUserProperties({'image': '<?php echo \Auth::user()->picture; ?>'});
    rakam.setUserProperties({'last_active': '<?php echo \Carbon\Carbon::now(); ?>'});
    <?php } ?>
    rakam.startTimer(true);
    rakam.setSuperProperties({platform: 'Web', _ip: true, _user_agent:true, _referrer:document.referrer, resolution: window.screen.width+" × "+window.screen.height}, true);
</script>
<?php } ?>
<?php if(env('ENABLE_COUNTLY_ANALYTICS') == TRUE) { ?>
<script type='text/javascript'>
    //some default pre init
    var Countly = Countly || {};
    Countly.q = Countly.q || [];

    //provide countly initialization parameters
    Countly.app_key = '<?php echo env('COUNTLY_APP_KEY')?>';
    Countly.url = '<?php echo env('COUNTLY_API_URL')?>';

    Countly.q.push(['track_sessions']);
    Countly.q.push(['track_pageview']);
    Countly.q.push(['track_clicks']);
    Countly.q.push(['track_errors']);
    Countly.q.push(['track_links']);
    Countly.q.push(['track_forms']);
    Countly.q.push(['collect_from_forms']);

    //load countly script asynchronously
    (function() {
        var cly = document.createElement('script'); cly.type = 'text/javascript';
        cly.async = true;
        //enter url of script here
        cly.src = '<?php echo env('COUNTLY_SOURCE_URL')?>';
        cly.onload = function(){Countly.init()};
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(cly, s);
    })();
</script>
<noscript><img src='http://159.203.113.73/pixel.png?app_key=6b45e93171f5c8979b0f1cc5676f5332d8be6333&begin_session=1'/></noscript>
<?php } ?>