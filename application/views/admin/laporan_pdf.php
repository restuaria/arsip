<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi ARSIP</title>
    <link href="<?php echo base_url() ?>assets/img/logo-sikampus.png" rel="icon">
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        .table {
            width: 100%;
        }

        th,
        td {}

        .table,
        .table th,
        .table td {
            padding: 5px;
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <center>
        <?php
        ?>
        <h4 style="text-transform:uppercase">LAPORAN SURAT<br><?php echo $pts->pts_nama; ?></h4>
    </center>
    <?php
    if (isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari']) && isset($_GET['jenis'])) {
        $tgl_dari = $_GET['tanggal_dari'];
        $tgl_sampai = $_GET['tanggal_sampai'];
        $jenis = $_GET['jenis'];
    ?>
        <table>
            <tr>
                <td width="40%">Dari Tanggal</td>
                <td width="10%" style="text-align: center;">:</td>
                <td><?php echo $tgl_dari; ?></td>
            </tr>
            <tr>
                <td>Sampai Tanggal</td>
                <td style="text-align: center;">:</td>
                <td><?php echo $tgl_sampai; ?></td>
            </tr>
            <tr>
                <td>Jenis Surat</td>
                <td style="text-align: center;">:</td>
                <td><?php echo $jenis; ?></td>
            </tr>
        </table>
        <br />
        <?php
        if ($jenis == "surat_masuk") {
        ?>
            <table class="table">
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
                    $arsip = $this->db->query("SELECT * FROM arsip,user,kategori WHERE arsip_user=user_id and arsip_kategori=kategori_id and  arsip_kategori='2' and date(arsip_tanggal)>='$tgl_dari' and date(arsip_tanggal)<='$tgl_sampai' ORDER BY arsip_tanggal DESC");
                    foreach ($arsip->result() as $p) {
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
        <?php
        } elseif ($jenis == "surat_keluar") {
        ?>
            <table class="table">
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
                    $arsip =  $this->db->query("SELECT * FROM arsip,user,kategori WHERE arsip_user=user_id and arsip_kategori=kategori_id and  arsip_kategori='3' and date(arsip_tanggal)>='$tgl_dari' and date(arsip_tanggal)<='$tgl_sampai' ORDER BY arsip_tanggal DESC");
                    foreach ($arsip->result() as $p) {
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
    <script>
        window.print();
    </script>
</body>

</html>



