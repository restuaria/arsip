<section class="content-header">
    <h1>
        Menu Grafik
        <small>Grafik Surat</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Grafik Surat</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <section class="col-lg-12">
            <div class="box box-info">
                <div class="box-header">
                    <center>
                        <h3 style="text-transform:uppercase">&nbsp <strong>GRAFIK SURAT <br /><?php echo $this->session->userdata('user_nama'); ?></strong></h3>
                    </center>
                </div>
                <div class="box-body">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <div style="width: 90%;height: 700px">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        var ctx = document.getElementById("myChart").getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: [
                                    <?php
                                    $jad = $this->db->query("SELECT * FROM kategori where kategori_id='2' or kategori_id='3' order by kategori_nama asc")->result();
                                    foreach ($jad as $d) { ?> "<?php echo $d->kategori_nama; ?>",
                                    <?php
                                    }
                                    ?>
                                ],
                                datasets: [{
                                    label: 'Jumlah Surat',
                                    data: [
                                        <?php
                                        $jad = $this->db->query("SELECT * FROM kategori where kategori_id='2' or kategori_id='3' order by kategori_nama asc")->result();
                                        foreach ($jad as $d) {
                                            $id_jad = $d->kategori_id;
                                            $id_user = $this->session->userdata('user_id');
                                            $w = $this->db->query("SELECT * FROM arsip WHERE arsip_user='$id_user' and arsip_kategori='$id_jad'")->num_rows();

                                        ?> "<?php echo $w; ?>",
                                        <?php
                                        }
                                        ?>
                                    ],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255,99,132,1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </section>
    </div>
</section>