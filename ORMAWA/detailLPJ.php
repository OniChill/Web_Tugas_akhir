<!DOCTYPE html>
<html lang="en">
<head>
    <?php

        include "SessionPengurus.php";
        $id = $_GET['id'];

        $q = mysqli_query($koneksi,"SELECT * FROM `pengajuan_lpj` where `id` = $id ");

        $arr = mysqli_fetch_array($q);

?>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

<?php include '../template/head.php' ?>
 <!-- Custom styles for this template -->
 <link href="../css/sb-admin-2.min.css" rel="stylesheet">

<!-- Custom styles for this page -->
<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
  


<body id="page-top">
<?php include 'template/navbar.php' ?>
    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php include 'template/sidebar.php' ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column pt-4">

            <!-- Main Content -->
            <div id="content">
                
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
               
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                    <main class="col overflow-auto h-100">
          
                
            </div>
        </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <center><h1>DETAIL LPJ</h1></center>


                           
                            <form method="post" class="row g-3" >
                           <table class="table">

                                <tr>
                                    <th>Nama Kegiatan</th>
                                    <td>:</td>
                                    <td><?php echo $arr['nama_kegiatan'];?></td>
                                </tr>
                                <tr>
                                    <th>Nama Ormawa</th>
                                    <td>:</td>
                                    <td><?php echo $arr['nama_ormawa'];?></td>
                                </tr>

                                <tr>
                                    <th>Pendahuluan</th>
                                    <td>:</td>
                                    <td><textarea readonly class="form-control" rows="4" cols="50"> <?php echo $arr['pendahuluan'];?></textarea></td>
                                </tr>

                                
                                <tr>
                                    <th>Pencapaian</th>
                                    <td>:</td>
                                    <td><textarea readonly class="form-control" rows="4" cols="50"> <?php echo $arr['pencapaian'];?></textarea></td>
                                </tr>

                                <tr>
                                    <th>Penutup</th>
                                    <td>:</td>
                                    <td><textarea readonly class="form-control" rows="4" cols="50"> <?php echo $arr['penutup'];?></textarea></td>
                                </tr>

                                <tr>
                                    <th>Pelaksanaan Kegiatan</th>
                                    <td>:</td>
                                    <td><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "lihatPdf.php?id=f_lpj/".$arr['pelaksanaan_kegaitan'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>
                                </tr>

                                <tr>
                                    <th>Kepanitiaan</th>
                                    <td>:</td>
                                    <td><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "lihatPdf.php?id=f_lpj/".$arr['kepanitiaan'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>
                                </tr>

                                <tr>
                                    <th>Peserta</th>
                                    <td>:</td>
                                    <td><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "lihatPdf.php?id=f_lpj/".$arr['peserta'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>
                                </tr>
                                <tr>

                                    <th>RAB Pemasukan</th>
                                    <td>:</td>
                                    <td><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "lihatPdf.php?id=f_lpj/".$arr['rab_masukan'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>
                                </tr>

                                <tr>
                                    <th>RAB Pengeluaran</th>
                                    <td>:</td>
                                    <td><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "lihatPdf.php?id=f_lpj/".$arr['rab_pengeluaran'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>

                                </tr>

                                
                                <tr>
                                    <th>Realisasi Anggaran</th>
                                    <td>:</td>
                                    <td><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "lihatPdf.php?id=f_lpj/".$arr['realisasi_anggaran'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>

                                </tr>

                                <tr>
                                    <th>Bukti Pembayarant</th>
                                    <td>:</td>
                                    <td><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "lihatPdf.php?id=f_lpj/".$arr['bukti_pembayaran'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>
                                </tr>

                                <tr>
                                    <th>Berita Acara</th>
                                    <td>:</td>
                                    <td><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "lihatPdf.php?id=f_lpj/".$arr['berita_acara'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>

                                </tr>

                                
                                <tr>
                                    <th>Absensi</th>
                                    <td>:</td>
                                    <td><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "lihatPdf.php?id=f_lpj/".$arr['absensi'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>

                                </tr>

                                <tr>
                                    <th>Notulensi Rapat/Seminar</th>
                                    <td>:</td>
                                    <td><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "lihatPdf.php?id=f_lpj/".$arr['rapat'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>

                                </tr>


                                <tr>
                                    <th>Rekap Penilaian Peserta</th>
                                    <td>:</td>
                                    <td><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "lihatPdf.php?id=f_lpj/".$arr['nilai_peserta'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>

                                </tr>

                                <tr>
                                    <th>Desain Sertifikat</th>
                                    <td>:</td>
                                    <td><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "lihatPdf.php?id=f_lpj/".$arr['desain_sertifikat'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>

                                </tr>

                                <tr>
                                    <th>Dokumentasi Kegiatan</th>
                                    <td>:</td>
                                    <td><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "lihatPdf.php?id=f_lpj/".$arr['dokumentasi'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>

                                </tr>

                                <tr>
                                    <th>Softcopy LPJ</th>
                                    <td>:</td>
                                    <td><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "lihatPdf.php?id=f_lpj/".$arr['LPJ'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>

                                </tr>


                             
                        

                                <?php 
                                    $idlpj = $arr['id'];
                                    $qcek = mysqli_query($koneksi, "SELECT approve from applpj where idlpj = '$idlpj' AND approve = '0'");
                                    $cek = mysqli_num_rows($qcek);
                                    if ($cek) {?>
                           <tr>
                               <td>
                               <button type="button" class="btn btn-primary"><a style="color:white; text-decoration:none;" href= "editLPJ.php?id= <?php echo  $idlpj?>">Revisi</a></button>
                                            </td>
                            </tr>
                            <?php }?>
                           </table>
                           
                           </form>


                        </div>
                        
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
        </main>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                      
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        

        </div>
        <!-- End of Content Wrapper -->
    
    </div>
    <!-- End of Page Wrapper -->
<!-- Footer -->
<?php include '../template/footer.php' ?>
            <!-- End of Footer -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- summon Modal-->
   <?php include 'Template/modal.php' ?>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>





</html>


<?php
require 'Template/EditProfilePass.php';
?>


