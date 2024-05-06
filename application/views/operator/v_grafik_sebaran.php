<section class="content-header">
    <h1>
        Menu Grafik
        <small>Grafik Sebaran Surat</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Grafik Sebaran Surat</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <section class="col-lg-12">
            <div class="box box-info">
                <div class="box-header">

                    <center>
                        <h3 style="text-transform:uppercase">&nbsp <strong>SEBARAN SURAT <br /><?php echo $pts->pts_nama; ?></strong></h3>
                    </center>
                </div>
                <div class="box-body">
                    <?php
                    $dosenn = $this->db->query("SELECT * FROM arsip where  arsip_kategori='2' ")->num_rows();
                    ?>
                    <?php
                    $no = 1;
                    $arsip = $this->db->query("SELECT user.user_nama, COUNT(arsip.arsip_user) AS jumlah FROM user LEFT JOIN arsip ON (arsip.arsip_user= user.user_id) where arsip_kategori='2' GROUP BY user_nama");
                    ?>
                    <table class="table table-bordered " id="table-datatable">
                        <tr>
                            <td class="text-center" bgcolor="#CCCCCC">No</td>
                            <td bgcolor="#CCCCCC" class="text-center">Lokasi</td>
                            <td bgcolor="#CCCCCC" class="text-center">Jumlah</td>
                        </tr>
                        <?php
                        foreach ($arsip->result() as $d) {
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td><?php echo $d->user_nama; ?></td>
                                <td class=" text-center"><?php echo $d->jumlah; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td colspan="2" align="center" b>Total</td>
                            <td align="center" bgcolor="#CCCCCC"><?php echo $dosenn ?></td> <a href="<?php echo base_url('surat/masuk_sebaran_pdf/') ?>" target="_blank" class="btn btn-sm btn-warning"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
                            <h5 style="text-transform:uppercase" <strong>Surat Masuk</strong></h5>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <br><br>
                <div class="box-body">
                    <?php
                    $dosenn = $this->db->query("SELECT * FROM arsip where  arsip_kategori='3' ")->num_rows();
                    ?>
                    <?php
                    $no = 1;
                    $arsip = $this->db->query("SELECT user.user_nama, COUNT(arsip.arsip_user) AS jumlah FROM user LEFT JOIN arsip ON (arsip.arsip_user= user.user_id) where   arsip_kategori='3' GROUP BY user_nama");
                    ?>
                    <table class="table table-bordered " id="table-datatable">
                        <tr>
                            <td class="text-center" bgcolor="#CCCCCC">No</td>
                            <td bgcolor="#CCCCCC" class="text-center">Lokasi</td>
                            <td bgcolor="#CCCCCC" class="text-center">Jumlah</td>
                        </tr>
                        <?php
                        foreach ($arsip->result() as $d) {
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td><?php echo $d->user_nama ?></td>
                                <td class=" text-center"><?php echo $d->jumlah ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td colspan="2" align="center" b>Total</td>
                            <td align="center" bgcolor="#CCCCCC"><?php echo $dosenn; ?></td> <a href="<?php echo base_url('surat/keluar_sebaran_pdf/') ?>" target="_blank" class="btn btn-sm btn-warning"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
                            <h5 style="text-transform:uppercase" <strong>Surat Keluar</strong></h5>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="box-body">
                    <?php
                    $dosenn = $this->db->query("SELECT * FROM arsip2 where  arsip_kategori='4' ")->num_rows();
                    ?>
                    <?php
                    $no = 1;
                    $arsip = $this->db->query("SELECT user.user_nama, COUNT(arsip2.arsip_user) AS jumlah FROM user LEFT JOIN arsip2 ON (arsip2.arsip_user= user.user_id) where   arsip_kategori='4' GROUP BY user_nama");
                    ?>
                    <table class="table table-bordered " id="table-datatable">
                        <tr>
                            <td class="text-center" bgcolor="#CCCCCC">No</td>
                            <td bgcolor="#CCCCCC" class="text-center">Lokasi</td>
                            <td bgcolor="#CCCCCC" class="text-center">Jumlah</td>
                        </tr>
                        <?php
                        foreach ($arsip->result() as $d) {
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td><?php echo $d->user_nama ?></td>
                                <td class=" text-center"><?php echo $d->jumlah ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td colspan="2" align="center" b>Total</td>
                            <td align="center" bgcolor="#CCCCCC"><?php echo $dosenn; ?></td> <a href="grafik_sebaran_surat_keluar_pdf.php" target="_blank" class="btn btn-sm btn-warning"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
                            <h5 style="text-transform:uppercase" <strong>Dokumen Lainnya</strong></h5>
                        </tr>
                        </tbody>
                    </table>
                </div> -->
            </div>
        </section>
    </div>
</section>