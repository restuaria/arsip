<html>

<body>
    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=file.xls");
    ?>
    <center>
        <h2 style="text-transform:uppercase">DOKUMEN LAIN<br><?php echo $pts->pts_nama; ?></h2>
    </center>
    <table border="1">
        <tr>
            <th style="text-align:center" width="1%">No</th>
            <th style="text-align:center">Jenis Dokumen</th>
            <th style="text-align:center">No. Dokumen</th>
            <th style="text-align:center">Tgl. Dokumen</th>
            <th style="text-align:center">Nama Dokumen</th>
            <th style="text-align:center">Lokasi</th>
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
                <td><?php echo $p->user_username ?></td>
            </tr>
            <?php
        }
            ?><?php ob_flush(); ?>
    </table>
</body>

</html>