<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description"
          content="Conference User List"/>
    <meta name="keywords"
          content="conference"/>
    <title>Conference User List</title>
    @yield('custom_css')
    {{ include dirname(dirname(dirname(dirname(__FILE__)))) .  "/public/includes/php/head-common.php" }}
    <style>
        table form { margin-bottom: 0; }
        form ul { margin-left: 0; list-style: none; }
        .error { color: red; font-style: italic; }
        body { padding-top: 20px; }
        #user label {text-align:right;}
        .container {background-color:grey;color:white;padding:2em;border-radius: 10px;}
    </style>
</head>
<body>

<div class="row border-radius">
    <div class="large-offset-3 large-6 container columns">
        @yield('main')
    </div>
</div>
{{ include dirname(dirname(dirname(dirname(__FILE__)))) .  "/public/includes/php/footer-common.php" }}
@yield('scripts')
</body>
</html>