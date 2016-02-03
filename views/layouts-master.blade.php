<!DOCTYPE html>
<!--
 // TODO: put package header
-->
<html lang="en" class="">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>sroutier/menu-builder demo</title>

    <!-- Bootstrap 3.3.6 -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap theme -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />

    <!-- Font Awesome Icons 4.5.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <style type="text/css">
        .fancybox-margin{
            margin-right:0px;
        }
    </style>

    <style type="text/css">
        body {
            padding-top: 70px;
            padding-bottom: 30px;
        }

        .menu-builder-dropdown .dropdown-menu {
            position: static;
            display: block;
            margin-bottom: 20px;
        }

        .menu-builder-showcase > p > .btn {
            margin: 5px 0;
        }

        .menu-builder-showcase .navbar .container {
            width: auto;
        }
    </style>

    <style type="text/css">
        i.fa-colour-beige {
            color: beige; }

        i.fa-colour-black {
            color: black; }

        i.fa-colour-blue {
            color: blue; }

        i.fa-colour-brown {
            color: brown; }

        i.fa-colour-cyan {
            color: cyan; }

        i.fa-colour-fuchsia {
            color: fuchsia; }

        i.fa-colour-gold {
            color: gold; }

        i.fa-colour-gray {
            color: gray; }

        i.fa-colour-green,
        i.enabled {
            color: green; }

        i.fa-colour-magenta {
            color: magenta; }

        i.fa-colour-navy {
            color: navy; }

        i.fa-colour-olive {
            color: olive; }

        i.fa-colour-orange,
        i.disabled {
            color: orange; }

        i.fa-colour-pink {
            color: pink; }

        i.fa-colour-purple {
            color: purple; }

        i.fa-colour-red,
        i.deletable {
            color: red; }

        i.fa-colour-silver {
            color: silver; }

        i.fa-colour-teal {
            color: teal; }

        i.fa-colour-violet {
            color: violet; }

        i.fa-colour-white {
            color: white; }

        i.fa-colour-yellow {
            color: yellow; }
    </style>


    <!-- Optional bottom section for modals etc... -->
    @yield('head_bottom')

</head>

<body role="document">

    {!! MenuBuilder::renderMenu('root', false, 'Sroutier\MenuBuilder\Handlers\BootstrapDarkFixedMenuHandler')  !!}

    {!! MenuBuilder::renderBreadcrumbTrail(null, 'root', false)  !!}

    @if (session('status_message'))
        <div class="alert alert-success">
            {{ session('status_message') }}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Your Page Content Here -->
    @yield('content')

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- Optional bottom section for modals etc... -->
    @yield('body_bottom')

    <!-- Body Bottom modal dialog-->
    <div class="modal fade" id="modal_dialog" tabindex="-1" role="dialog" aria-labelledby="modal_dialog_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>

</body>
</html>
