<html>

<body>
    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=file.xls");
    ?>
    <center>
        <h2 style="text-transform:uppercase">SURAT keluar <br><?php echo $pts->pts_nama; ?></h2>
    </center>
    <table border="1">
        <tr>
            <th style="text-align:center" width="1%">No</th>
            <th style="text-align:center">No. Surat</th>
            <th style="text-align:center">Tgl. Surat</th>
            <th style="text-align:center">Tujuan Surat</th>
            <th style="text-align:center">Perihal Surat</th>
            <th style="text-align:center">Lokasi</th>
        </tr>
        <?php
        $no = 1;
        $arsip = $this->db->query("SELECT * FROM arsip,user,kategori WHERE arsip_user=user_id and arsip_kategori=kategori_id and  arsip_kategori='3' ORDER BY arsip_id DESC")->result();
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
            ?><?php ob_flush(); ?>
    </table>
</body>

</html>