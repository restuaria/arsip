<html>

<body>
    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=file.xls");
    ?>
    <center>
        <h2 style="text-transform:uppercase">SURAT MASUK <br><?php echo $pts->pts_nama ?></h2>
    </center>
    <table border="1">
        <tr>
            <th style="text-align:center" width="1%">No</th>
            <th style="text-align:center">No. Surat</th>
            <th style="text-align:center">Tgl. Surat</th>
            <th style="text-align:center">Tujuan Surat</th>
            <th style="text-align:center">Perihal Surat</th>
        </tr>
        <?php
        $no = 1;
        $id_user = $this->session->userdata("user_id");
        $arsip = $this->db->query("SELECT * FROM arsip,user,kategori where arsip_user='$id_user' and arsip_user=user_id and arsip_kategori=kategori_id and  arsip_kategori='2' ORDER BY arsip_id DESC");
        foreach ($arsip->result() as $p) {
        ?>
            <tr>
                <td style="text-align:center"><?php echo $no++; ?></td>
                <td><?php echo $p->arsip_kode ?></td>
                <td style="text-align:center"><?php echo $p->arsip_tanggal ?></td>
                <td><?php echo $p->arsip_nama ?></td>
                <td><?php echo $p->arsip_keterangan ?></td>
            </tr>
            <?php
        }
            ?><?php ob_flush(); ?>
    </table>
</body>

</html>