<!doctype html>
<html class="no-js" lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- <link rel="icon" sizes="16x16" type="image/png" href="{{route('frontend.index')}}/img/favicon_icon/{{settings()->favicon}}"> --}}
        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Default Description')">
        <meta name="author" content="@yield('meta_author', 'ZumhiCache')">
        <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
        @yield('meta')

        <!-- Styles -->
        @yield('before-styles')
        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        @langrtl
            {{ Html::style(getRtlCss('css/backend.css')) }}
        @else
            {{ Html::style('css/backend.css') }}
        @endlangrtl

        {{ Html::style('css/backend-custom.css') }}
        @yield('after-styles')
        {{ Html::style('css/plugin/datatables/jquery.dataTables.min.css') }}
        {{ Html::style('css/backend/plugin/datatables/dataTables.bootstrap.min.css') }}
        {{ Html::style('css/plugin/datatables/buttons.dataTables.min.css') }}
        {{ Html::style('js/select2.css') }}
        {{ Html::style('css/bootstrap.min.css') }}
        {{ Html::style('css/loader.css') }}
        {{ Html::style('css/bootstrap-datetimepicker.min.css') }}

        <!-- Html5 Shim and Respond.js IE8 support of Html5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        {{ Html::script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}
        {{ Html::script('https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js') }}
        <![endif]-->

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([ 'csrfToken' => csrf_token() ]) !!};
        </script>
        <?php
            if (!empty($google_analytics)) {
                echo $google_analytics;
            }
        ?>
    </head>
    <body class="skin-{{ config('backend.theme') }} {{ config('backend.layout') }}">
        <div class="loading" style="display:none"></div>
        @include('includes.partials.logged-in-as')

        <div class="wrapper" id="app">
            @include('backend.includes.header')
            @include('backend.includes.sidebar-dynamic')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    @yield('page-header')
                    <!-- Breadcrumbs would render from routes/breadcrumb.php -->
                    @if(Breadcrumbs::exists())
                        {!! Breadcrumbs::render() !!}
                    @endif
                </section>

                <!-- Main content -->
                <section class="content">
                    @include('includes.partials.messages')
                    @yield('content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            @include('backend.includes.footer')
        </div><!-- ./wrapper -->

        <!-- JavaScripts -->
        @yield('before-scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        {{ Html::script('js/moment.min.js') }}
        {{ Html::script('js/bootstrap-datepicker.min.js') }}
        {{ Html::script('js/bootstrap-datetimepicker.min.js') }}
        {{ Html::script('js/select2/select2.js') }}
        {{ Html::script('js/tinymce/tinymce.min.js') }}
        {{ Html::script('js/plugin/sweetalert.min.js') }}
        {{ Html::script('js/backend/custom-file-input.js') }}
        {{ Html::script('js/backend/notification.js') }}
        {{ Html::script('js/backend/admin.js') }}
        {{-- Html::script('js/backend-custom.js') --}}
        @yield('after-scripts')
    </body>
</html>