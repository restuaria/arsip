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
    <table border="1">
        <tr>
            <th style="text-align:center" width="1%">No</th>
            <th style="text-align:center">Jenis Dokumen</th>
            <th style="text-align:center">No. Dokumen</th>
            <th style="text-align:center">Tgl. Dokumen</th>
            <th style="text-align:center">Nama Dokumen</th>
        </tr>
        <?php
        $no = 1;
        foreach ($lain as $p) {
        ?>
            <tr>
                <td style="text-align:center"><?php echo $no++; ?></td>
                <td><?php echo $p->naskah_nama ?></td>
                <td><?php echo $p->arsip_kode ?></td>
                <td style="text-align:center"><?php echo $p->arsip_tanggal ?></td>
                <td><?php echo $p->arsip_nama ?></td>

            </tr>
            <?php
        }
            ?><?php ob_flush(); ?>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>