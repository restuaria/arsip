  <section class="content-header">
      <h1>
          Menu Laporan
          <small>Data Laporan</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Laporan</li>
      </ol>
  </section>
  <section class="content">
      <div class="row">
          <section class="col-lg-12">
              <div class="box box-info">
                  <div class="box-header">
                      <h3 class="box-title">Filter Laporan</h3>
                  </div>
                  <div class="box-body">
                      <form method="get" action="">
                          <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Mulai Tanggal</label>
                                      <input type="date" class="form-control" type="text" value="<?php if (isset($_GET['tanggal_dari'])) {
                                                                                                        echo $_GET['tanggal_dari'];
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    } ?>" name="tanggal_dari" class="form-control datepicker2" placeholder="Mulai Tanggal" required="required">
                                  </div>
                                  <div class="form-group">
                                      <label>Sampai Tanggal</label>
                                      <input type="date" class="form-control" value="<?php if (isset($_GET['tanggal_sampai'])) {
                                                                                            echo $_GET['tanggal_sampai'];
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?>" name="tanggal_sampai" class="form-control datepicker2" placeholder="Sampai Tanggal" required="required">
                                  </div>
                                  <div class="form-group">
                                      <label>Kategori</label>
                                      <select name="jenis" class="form-control" required="required">
                                          <option value="">- Pilih -</option>
                                          <option <?php if (isset($_GET['jenis'])) {
                                                        if ($_GET['jenis'] == "surat_masuk") {
                                                            echo "selected='selected'";
                                                        }
                                                    } ?> value="surat_masuk">Surat Masuk</option>
                                          <option <?php if (isset($_GET['jenis'])) {
                                                        if ($_GET['jenis'] == "surat_keluar") {
                                                            echo "selected='selected'";
                                                        }
                                                    } ?> value="surat_keluar">Surat Keluar</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <input type="submit" value="TAMPILKAN" class="btn btn-sm btn-primary">
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
              <div class="box box-info">
                  <div class="box-header">
                      <h3 class="box-title">Laporan</h3>
                  </div>
                  <div class="box-body">
                      <?php
                        if (isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari']) && isset($_GET['jenis'])) {
                            $tgl_dari = $_GET['tanggal_dari'];
                            $tgl_sampai = $_GET['tanggal_sampai'];
                            $jenis = $_GET['jenis'];
                        ?>
                          <div class="row">
                              <div class="col-lg-6">
                                  <table class="table table-bordered">
                                      <tr>
                                          <th width="30%">Dari Tanggal</th>
                                          <th width="1%">:</th>
                                          <td><?php echo $tgl_dari; ?></td>
                                      </tr>
                                      <tr>
                                          <th>Sampai Tanggal</th>
                                          <th>:</th>
                                          <td><?php echo $tgl_sampai; ?></td>
                                      </tr>
                                      <tr>
                                          <th>Jenis Surat</th>
                                          <th>:</th>
                                          <td><?php echo $jenis; ?></td>
                                      </tr>
                                  </table>
                              </div>
                          </div>
                          <?php
                            if ($jenis == "surat_masuk") {
                            ?>
                              <a href="<?php echo base_url() . 'surat/laporan_pdf' ?>?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>&jenis=<?php echo $jenis ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
                              <br /><br />
                              <div class="table-responsive">
                                  <table class="table table-bordered table-striped" id="table-datatable">
                                      <thead>
                                          <tr>
                                              <th style="text-align:center" width="1%">No</th>
                                              <th style="text-align:center">No. Surat</th>
                                              <th style="text-align:center">Tgl. Surat</th>
                                              <th style="text-align:center">Asal Surat</th>
                                              <th style="text-align:center">Perihal Surat</th>
                                              <th style="text-align:center">Lokasi</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php
                                            $no = 1;
                                            $arsip = $this->db->query("SELECT * FROM arsip,user,kategori where arsip_user=user_id and arsip_kategori=kategori_id and  arsip_kategori='2' and date(arsip_tanggal)>='$tgl_dari' and date(arsip_tanggal)<='$tgl_sampai' ORDER BY arsip_tanggal DESC")->result();
                                            foreach ($arsip as $p) {
                                            ?>
                                              <tr>
                                                  <td style="text-align:center"><?php echo $no++; ?></td>
                                                  <td><?php echo $p->arsip_kode ?></td>
                                                  <td style="text-align:center"><?php echo $p->arsip_tanggal ?></td>
                                                  <td><?php echo $p->arsip_nama ?></td>
                                                  <td><?php echo $p->arsip_keterangan ?></td>
                                                  <td><?php echo $p->user_nama ?></td>
                                              </tr>
                                          <?php
                                            }
                                            ?>
                                      </tbody>
                                  </table>
                              </div>
                          <?php
                            } elseif ($jenis == "surat_keluar") {
                            ?>
                              <a href="<?php echo base_url() . 'surat/laporan_pdf' ?>?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>&jenis=<?php echo $jenis ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
                              <br /><br />
                              <div class="table-responsive">
                                  <table class="table table-bordered table-striped" id="table-datatable">
                                      <thead>
                                          <tr>
                                              <th style="text-align:center" width="1%">No</th>
                                              <th style="text-align:center">No. Surat</th>
                                              <th style="text-align:center">Tgl. Surat</th>
                                              <th style="text-align:center">Tujuan Surat</th>
                                              <th style="text-align:center">Perihal Surat</th>
                                              <th style="text-align:center">Lokasi</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php
                                            $no = 1;
                                            $arsip = $this->db->query("SELECT * FROM arsip,user,kategori where arsip_user=user_id and arsip_kategori=kategori_id and  arsip_kategori='3' and date(arsip_tanggal)>='$tgl_dari' and date(arsip_tanggal)<='$tgl_sampai' ORDER BY arsip_tanggal DESC")->result();
                                            foreach ($arsip as $p) {
                                            ?>
                                              <tr>
                                                  <td style="text-align:center"><?php echo $no++; ?></td>
                                                  <td><?php echo $p->arsip_kode ?></td>
                                                  <td style="text-align:center"><?php echo $p->arsip_tanggal ?></td>
                                                  <td><?php echo $p->arsip_nama ?></td>
                                                  <td><?php echo $p->arsip_keterangan ?></td>
                                                  <td><?php echo $p->user_username ?></td>
                                              </tr>
                                          <?php
                                            }
                                            ?>
                                      </tbody>
                                  </table>
                              </div>
                          <?php
                            }
                            ?>
                      <?php
                        } else {
                        ?>
                          <div class="alert alert-info text-center">
                              Silahkan Filter Laporan Terlebih Dulu.
                          </div>
                      <?php
                        }
                        ?>
                  </div>
              </div>
          </section>
      </div>
  </section>