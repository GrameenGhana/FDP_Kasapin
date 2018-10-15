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

    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')

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
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script>
        $( "select" )
            .change(function () {
                var str = "";
                var level = 0;
              // $("div#add_level").remove();
                $( "select option:selected" ).each(function() {
                    str += $( this ).text() + " ";
                    level = parseInt(str);

                    for(i=1;i<=level;i++)
                    {
                        alert(""+i) ;
                        $("div#add_level").append('<label for='+'level'+i+' '+'class='+'col-md-2 form-control-label'+'>'+'level'+' '+i+'</label>')
                            .append('<input type="text" name=levels[] required/><br>'+'\n');
                    }
                });
                //$( "div" ).text( str );
                alert(str);
            })
            .change();
    </script>
</body>
</html>
