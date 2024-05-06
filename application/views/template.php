<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi ARSIP</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
    <link href="<?php echo base_url() ?>assets/img/logo-sikampus.png" rel="icon">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/morris.js/morris.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/Chart.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <style>
        #table-datatable {
            width: 100% !important;
        }

        #table-datatable .sorting_disabled {
            border: 1px solid #f4f4f4;
        }
    </style>
    <div class="wrapper">
        <header class="main-header">
            <a href="index.php" class="logo">
                <span class="logo-mini"><b><i class="fa fa-desktop"></i></b> </span>
                <span class="logo-lg">SI-<strong>Arsip</strong></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle Navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav mai-top-nav header-right-menu">
                        <li class="nav-item">
                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                <span class="admin-name">Sistem Informasi <strong>Arsip</strong> &nbsp;&nbsp; || &nbsp;&nbsp; <?php echo $this->session->userdata('user_nama'); ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <?php
                        $id_user = $this->session->userdata('user_username');
                        $profil = $this->db->query("SELECT * FROM user where user_username='$id_user'")->result();
                        foreach ($profil as $cek) {
                            if ($cek->user_foto == "") {
                        ?>
                                <img src="<?php echo base_url() ?>file/sistem/user.png" class="img-circle">
                            <?php } else { ?>
                                <img src="<?php echo base_url() . 'file/user/' . $cek->user_foto ?>" class="img-circle" style="max-height:45px">
                        <?php }
                        } ?>
                        <!-- <img src="<?php echo base_url() ?>file/sistem/user.png" class="img-circle"> -->
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $this->session->userdata('user_username'); ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <br>
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MENU UTAMA</li>
                    <li>
                        <a href="<?php echo base_url('admin') ?>">
                            <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span>SURAT</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu" style="display: none;">
                            <li>
                                <a href="<?php echo base_url('surat/masuk') ?>">
                                    <i class="fa fa-book"></i> <span>SURAT MASUK</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('surat/keluar') ?>">
                                    <i class="fa fa-book"></i> <span>SURAT KELUAR</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url('surat/doklain') ?>">
                            <i class="fa fa-align-justify"></i> <span>DOKUMEN LAIN</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-table"></i>
                            <span>PENYAJIAN DATA</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu" style="display: none;">
                            <li>
                                <a href="<?php echo base_url('surat/grafik_surat') ?>">
                                    <i class="fa fa-book"></i> <span>GRAFIK</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('surat/grafik_sebaran') ?>">
                                    <i class="fa fa-book"></i> <span>SEBARAN</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url('surat/laporan') ?>">
                            <i class="fa fa-file-archive-o"></i> <span>LAPORAN</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('surat/naskah') ?>">
                            <i class="fa fa-folder"></i> <span>NASKAH SURAT</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('surat/user') ?>">
                            <i class="fa fa-users"></i> <span>DATA USER</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('surat/pass') ?>">
                            <i class="fa fa-lock"></i> <span>PASSWORD</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('login/logout') ?>">
                            <i class="fa fa-sign-out"></i> <span>LOGOUT</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <?php echo $conten ?>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
            </div>

            Copyright &copy; Sistem Informasi-UNIBI 2023
        </footer>
    </div>
    <script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/morris.js/morris.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dist/js/pages/dashboard.js"></script>
    <script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/ckeditor/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            // $(".edit").hide();
            $('#table-datatable').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true,
                "pageLength": 10
            });
        });
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
        }).datepicker("setDate", new Date());
        $('.datepicker2').datepicker({
            autoclose: true,
            format: 'yyyy/mm/dd',
        });
    </script>
</body>

</html>