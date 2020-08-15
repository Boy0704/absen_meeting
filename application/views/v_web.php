<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="<?php echo base_url() ?>">

    <title>Absensi Meeting</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/web/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/web/css/shop-homepage.css" rel="stylesheet">
    <!-- jQuery 2.0.2 -->
    <script src="assets/jQuery-2.2.0.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">Absensi Meeting</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <?php include 'page/menu.php'; ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" class="list-group-item"><?php echo $this->session->userdata('nama'); ?></a>
                    <a href="app/logout" class="list-group-item">LogOut</a>
                </div>
                <script type="text/javascript">
                    var auto_refresh = setInterval(
                    function () {
                    $('#load_content').load('<?php echo base_url('app/show_jam') ?>').fadeIn("slow");
                    }, 1000); // refresh setiap 10000 milliseconds
                    </script>

                <center>
                    <div id="load_content"></div>
                </center>
            </div>

            <div class="col-md-9">

                <?php include $konten.'.php'; ?>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <?php include 'page/footer.php'; ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="assets/web/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/web/js/bootstrap.min.js"></script>

</body>

</html>
