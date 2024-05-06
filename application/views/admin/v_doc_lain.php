<section class="content-header">
    <h1>
        Menu Dokumen Lain
        <small>Data Dokumen Lain</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Dokumen Lain</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <section class="col-lg-12">
            <div class="box box-info">
                <div class="box-header">
                    <?php if (isset($_SESSION['error'])) { ?>
                        <!-- If Error -->
                        <div class="alert alert-success alert-dismissible fade in">
                            <i class="fa fa-warning"></i> &nbsp;DATA YANG ANDA INPUT SUDAH ADA DI DATABASE. <strong><?php echo $_SESSION['error'] ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- End of If Error -->
                    <?php unset($_SESSION['error']);
                    } ?>
                    <?php
                    if (isset($_GET['alert'])) {
                        if ($_GET['alert'] == "gagal") {
                    ?>
                            <div class="alert alert-success alert-dismissible fade in">
                                <i class="fa fa-warning"></i> &nbsp;DATA GAGAL DISIMPAN. <strong>CEK KEMBALI DATA ATAU DOKUMEN YANG ANDA INPUT </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <?php
                    if (isset($_GET['alert'])) {
                        if ($_GET['alert'] == "berhasil") {
                    ?>
                            <div class="alert alert-success alert-dismissible fade in">
                                <i class="fa fa-refresh"></i> &nbsp;SIMPAN DATA <strong>BERHASIL </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <?php
                    if (isset($_GET['alert'])) {
                        if ($_GET['alert'] == "hapus") {
                    ?>
                            <div class="alert alert-success alert-dismissible fade in">
                                <i class="fa fa-trash"></i> &nbsp;HAPUS DATA <strong>BERHASIL </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <div class="btn-group pull-right">
                        <a href="<?php echo base_url('surat/doklain_export_pdf/') ?>" target="_blank" class="btn btn-sm btn-warning"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
                        <a href="<?php echo base_url('surat/doklain_export/') ?>" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i> &nbsp EXPORT EXCEL</a>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped" id="table-datatable">
                        <thead>
                            <tr>
                                <th style="text-align:center" width="1%">No</th>
                                <th style="text-align:center">Jenis Dokumen</th>
                                <th style="text-align:center">No. Dokumen</th>
                                <th style="text-align:center">Tgl. Dokumen</th>
                                <th style="text-align:center">Nama Dokumen</th>
                                <th style="text-align:center">Lokasi</th>
                                <th width="15%" style="text-align:center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            //$arsip = mysqli_query($koneksi, "SELECT * FROM arsip2,naskah,user,kategori WHERE arsip_naskah=naskah_id and arsip_user=user_id and arsip_kategori=kategori_id and  arsip_kategori='4' ORDER BY arsip_id DESC");
                            foreach ($lain as $p) {
                            ?>
                                <tr>
                                    <td style="text-align:center"><?php echo $no++; ?></td>
                                    <td><?php echo $p->naskah_nama ?></td>
                                    <td><?php echo $p->arsip_kode ?></td>
                                    <td style="text-align:center"><?php echo $p->arsip_tanggal ?></td>
                                    <td><?php echo $p->arsip_nama ?></td>
                                    <td><?php echo $p->user_username ?></td>
                                    <td>
                                        <!-- modal hapus -->
                                        <div class="modal fade" id="hapus_kategori_<?php echo $p->arsip_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><strong>HAPUS DATA DOKUMEN LAIN</strong></h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Anda Yakin Akan Menghapus Data Ini ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                                                        <a href="arsip_lain_hapus.php?id=<?php echo $p->arsip_id ?>" class="btn btn-warning">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                            <a target="_blank" class="btn btn-primary" href="<?php echo base_url() . 'file/arsip/' . $p->arsip_file; ?>"><i class="fa fa-search"></i></a>
                                            <a href="<?php echo base_url() . 'surat/doklain_edit/' . $p->arsip_id ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus_kategori_<?php echo $p->arsip_id; ?>">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</section>