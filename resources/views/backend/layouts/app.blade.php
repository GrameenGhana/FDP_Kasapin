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
       $(document).ready(function () {

          $('#parent_div').show();
          $('#level_div').hide();

       });
        $( "select#admin_level" )
            .change(function () {
                var str = "";
                var level = 0;
               $("div#add_level").empty();
                $( "select option:selected" ).each(function() {
                    str += $( this ).text() + " ";
                    level = parseInt(str);

                    for(i=1;i<=level;i++)
                    {

                        $("div#add_level").append('<label for='+'level'+i+' '+'class='+'col-md-2 form-control-label'+'>'+'level'+' '+i+'</label>')
                            .append('<input type="text" name=levels[] required/><br>'+'\n');
                    }
                });
            })
            .change();

        $( "select#admin_level_1" )
            .change(function () {
                $( "select#admin_level_1  option:selected" ).each(function() {
                    var str = $(this).val();
                    var country = $("#country_id").val();

                    $('#admin_select').empty();

                    if(str == '1'){

                        $("#parent").val('none');
                        $('#parent_div').show();
                        $('#level_div').hide();

                    }
                    else{

                       $.get('/admin/cadmin/upper/'+str+'/'+country,function(data,status){
                           var levels = data;
                           $('#parent_div').hide();
                           $('#level_div').show();
                           if(status == 'success')
                           {
                               var count;
                               for( count=0;count<levels.length;count++)
                               {

                                   var level = levels[count];
                                  $('#admin_select').append($('<option>',{value:level.id,text:level.name}));
                               }

                               $("#parent").val($('#admin_select').val());
                           }
                       });
                    }


                });
            }).change();


       $( "select#admin_select" )
           .change(function () {
               var  value = $(this).val();
           if(value== null)
           {
               $('#parent').val('none');
           }
           else {
               $('#parent').val($(this).val());
           }

           }).change();

    </script>
</body>
</html>
