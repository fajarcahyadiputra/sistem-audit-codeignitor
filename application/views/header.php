<?php
if(!isset($title)){
    if(strstr($page, '/')) {
        $title = explode('/', $page);
        $title = ucwords($title[1] . ' ' . $title[0]);
    } else {
        $title = ucwords($page);
    }
} ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $title ?> - PT. Suzuki Indomobil Motor</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PT. Suzuki Indomobil Motor">
    <meta name="author" content="PT. Suzuki Indomobil Motor">

    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('pages/lib/select2/select2.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('pages/lib/bootstrap/css/bootstrap.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('pages/lib/font-awesome/css/font-awesome.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('pages/lib/datatables/datatables.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('pages/lib/datatables/datatables-1.12.1/css/dataTables.bootstrap.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('pages/lib/datatables/buttons-2.2.3/css/buttons.bootstrap.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('pages/stylesheets/theme.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('pages/stylesheets/premium.css') ?>" type="text/css">
    <!-- <link rel="stylesheet" href="<?php echo base_url('pages/lib/calender/fullcalender.css') ?>"> -->
    <script src="<?php echo base_url('pages/lib/datatables/jquery-1.12.4.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('pages/lib/datatables/datatables.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('pages/lib/datatables/datatables-1.12.1/js/dataTables.bootstrap.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('pages/lib/datatables/buttons-2.2.3/js/buttons.bootstrap.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('pages/lib/datatables/jszip-2.5.0/jszip.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('pages/lib/datatables/pdfmake-0.1.36/pdfmake.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('pages/lib/datatables/pdfmake-0.1.36/vfs_fonts.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('pages/lib/select2/select2.min.js') ?>" type="text/javascript"></script>
    <!-- <script src="<?php echo base_url('pages/lib/calender/fullcalender.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('pages/lib/calender/moment.min.js') ?>" type="text/javascript"></script> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="<?php echo base_url('pages/lib/jQuery-Knob/js/jquery.knob.js') ?>" type="text/javascript"></script>
    
    <style type="text/css">
    #line-chart {
        height: 300px;
        width: 800px;
        margin: 0px auto;
        margin-top: 1em;
    }
    #datatablenya_filter {float:right;}
    .navbar-default .navbar-brand,
    .navbar-default .navbar-brand:hover {
        color: #fff;
    }
    </style>
    <script type="text/javascript">
    $(function() {
        var uls = $('.sidebar-nav > ul > *').clone();
        uls.addClass('visible-xs');
        $('#main-menu').append(uls.clone());
    });
    </script>
</head>

<body class=" theme-blue">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">


    <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
    <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
    <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
    <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!-->

    <!--<![endif]-->

    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="" href="index.html"><span class="navbar-brand">PT. Suzuki Indomobil Motor</span></a>
        </div>

        <div class="navbar-collapse collapse" style="height: 1px;">
            <ul id="main-menu" class="nav navbar-nav navbar-right">
                <li class="dropdown hidden-xs">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user padding-right-small"
                            style="position:relative;top: 3px;"></span> <?php echo $this->ion_auth->user()->row()->username ?>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="<?php echo base_url('auth/logout') ?>">Keluar</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
    </div>