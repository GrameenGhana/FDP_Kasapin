<!DOCTYPE html>
@langrtl
    <html lang="{{ app()->getLocale() }}" dir="rtl">
@else
    <html lang="{{ app()->getLocale() }}">
@endlangrtl
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', 'FDP')">
    <meta name="author" content="@yield('meta_author', 'Grameen Foundation')">
    @yield('meta')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')

    <style type="text/css">

        @font-face {
            font-family: "simple-line-icons";
            src: {{'url(/fonts/vendor/simple-line-icons/Simple-Line-Icons.eot?f33df365d6d0255b586f2920355e94d7)'}};
            src: url(/fonts/vendor/simple-line-icons/Simple-Line-Icons.eot?f33df365d6d0255b586f2920355e94d7) format("embedded-opentype"), url(/fonts/vendor/simple-line-icons/Simple-Line-Icons.woff2?0cb0b9c589c0624c9c78dd3d83e946f6) format("woff2"), url(/fonts/vendor/simple-line-icons/Simple-Line-Icons.ttf?d2285965fe34b05465047401b8595dd0) format("truetype"), url(/fonts/vendor/simple-line-icons/Simple-Line-Icons.woff?78f07e2c2a535c26ef21d95e41bd7175) format("woff"), url(/fonts/vendor/simple-line-icons/Simple-Line-Icons.svg?2fe2efe63441d830b1acd106c1fe8734) format("svg");
            font-weight: normal;
            font-style: normal;
        }
    </style>
    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    {{ style(mix('css/backend.css')) }}

    @stack('after-styles')

</head>

<body class="{{ config('backend.body_classes') }}">
    @include('backend.includes.header')

    <div class="app-body">
        @include('backend.includes.sidebar')

        <main class="main">
            @include('includes.partials.logged-in-as')
            {!! Breadcrumbs::render() !!}

            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="content-header">
                        @yield('page-header')
                    </div><!--content-header-->

                    @include('includes.partials.messages')
                    @yield('content')
                </div><!--animated-->
            </div><!--container-fluid-->
        </main><!--main-->

        @include('backend.includes.aside')
    </div><!--app-body-->

    @include('backend.includes.footer')

    <!-- Scripts -->
    @stack('before-scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/backend.js')) !!}
    @stack('after-scripts')

</body>
</html>
