<section class="content-header">
    <h1>
        Dashboard
        <small>Control Panel Sistem Informasi Arsip</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo $masuk; ?></h3>
                    <p>Jumlah Surat Masuk</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="arsip_masuk.php" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?php echo $keluar; ?></h3>
                    <p>Jumlah Surat Keluar</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="arsip_keluar.php" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3><?php echo $arsip ?></h3>
                    <p>Jumlah Total Surat</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="arsip_keluar.php" class="small-box-footer">&nbsp;</a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3><?php echo $dl ?></h3>
                    <p>Jumlah Dokumen Lain</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="arsip_lain.php" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>
    <div class="row">
        <section class="col-lg-7">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Detail Login</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Nama</th>
                            <td><?php echo $this->session->userdata('user_nama'); ?></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><?php echo $this->session->userdata('user_username'); ?></td>
                        </tr>
                        <tr>
                            <th>Level Hak Akses</th>
                            <td>
                                <span class="label label-success text-uppercase"><?php echo $this->session->userdata('user_level'); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </div>
</section>