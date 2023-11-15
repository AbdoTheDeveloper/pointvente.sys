    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Alkhadim  @yield("title")</title>

    <!-- Prevent the demo from appearing in search engines (REMOVE THIS) -->
    <meta name="robots" content="noindex">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ URL::to('/')."/" }}">


    <!-- Perfect Scrollbar -->
    <link type="text/css" href="{{url('assets/vendor/perfect-scrollbar.css')}}" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="{{url('assets/css/material-icons.css')}}" rel="stylesheet">
    <link type="text/css" href="{{url('assets/css/material-icons.rtl.css')}}" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link type="text/css" href="{{url('assets/css/fontawesome.css')}}" rel="stylesheet">
    <link type="text/css" href="{{url('assets/css/fontawesome.rtl.css')}}" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="{{url('assets/css/app.css')}}" rel="stylesheet">
    <link type="text/css" href="{{url('assets/css/app.rtl.css')}}" rel="stylesheet">

        @yield("style")
