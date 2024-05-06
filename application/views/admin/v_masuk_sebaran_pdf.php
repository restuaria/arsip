 <!DOCTYPE html>
 <html>

 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>Sistem Informasi Arsip</title>
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

         <h3 style="text-transform:uppercase"><strong>SEBARAN SURAT MASUK<br /><?php echo $pts->pts_nama; ?></strong></h3>
     </center>
     <div class="box-header">
     </div>
     <div class="box-body">
         <?php
            $dosenn = $this->db->query("SELECT * FROM arsip where  arsip_kategori='2' ")->num_rows();
            ?>
         <?php
            $no = 1;
            $arsip = $this->db->query("SELECT user.user_nama, COUNT(arsip.arsip_user) AS jumlah FROM user LEFT JOIN arsip ON (arsip.arsip_user= user.user_id) where   arsip_kategori='2' GROUP BY user_nama")->result();
            ?>
         <table class="table table-bordered " id="table-datatable">
             <tr>
                 <td style="text-align: center" bgcolor="#CCCCCC">No</td>
                 <td bgcolor="#CCCCCC" style="text-align: center">Lokasi</td>
                 <td bgcolor="#CCCCCC" style="text-align: center">Jumlah</td>
             </tr>
             <?php
                foreach ($arsip as $d) {
                ?>
                 <tr>
                     <td style="text-align: center"><?php echo $no++; ?></td>
                     <td><?php echo $d->user_nama ?></td>
                     <td style="text-align: center"><?php echo $d->jumlah ?></td>
                 </tr>
             <?php
                }
                ?>
             <tr>
                 <td colspan="2" style="text-align: center">Total</td>
                 <td style="text-align: center" bgcolor="#CCCCCC"><?php echo $dosenn; ?></td>
             </tr>
             </tbody>
         </table>
         <script>
             window.print();
         </script>
         <br><br>
     </div>
     </div>
 </body>

 </html>