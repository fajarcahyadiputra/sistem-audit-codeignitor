<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PT. Suzuki Indomobil Motor</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PT. Suzuki Indomobil Motor">
    <meta name="author" content="PT. Suzuki Indomobil Motor">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('pages/lib/bootstrap/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('pages/lib/font-awesome/css/font-awesome.css') ?>">

    <script src="<?php echo base_url('pages/lib/jquery-1.11.1.min.js') ?>" type="text/javascript"></script>

    <link rel="stylesheet" href="<?php echo base_url('pages/stylesheets/theme.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('pages/stylesheets/premium.css') ?>">
    <style type="text/css">
    #line-chart {
        height: 300px;
        width: 800px;
        margin: 0px auto;
        margin-top: 1em;
    }

    .navbar-default .navbar-brand,
    .navbar-default .navbar-brand:hover {
        color: #fff;
    }
    </style>
</head>

<body class=" theme-blue">

    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <a class="" href="index.html"><span class="navbar-brand">PT. Suzuki Indomobil Motor</span></a>
        </div>

        <div class="navbar-collapse collapse" style="height: 1px;">

        </div>
    </div>
    </div>

    <div class="dialog">
        <div class="panel panel-default">
            <p class="panel-heading no-collapse">Sign In</p>
            <div class="panel-body">
                <?php echo ($message ? '<div class="alert alert-danger text-white">'.$message.'</div>' : '');?>
                <?php echo form_open("auth/login");?>
                <div class="form-group">
                    <label>Username</label>
                    <?php echo form_input($identity);?>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <?php echo form_input($password);?>
                </div>
                <?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-primary pull-right"');?>
                <label class="remember-me"><input type="checkbox"> Remember me</label>
                <div class="clearfix"></div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('pages/lib/bootstrap/js/bootstrap.js') ?>"></script>
</body>
</html>