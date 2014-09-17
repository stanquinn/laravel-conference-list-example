<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description"
          content="Conference User List"/>
    <meta name="keywords"
          content="conference"/>
    <title>Conference User List</title>
    {{ include dirname(dirname(dirname(dirname(__FILE__)))) .  "/public/includes/php/head-common.php" }}
    @yield('custom_css')
    <style>
        table form { margin-bottom: 0; }
        form ul { margin-left: 0; list-style: none; }
        .error { color: red; font-style: italic; }
        body { padding-top: 20px; }
        #user label {text-align:right;}
    </style>
</head>
<body>
@yield('main')
{{ include dirname(dirname(dirname(dirname(__FILE__)))) .  "/public/includes/php/footer-common.php" }}
@yield('scripts')
</body>
</html>

