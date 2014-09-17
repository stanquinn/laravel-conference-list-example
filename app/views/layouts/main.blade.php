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
</head>
<body>
@section('main')
<div class="row container border-radius">
    <div class="large-4 columns" id="userlist">
    @yield('leftColumn')
    </div>
    <div class="large-8 columns" id="user">
        <div>
            @yield('welcome')
        </div>
        @if (Session::has('message'))
        <div class="flash alert">
            <p>{{ Session::get('message') }}</p>
        </div>
        @endif

        <div class="row">
            <label class="large-6 columns">Name:</label>

            <div class="large-6 columns">{{ $user->name }}</div>
        </div>
        <div class="row">
            <label class="large-6 columns">Company:</label>

            <div class="large-6 columns">{{ $user->company_name }}</div>
        </div>
        <div class="row">
            <label class="large-6 columns">Title:</label>

            <div class="large-6 columns">{{ $user->title }}</div>
        </div>
        <div class="row">
            <label class="large-6 columns">Email:</label>

            <div class="large-6 columns">{{ $user->email }}</div>
        </div>
        <div class="row">
            <label class="large-6 columns">Phone:</label>

            <div class="large-6 columns">{{ $user->phone }}</div>
        </div>
        <div class="row">
            <label class="large-6 columns">Address:</label>

            <div class="large-6 columns">
                <div class="row">
                    <div class="large-12 columns">{{ $user->address }}</div>
                </div>
                <div class="row">
                    <div class="large-12 columns">{{ $user->city }}, {{ $user->state }} {{ $user->zip }}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <label class="large-6 columns">DOB:</label>

            <div class="large-6 columns">{{ $user->dob }}</div>
        </div>

        @yield('adminButtons')
    </div>
</div>
{{ include dirname(dirname(dirname(dirname(__FILE__)))) .  "/public/includes/php/footer-common.php" }}
@yield('scripts')
</body>
</html>