<section class="content-header">
    <h1>
        Menu Dokumen Lain
        <small>Edit Data Dokumen Lain</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Dokumen Lain</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <section class="col-lg-8 col-lg-offset-2">
            <div class="box box-info">
                <div class="box-header">
                    <a href="<?php echo base_url('operator/doklain') ?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp; Kembali</a>
                </div>
                <div class="box-body">
                    <form method="post" action="<?php echo base_url() . 'operator/proses_doklain_edit/' . $d->arsip_id ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="kategori" required="required">
                                <option value="">Pilih Kategori</option>
                                <?php
                                $kategori = $this->db->query("SELECT * FROM kategori where kategori_id='4'")->result();
                                foreach ($kategori as $k) {
                                ?>
                                    <option <?php if ($k->kategori_id == $d->arsip_kategori) {
                                                echo "selected='selected'";
                                            } ?> value="<?php echo $k->kategori_id; ?>"><?php echo $k->kategori_nama; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Naskah</label>
                            <select class="form-control" name="naskah" required="required">
                                <option value="">Pilih Naskah</option>
                                <?php
                                $naskah =  $this->db->query("SELECT * FROM naskah order by naskah_nama asc")->result();
                                foreach ($naskah as $k) {
                                ?>
                                    <option <?php if ($k->naskah_id == $d->arsip_naskah) {
                                                echo "selected='selected'";
                                            } ?> value="<?php echo $k->naskah_id; ?>"><?php echo $k->naskah_nama; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No. Dokumen</label>
                            <input type="hidden" name="id" value="<?php echo $d->arsip_id; ?>">
                            <input type="text" class="form-control" name="kode" required="required" value="<?php echo $d->arsip_kode; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tgl. Dokumen</label>
                            <input type="date" class="form-control" name="tanggal" placeholder="Masukkan tanggal pinjam sampai" required="required" value="<?php echo $d->arsip_tanggal ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Dokumen</label>
                            <input type="text" class="form-control" name="nama" required="required" value="<?php echo $d->arsip_nama; ?>">
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" name="file">
                            <small>FILE PDF, Max 2Mb. Lakukan Perubahan Apabila Diperlukan</small>
                        </div>

                        <div class="form-group">
                            <label></label>
                            <input type="submit" class="btn btn-danger" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</section>