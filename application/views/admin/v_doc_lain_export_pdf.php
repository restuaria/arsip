<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi Inventaris</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
            font-size: 10px;
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
        <h2 style="text-transform:uppercase">DOKUMEN LAIN <br><?php echo $pts->pts_nama ?></h2>
    </center>
    <table class="table table-bordered table-striped" id="table-datatable">
        <thead>
            <tr>
                <th style="text-align:center" width="1%">No</th>
                <th style="text-align:center">Jenis Dokumen</th>
                <th style="text-align:center">No. Dokumen</th>
                <th style="text-align:center">Tgl. Dokumen</th>
                <th style="text-align:center">Nama Dokumen</th>
                <th style="text-align:center">Lokasi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $arsip = $this->db->query("SELECT * FROM arsip2,naskah,user,kategori WHERE arsip_naskah=naskah_id and arsip_user=user_id and arsip_kategori=kategori_id and  arsip_kategori='4' ORDER BY arsip_id DESC")->result();
            foreach ($arsip as $p) {
            ?>
                <tr>
                    <td style="text-align:center"><?php echo $no++; ?></td>
                    <td><?php echo $p->naskah_nama ?></td>
                    <td><?php echo $p->arsip_kode ?></td>
                    <td style="text-align:center"><?php echo $p->arsip_tanggal ?></td>
                    <td><?php echo $p->arsip_nama ?></td>
                    <td><?php echo $p->user_username ?></td>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>