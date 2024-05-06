<section class="content-header">
    <h1>
        Menu Surat Masuk
        <small>Edit Data Surat Masuk</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Surat Masuk</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <section class="col-lg-8 col-lg-offset-2">
            <div class="box box-info">
                <div class="box-header">
                    <a href="<?php echo base_url('surat/masuk') ?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp; Kembali</a>
                </div>
                <div class="box-body">
                    <form method="post" action="<?php echo base_url() . 'surat/proses_masuk_edit/' . $me->arsip_id ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="kategori" required="required">
                                <option value="">Pilih Kategori</option>
                                <?php
                                $kategori = $this->db->query("SELECT * FROM kategori")->result();
                                foreach ($kategori as $k) {
                                ?>
                                    <option <?php if ($k->kategori_id == $me->arsip_kategori) {
                                                echo "selected='selected'";
                                            } ?> value="<?php echo $k->kategori_id; ?>"><?php echo $k->kategori_nama ?></option>
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
                                $naskah = $this->db->query("SELECT * FROM naskah order by naskah_nama asc")->result();
                                foreach ($naskah as $k) {
                                ?>
                                    <option <?php if ($k->naskah_id == $me->arsip_naskah) {
                                                echo "selected='selected'";
                                            } ?> value="<?php echo $k->naskah_id ?>"><?php echo $k->naskah_nama ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No. Surat</label>
                            <input type="hidden" name="id" value="<?php echo $me->arsip_id ?>">
                            <input type="text" class="form-control" name="kode" required="required" value="<?php echo $me->arsip_kode ?>">
                        </div>
                        <div class="form-group">
                            <label>Tgl. Surat</label>
                            <input type="date" class="form-control" name="tanggal" placeholder="Masukkan tanggal pinjam sampai" required="required" value="<?php echo $me->arsip_tanggal ?>">
                        </div>
                        <div class="form-group">
                            <label>Asal Surat</label>
                            <input type="text" class="form-control" name="nama" required="required" value="<?php echo $me->arsip_nama ?>">
                        </div>
                        <div class="form-group">
                            <label>Perihal Surat</label>
                            <input type="text" class="form-control" name="keterangan" required="required" value="<?php echo $me->arsip_keterangan ?>">
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" name="file">
                            <small>FILE PDF, Max 2Mb. Lakukan Perubahan Apabila Diperlukan</small>
                        </div>
                        <div class="form-group">
                            <label>User</label>
                            <select name="user" class="form-control" required="required">
                                <option value=""> - Pilih User - </option>
                                <?php
                                $user = $this->db->query("SELECT * FROM user")->result();
                                foreach ($user as $w) {
                                ?>
                                    <option <?php if ($w->user_id == $me->arsip_user) {
                                                echo "selected='selected'";
                                            } ?> value="<?php echo $w->user_id; ?>"><?php echo $w->user_username; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <small>Diganti Apabila Diperlukan</small>
                            <br>
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