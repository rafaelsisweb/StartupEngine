<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('site.title') }}</title>

    <!-- Core CSS Files -->
    <link href="/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/css/now-ui-kit.css?v=1.1.0" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>

    <!-- jQuery -->
    <script src="/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>

    <!-- Vue -->
    <script src="https://unpkg.com/vue"></script>

    <!--   Core JS Files   -->
    <script src="/js/core/popper.min.js" type="text/javascript"></script>
    <script src="/js/core/bootstrap.min.js" type="text/javascript"></script>

    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="/js/plugins/bootstrap-switch.js"></script>

    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="/js/plugins/nouislider.min.js" type="text/javascript"></script>

    <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
    <script src="/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>

    <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
    <script src="/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>

    <!-- Vue Chartkick -->
    <script src="https://unpkg.com/chart.js@2.5.0/dist/Chart.bundle.js"></script>
    <script src="https://unpkg.com/chartkick@2.2.3"></script>
    <script src="https://unpkg.com/vue-chartkick@0.2.0/dist/vue-chartkick.js"></script>

    <!-- Simple MDE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

    <!-- App-wide custom styles -->
    <style>
        .btn-outline {
            border: 1px solid royalblue !important;
            background: #fff !important;
            color: royalblue;
        }

        .btn-outline:hover {
            color: #222;
        }

        .btn-secondary {
            background: royalblue !important;
        }

        .btn-raised {
            box-shadow: 0px 5px 7px rgba(0,0,0,0.15) !important;
        }

        .btn-secondary-outline {
            border: 1px solid royalblue !important;
            color: royalblue !important;
            background: transparent !important;
        }

        .bg-gradient-blue {
            background: royalblue;
            background: -webkit-linear-gradient(to right, royalblue, #00adff) !important;
            background: linear-gradient(to right, royalblue, #00adff) !important;
            color: #fff !important;
        }

        .bg-gradient-orange {
            background: #ff9966;
            background: -webkit-linear-gradient(to top right, #ff5e62, #ff9966);
            background: linear-gradient(to top right, #ff5e62, #ff9966);
        }

        .bg-gradient-multi {
            background: #ff9966;
            background: -webkit-linear-gradient(to top right, #ff5e62, #2dbeff);
            background: linear-gradient(to top right, #ff5e62, #2dbeff);
        }

        .bg-gradient-purple {
            background: #8b69ff;
            background: -webkit-linear-gradient(to top right, #ff35a4, #350090);
            background: linear-gradient(to top right, #ff35a4, #350090);
        }

        .bg-gradient-blue .btn, .bg-gradient-blue .btn {
            color: #fff !important;
            border-color: #fff !important;
        }

        .navbar-transparent #nav-cta {
            background: #fff;
            color: royalblue !important;
        }

        .h1-seo {
            font-weight: 400 !important;
        }

        .card {
            border-radius: 5px !important;
        }

        .card h4 {
            margin-top: 10px !important;
            text-align: center;
        }

        @media screen and (max-width: 991px) {
            .sidebar-collapse .navbar-collapse .navbar-nav:not(.navbar-logo) .nav-link:not(.btn) {
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            .sidebar-collapse .navbar .navbar-nav {
                margin-top: 15px !important;
            }
        }

        h1.title {
            font-weight: 400 !important;
        }

        h2.title, h3, h4 {
            font-weight: 300 !important;
        }

        h1, h2, h3, h4 {
            text-shadow: 0px 2px 13px rgba(0, 0, 0, 0.17) !important;
        }

        .sidebar-collapse .navbar-collapse:before {
            background: none; /* fallback for old browsers */
        }

        .page-header[filter-color="orange"] {
            background: rgba(44, 44, 44, 0.0);
            background: -webkit-linear-gradient(90deg, rgba(44, 44, 44, 0), rgba(224, 23, 3, 0.6));
            background: -o-linear-gradient(90deg, rgba(44, 44, 44, 0), rgba(224, 23, 3, 0.6));
            background: -moz-linear-gradient(90deg, rgba(44, 44, 44, 0), rgba(224, 23, 3, 0.6));
            background: linear-gradient(0deg, rgba(44, 44, 44, 0), rgba(224, 23, 3, 0.6));
        }

        #disqus_thread {
            padding: 15px;
        }

        footer {
            position: absolute;
            bottom: 0px;
            width: 100%;
            left: 0px;
            color: #222;
            background: #fff !important;
        }

        footer a {
            color: #333;
        }

        footer a:hover {
            color: #111;
        }

        #mobile-nav-brand {
            display: none;
        }

        @media screen and (max-width: 991px) {
            #navigation .nav-link:not(.btn) {
                color: royalblue;
                background: #fff;
                margin-bottom: 5px;
                border: none;
                border-radius: 3px !important;
                box-shadow: 0px 7px 18px rgba(0, 0, 0, 0.1);
                text-align: center !important;
            }

            #nav-cta {
                color: #fff !important;
            }
        }

        @media screen and (min-width: 991px) {
            .hiddenOnMobile {
                display: auto !important;
            }

            .hiddenOnDesktop {
                display: none !important;
            }
        }

        @media screen and (max-width: 991px) {
            .hiddenOnMobile {
                display: none !important;
            }

            .hiddenOnDesktop {
                display: auto !important;
            }

            #mobile-nav-brand {
                display: block;
            }

            #navigation .nav-link:not(.btn):hover {
                background: #fff !important;
                color: #222 !important;
            }

            .navbar-transparent #nav-cta {
                color: #fff !important;
            }

            #navigation {
                background: #0e142b !important;
                box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 120px !important;
            }
        }

        #nav-cta {
            background: royalblue !important;
            color: #fff !important;
        }

        #articles-index .page-header:before {
            background: none !important;
        }

        .page-header h1, .main h1 {
            font-weight: 600 !important;
        }

        .page-header h2, .main h2, .page-header h3, .main h3, .page-header h4, .main h4, .page-header h5, .main h5 {
            font-weight: 400 !important;
        }

        .bg-gradient {
            background-image: linear-gradient(-45deg, #499ee6 0%, #9064d6 100%);
        }

        body {
            min-height: 100vh;
            overflow: hidden;
        }

        body > .container-fluid > .card {
            max-height: 90vh;
            overflow-y: scroll !important;
        }

        td .btn-group {
            opacity: 0;
            transition: opacity 0.2s;
        }

        tr:hover td .btn-group {
            opacity: 1;
        }

        .card:first-of-type {
            background: none;
            margin-top: 0px !important;
        }

        .card:first-of-type .row {
            background: #fff;
            min-height: 100%;
        }

        #app > .container-fluid > .card .card-header{
            background: #2b2b2b !important;
            font-weight:600 !important;
            border-bottom:2px solid #eaeaea;
            color: #fff;
            position: fixed;
            top: 0px;
            left: 0px;
            border-radius:0px;
            width: 100% !important;
            z-index: 3 !important;
            box-shadow:0px 3px 5px rgba(16, 25, 186, 0.15);
        }

        .main .card-header {
            background: #fff !important;
            position: relative !important;
            box-shadow: none;
            border-bottom: 1px solid #ddd;
            border-bottom:2px solid rgb(255, 209, 133) !important;
            width: 100% !important;
            color: #333 !important;
            top: 0px !important;
            text-align: center;
            left: 0px !important;
            z-index: auto !important;
            box-shadow:none !important;
            font-weight: 600;
        }

        nav:first-of-type, main {
            margin-top: 65px !important;
        }

        .btn.dropdown-toggle:first-of-type {
            background: #fff !important;
            color: #222 !important;
            border: none !important;
        }

        .dropdown-menu-right {
            position: absolute !important;
            right: -20px !important;
            top: 5px !important;
            top: 5px !important;
            transition: top 0s, opacity 0.5s, margin-top 0.5s;
            -webkit-transition: top 0s, opacity 0.5s, margin-top 0.5s;
            margin-top: 15px;
            opacity: 0;
        }

        .dropdown-menu.show {
            opacity: 1;
            margin-top: 0px !important;
            transition: top 0.25s, opacity 0.5s, margin-top 0.5s;
            -webkit-transition: top 0.25s, opacity 0.5s, margin-top 0.5s;
        }

        .card-body .row {
            height: auto;
            min-height: inherit !important;
        }

        main {
            min-height: 100vh !important;
            background: #fff;
        }

        .dropdown-menu {
            z-index: 999999 !important;
            width: auto !important;
            left: 0px;
            top: 0px;
            position: absolute;
            transition: left 0s, top 0s;
        }

        .dropdown-menu-right {
            max-width: 200px;
        }

        nav .btn-secondary-outline {
            color: #111 !important;
        }

        tr {
            -webkit-transition: background 0.5s;
            transition: background 0.5s;
        }

        .card tr:hover {
            color: #111 !important;
            background: #f7f9fd !important;
        }

        table th {
            border-top: none !important;
        }

        thead tr:hover {
            box-shadow: none !important;
        }

        .main th:first-of-type, .main td:first-of-type {
            width: 150px !important;
        }

        .main .card {
            border:1px solid #ddd !important;
            box-shadow:none !important;
        }

        .main .card > .card-header {
            border-radius:5px 5px 0px 0px !important;
        }

        .dropdown-item:hover {
            background: none !important;
            color: royalblue;
            cursor: pointer;
        }

        @media (max-width: 991px) {
            .hiddenOnMobile {
                display: none !important;
            }
        }

        @media (min-width: 991px) {
            .hiddenOnDesktop {
                display: none !important;
            }
        }

        .badge-status {
            background: #555;
            border: 1px solid #555;
            color: #fff;
            min-width: 100px;
            padding: 3px 8px;
            font-weight: 400;
            border-radius: 4px;
        }

        .badge-status-disabled {
            background: #999;
            border: 1px solid #999;
            color: #fff;
            min-width: 100px;
            padding: 3px 8px;
            font-weight: 400;
            border-radius: 4px;
        }

        .badge-date, .badge-category {
            background: #fff;
            border: 1px solid #999;
            color: #999;
            min-width: 100px;
            padding: 3px 8px;
            font-weight: 400;
            border-radius: 4px;
        }

        .updated_at_column, .status_column {
            width: 150px !important;
            border-right: 1px solid #eee;
            text-align: center;
        }

        .badge-date, .badge-status, .badge-status-disabled, .badge-category {
            margin-top: 10px !important;
            margin-bottom: 10px !important;
        }

        tr:first-of-type td {
            border-top: none !important;
        }

        th {
            background: #fff !important;
        }

        .CodeMirror, .CodeMirror-scroll {
            min-height: 30px;
        }

        #app > .container-fluid:first-of-type {
            margin:0px !important;
            padding:0px !important;
        }

        #app > .container-fluid:first-of-type > .card > .card-header {
            z-index:99 !important;
        }

        #app .container-fluid > .card {
            border-radius:0px !important;
            margin-bottom:0px !important;
            height:100vh !important;
            padding:0px !important;
            float:left;
        }

        #app .container-fluid > .card > .row {
            overflow: scroll !important;
            height: 100vh !important;
        }

        .btn-group .btn-round{
            border-radius:0px !important;
            border-left-width:0px!important;
        }

        .btn-group .btn-round:first-of-type {
            border-radius:25px 0px 0px 25px !important;
            border-left-width:1px!important;
        }

        .btn-group .btn-round:last-of-type {
            border-radius:0px 25px 25px 0px !important;
        }


    </style>

    @yield('styles')
</head>
<body>
<div id="app" style="display: block; overflow-y: scroll !important; position: absolute;top: 0px; left: 0px; width: 100%; height: 100%;margin:0px !important;padding:0px !important;">
    @yield('content')
</div>

<!-- UX -->
<script type="text/javascript">
    function scrollToMore() {
        if ($('#more').length != 0) {
            $("html, body").animate({
                scrollTop: $('#more').offset().top - 75
            }, 500);
        }
    }

    $(document).ready(function () {

    });
</script>

<!-- Mixpanel -->
<script type="text/javascript">
    (function (e, a) {
        if (!a.__SV) {
            var b = window;
            try {
                var c, l, i, j = b.location, g = j.hash;
                c = function (a, b) {
                    return (l = a.match(RegExp(b + "=([^&]*)"))) ? l[1] : null
                };
                g && c(g, "state") && (i = JSON.parse(decodeURIComponent(c(g, "state"))), "mpeditor" === i.action && (b.sessionStorage.setItem("_mpcehash", g), history.replaceState(i.desiredHash || "", e.title, j.pathname + j.search)))
            } catch (m) {
            }
            var k, h;
            window.mixpanel = a;
            a._i = [];
            a.init = function (b, c, f) {
                function e(b, a) {
                    var c = a.split(".");
                    2 == c.length && (b = b[c[0]], a = c[1]);
                    b[a] = function () {
                        b.push([a].concat(Array.prototype.slice.call(arguments,
                            0)))
                    }
                }

                var d = a;
                "undefined" !== typeof f ? d = a[f] = [] : f = "mixpanel";
                d.people = d.people || [];
                d.toString = function (b) {
                    var a = "mixpanel";
                    "mixpanel" !== f && (a += "." + f);
                    b || (a += " (stub)");
                    return a
                };
                d.people.toString = function () {
                    return d.toString(1) + ".people (stub)"
                };
                k = "disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config reset people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
                for (h = 0; h < k.length; h++)e(d, k[h]);
                a._i.push([b, c, f])
            };
            a.__SV = 1.2;
            b = e.createElement("script");
            b.type = "text/javascript";
            b.async = !0;
            b.src = "undefined" !== typeof MIXPANEL_CUSTOM_LIB_URL ? MIXPANEL_CUSTOM_LIB_URL : "file:" === e.location.protocol && "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//) ? "https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js" : "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";
            c = e.getElementsByTagName("script")[0];
            c.parentNode.insertBefore(b, c)
        }
    })(document, window.mixpanel || []);
    mixpanel.init("c3af8ab4b008e22adf4772978aca66ec");

    function clickEvent(id, name, title, url, type, src, text) {
        mixpanel.track("click", {
            "id": id,
            "name": name,
            "title": title,
            "url": url,
            "type": type,
            "src": src,
            "text": text
        });
    }

    $(document).ready(function () {
        $("a, button, .btn, input, img").click(function () {
            var id = $(this).attr('id');
            var name = $(this).attr('name');
            var title = $(this).attr('title');
            var url = $(this).attr('href');
            var type = $(this).attr('type');
            var src = $(this).attr('src');
            var text = $(this).html();
            clickEvent(id, name, title, url, type, src, text);
        });
    });

</script>

<!--  App -->
<script src="/js/app.js"></script>

</body>
</html>