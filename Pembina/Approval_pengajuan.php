
<!DOCTYPE html>
<html lang="en">
<?php

         include "SessionPembina.php";

       

?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

<?php include '../template/head.php' ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<meta charset="utf-8">
<link rel="stylesheet" href="../LogCSS/style.css">



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
                <?php
                $nidn = $array['NIDN'];
                         $q = mysqli_query($koneksi,"SELECT ID_ORMAWA FROM `ormawa` WHERE `NIDN` = $nidn");

                         $ar = mysqli_fetch_array($q);

                        


            ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                <main class="col overflow-auto h-100">
            <div class="bg-light border rounded-3 p-3">
            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            
                                            <th>Kegiatan Yang Diajukan Oleh ORMAWA</th>
                                            <th>Konsep </th>
                                            <th>SUB Kegiatan</th>
                                            <th>Latar Belakang </th>
                                            <th>Tujuan </th>
                                            <th>SK Kepanitiaan</th>
                                            <th>Timeline</th>
                                            <th>RAB</th>
                                            <th>Approval</th>


                                            
                                        
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                                $q = mysqli_query($koneksi,"SELECT * FROM `pengajuan_kegiatan` Where `STATUS` = 'Belum Diterima' AND `ID_ORMAWA` = $ar[ID_ORMAWA] ");
                                                while ($data = mysqli_fetch_array($q)) {
                                                    ?>
                                                  
                                                             <tr>  
                                                                    <td>  <b><?php echo $data['NAMA_ORMAWA_FK'] ?> </b> - <?php echo $data['NAMA_KEGIATAN'];?></td>

                                                                    <td><center><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "../Ormawa/f_kegiatan/".$data['KONSEP_KEGIATAN'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>

                                                                    <td> <center><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "../Ormawa/f_subkegiatan/".$data['SUB_KEGIATAN'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>

                                                                    <td><center><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "../Ormawa/f_latarbelakang/".$data['LATAR_BELAKANG'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>

                                                                    <td><center><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "../Ormawa/f_tujuan/".$data['TUJUAN_KEGIATAN'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>

                                                                    <td><center><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "../Ormawa/f_SK/".$data['SK_KEPANITIAAN'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>
                                                                    
                                                                    <td><center><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "../Ormawa/f_timeline/".$data['TIMELINE_KEGIATAN'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>

                                                                    <td><center><button type="button" class="btn btn-primary"> <a style="text-decoration:none; Color:white;" href="<?php echo "../Ormawa/f_rab/".$data['RAB'] ?>"> <i class = "fa fa-download"></i> </a> </button></td>
                                                                    
                                                                   

                                                                    <td>
                                                                        
                                                                    <?php
                                                                            $cek = mysqli_query($koneksi,"SELECT count(id_Persetujuan) as id, approval_status as stat  FROM `persetujuan_pembina` Where  `id_pengajuan` = $data[ID_PENGAJUAN] AND (`approval_status` = 'Approve' OR `approval_status` = 'Tolak') ");
                                                                            
                                                                            $arr = mysqli_fetch_array($cek);
                                                                          

                                                                            if($arr['id'] < 1){
                                                                                ?>
                                                                                <center><button type = "submit" class="btn btn-success" name = "click"> <a style = "text-decoration:none; color:white;"  href= "approve.php?id=<?php echo $data['ID_PENGAJUAN']; ?>"> Terima  </a>
                                                                                </button>

                                                                                 |
                                                                   
                                                                    <button  class="btn btn-warning"  ><a style = "text-decoration:none; color:white;"  href= "tolak.php?id=<?php echo $data['ID_PENGAJUAN']; ?>">Tolak</a></button>   </td>
                                                                    
                                                                        

                                                                                <?php
                                                                            }
                                                                            else{
                                                                                echo $arr['stat'];
                                                                            }
                                                                    ?>
                                                                    
                                                                    
                                                                   
                                                                

                                                                   
                                                                </tr>
                                                         
                                                <?php
                                                }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
            </div>
             </div>
        </main>
        </div>
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

<!-- summon modal -->
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

</body>

</html>

</body>
</html>

<?php include 'Template/EditProfilePass.php' ?>


