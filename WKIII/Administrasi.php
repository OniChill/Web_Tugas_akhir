<?php
        include "SessionWKIII.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrasi</title>

    <?php include '../template/head.php' ?>

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

                    <!-- Content Row -->
                    <div class="row">
                        <main class="col overflow-auto h-100">
                            <?php 
                            
                            $qK = mysqli_query($koneksi,"SELECT  NAMA_KEGIATAN, ID_PENGAJUAN, STATUS FROM pengajuan_kegiatan WHERE STATUS = 'Approve' ");
                            
                            $jumlah = mysqli_num_rows($qK);
                            
                            if ($jumlah > 0) {
                                ?>
                                <table class="table table-bordered">
                        <h3>Pengajuan Proposal</h3>
                        <thead>
                            <tr>
                                <th scope="col">no</th>
                                <th scope="col">Nama Kegiatan</th>
                                <th scope="col">Approval</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            error_reporting(0);
                                while($ds = mysqli_fetch_assoc($qK)){
                                $idp = $ds['ID_PENGAJUAN'];
                                $qPro = mysqli_query($koneksi, "SELECT * FROM proposal WHERE ID_PENGAJUAN = '$idp'");
                                    
                                    while($dataPro = mysqli_fetch_array($qPro))
                                    {
                                        $idAp =  $dataPro["ID_APPROVAL"];
                                        $dataApPro = mysqli_query($koneksi, "SELECT * FROM approval_proposal WHERE ID_APPROVAL = '$idAp' ");
                                        $data =  mysqli_fetch_row($dataApPro);
                                        
                                        ?>
                                        <tr>
                                        <?php 
                                       if (isset($data) && $data[3] == 'Approve'  && $data[4] != 'Approve') {
                                        $a++;
                                       ?>
                                            <th scope="row"><?= $a?></th>
                                            <td><?= $ds["NAMA_KEGIATAN"] ?></td>
                                            <?php if ( $data[4]=='Unapproved') {
                                                ?>  <td>Unapproved</td>  <?php
                                               
                                            } elseif($data[3]=='Approve'){
                                                ?>  <td>Menunggu Diperiksa</td>  <?php
                                            }else{
                                                ?>  <td>Menunggu proposal</td>  <?php
                                            }
                                              ?>
                                             <?php if ($data[3]=='Approve') { ?>
                                            <td> 
                                                <button type="button" class="btn btn-primary mb-2" ><a style="text-decoration:none; Color:white;" href="<?php echo "../ORMAWA/f_proposal/".$data[5] ?>"> <i class = "fa fa-download"></i> </a></button>
                                                <?php if( isset($data) && $data[4]=='Unapproved'){?>
                                                     <button type="button" class="btn btn-danger mb-2" data-toggle="modal"
                                                     data-target="#Upload<?=trim($idp ) ?>">upload Revisi</button>
                                               <?php }else{ ?>
                                                    <button type="button" class="btn btn-secondary mb-2">upload Revisi</button>
                                               <?php } ?>
                                                <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                                data-target="#Ap<?=trim($idp ) ?>">Approve</button>
                                                <button type="button" class="btn btn-danger mb-2" data-toggle="modal"
                                                data-target="#Un<?=trim($idp ) ?>">Unaprove</button>
                                            </td>
                                            <?php }else{ ?>
                                                <td> 
                                                <button type="button" class="btn btn-secondary mb-2" ><a style="text-decoration:none; Color:white;" > <i class = "fa fa-download"></i> </a></button>
                                                <button type="button" class="btn btn-secondary mb-2" data-toggle="modal"
                                                data-target="#Upload<?=trim($idp ) ?>">upload Revisi</button>
                                                <button type="button" class="btn btn-secondary mb-2" data-toggle="modal"
                                                data-target="#Ap<?=trim($idp ) ?>">Approve</button>
                                                <button type="button" class="btn btn-secondary mb-2" data-toggle="modal"
                                                data-target="#Un<?=trim($idp ) ?>">Unaprove</button>
                                            </td>
                                            <?php } ?>
                                            <?php } ?>
                                        </tr>
                                        <?php
                                    }

                                ?>
                            <?php }?>
                        </tbody>
                        </table>
                        <table class="table table-bordered">
                        <h3>Pengajuan Bukti Kegiatan dan LPJ</h3>
                        <thead>
                            <tr>
                                 <th scope="col">no</th>
                                <th scope="col">Nama Kegiatan</th>
                                <th scope="col">Approval</th>
                                <th scope="col">Action</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            
                               
                        <?php 
                               $n=1;
                                    $q = mysqli_query($koneksi,'SELECT  ID_PENGAJUAN,ID_LPJ,ID_APPROVAL FROM proposal');
                                    while( $dPe = mysqli_fetch_array($q)){
                                        $idpk = $dPe['ID_PENGAJUAN'];
                                        $idAP = $dPe['ID_APPROVAL'];
                                        $idLPJ =trim($dPe['ID_LPJ']); 
                                        $qk = mysqli_query($koneksi,"SELECT NAMA_KEGIATAN from pengajuan_kegiatan where ID_PENGAJUAN = $idpk");
                                        $dpk=mysqli_fetch_row($qk);
                                        $qap=mysqli_query($koneksi,"SELECT APPROVAL_PROPOSAL_WKIII FROM approval_proposal where ID_APPROVAL = '$idAP'");
                                        $dap = mysqli_fetch_row($qap);
                                        if ($dap[0] == 'Approve') {
                                            $qlpj = mysqli_query($koneksi,"SELECT * from approval_lpj where ID_APPROVALLPJ = $idLPJ");
                                            $dlpj=mysqli_fetch_row($qlpj);
                                        }
                                    ?>
                                <tr>
                                <?php 
                                if ($dap[0] == 'Approve' && $dlpj[3] == 'Approve' && $dlpj[4] != 'Approve') { ?>
                                <th scope="row"><?=$n++?></th>
                                <td><?= $dpk[0] ?></td>
                                            <?php if ( $dlpj[4]=='Approve') {
                                                ?>  <td>Approve</td>  <?php
                                            } elseif($dlpj[4]=='Unapproved'){
                                                ?>  <td>Unapproved</td>  <?php
                                            } elseif($dlpj[3]=='Approve'){
                                                ?>  <td>Menunggu Diperiksa</td>  <?php
                                            }else{
                                                ?>  <td>Menunggu LPJ</td>  <?php
                                            }
                                              ?>
                                
                                    <td>         <?php if( isset($dlpj[5]) ){?>
                                        <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                                data-target="#file<?=trim($idLPJ ) ?>" ><a style="text-decoration:none; Color:white;"> <i class = "fa fa-download"></i> </a></button>
                                                <?php }else{ ?>
                                                    <button type="button" class="btn btn-secondary mb-2" ><a style="text-decoration:none; Color:white;"> <i class = "fa fa-download"></i> </a></button>
                                                    <?php } ?>
                                                <?php if( isset($dlpj) && $dlpj[4]=='Unapproved'){?>
                                                     <button type="button" class="btn btn-danger mb-2" data-toggle="modal"
                                                     data-target="#UpLpj<?=trim($idLPJ ) ?>">upload Revisi</button>
                                               <?php }else{ ?>
                                                    <button type="button" class="btn btn-secondary mb-2">upload Revisi</button>
                                               <?php } ?>
                                            
                                            <?php if( isset($dlpj[3]) && $dlpj[3]=='Approve' ){?>
                                                <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                                data-target="#ApLpj<?=trim($idLPJ ) ?>">Approve</button>
                                                <button type="button" class="btn btn-danger mb-2" data-toggle="modal"
                                                data-target="#UnLpj<?=trim($idLPJ ) ?>">Unaprove</button>
                                                <?php }else{ ?>
                                                    <button type="button" class="btn btn-secondary mb-2" >Approve</button>
                                                <button type="button" class="btn btn-secondary mb-2" >Unaprove</button>
                                                <?php } ?>
                                            </td>

                                            <?php  } ?>
                                </tr>



                                
                                <?php 
                            }
                                  
                                ?>
                            
                        </tbody>
                    </table>

                                <?php
                            } else {
                                # code...
                            }
                            
                            ?>

                        
                   

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
    <!-- summon modal untuk allpage -->
    <?php include 'Template/modal.php' ?>

    <?php include '../template/footInc.php';
    
     $qK = mysqli_query($koneksi,"SELECT   *  FROM proposal ");
     while($data = mysqli_fetch_array($qK)){
    ?>

      <!--Upload Revisi Modal -->
      <div class="modal fade" id="Upload<?= trim($data['ID_PENGAJUAN']) ?>" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Upload Revisi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="Logic/Administrasi.php" method="post"  enctype="multipart/form-data">
                    <input type="text" name="idp" value="<?=$data['ID_APPROVAL'] ?>" hidden>
                        <input class="form-control mb-2" name="proposal" type="file"  required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="Upload" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

   <!--Upload Revisi LPJ Modal -->
   <div class="modal fade" id="UpLpj<?= trim($data['ID_LPJ']) ?>" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Upload Revisi LPJ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="Logic/Administrasi.php" method="post"  enctype="multipart/form-data">
                    <input type="text" name="idp" value="<?=$data['ID_LPJ'] ?>" hidden>
                        <input class="form-control mb-2" name="proposal" type="file"  required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="UpLpj" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


      <!--Upload Approve Proposal Modal -->
      <div class="modal fade" id="Ap<?= trim($data['ID_PENGAJUAN']) ?>" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Upload Revisi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="Logic/Administrasi.php" method="post" >
                        <input type="text" name="kema" value="<?= $array["NIDN_WKIII"] ?>" hidden>
                        <input type="text" name="idp" value="<?=$data['ID_APPROVAL'] ?>" hidden>
                        Apakah sudah yakin di approve?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="Ap" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php 
    $ilpj = $data['ID_LPJ'];
    $qlpj = mysqli_query($koneksi,"SELECT ID_BK FROM approval_lpj where ID_APPROVALLPJ = '$ilpj'");
    $idbk = mysqli_fetch_row($qlpj);
    ?>
  <!--Upload Approve LPJ Modal -->
  <div class="modal fade" id="ApLpj<?= trim($ilpj) ?>" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Approve LPJ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="Logic/Administrasi.php" method="post" >
                        <input type="text" name="kema" value="<?= $array["NIDN_WKIII"] ?>" hidden>
                        <input type="text" name="idp" value="<?=$ilpj  ?>" hidden>
                        <input type="text" name="ibk" value="<?=$data['ID_LPJ'] ?>" hidden>
                        <input type="text" name="ibk" value="<?= $idbk[0]  ?>" hidden >
                        Apakah sudah yakin di approve?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="ApLpj" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


      <!--Unapproved proposal Modal -->
      <div class="modal fade" id="Un<?= trim($data['ID_PENGAJUAN']) ?>" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Upload Revisi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="Logic/Administrasi.php" method="post"  enctype="multipart/form-data">
                        <input type="text" name="kema" value="<?= $array["NIDN_WKIII"] ?>" hidden>
                        <input type="text" name="idp" value="<?=$data['ID_APPROVAL'] ?>" hidden>
                        Apakah sudah yakin di Unapproved?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="Un" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

 <!--Unapproved lPJ Modal -->
 <div class="modal fade" id="UnLpj<?= trim($data['ID_LPJ']) ?>" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Unprove lpj</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="Logic/Administrasi.php" method="post"  enctype="multipart/form-data">
                        <input type="text" name="kema" value="<?= $array["NIDN_WKIII"] ?>" hidden>
                        <input type="text" name="idp" value="<?=$data['ID_LPJ'] ?>" hidden>
                        Apakah sudah yakin di Unapproved?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="UnLpj" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


     <!--bukti kegiatan Modal -->
     <?php
        $idlpj = trim($data['ID_LPJ']);
        $qlpj = mysqli_query($koneksi,"SELECT LAPORAN_LPJ,ID_BK FROM approval_lpj where ID_APPROVALLPJ = '$idlpj'");
        $dlpj = mysqli_fetch_row($qlpj);
        $idbk = $dlpj[1];
        $qbk= mysqli_query($koneksi,"SELECT ABSENSI_BK,DOKUMENTASI,SERTIFIKAT FROM bukti_kegiatan where ID_BUKTIKEGIATAN = '$idbk'");
        $dbk = mysqli_fetch_row($qbk);
      ?>
      <div class="modal fade" id="file<?= $idlpj ?>" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">LPJ dan Bukti Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="row">
                        <label for="#lpj">LPJ</label>
                        <button type="button" id="lpj" class="btn btn-primary mb-2" ><a style="text-decoration:none; Color:white;" href="<?php echo "../ORMAWA/f_lpj/".$dlpj[0] ?>"> <i class = "fa fa-download"></i> </a></button>
                        <label for="#abk">Absensi BK</label>
                        <button type="button" id="abk" class="btn btn-primary mb-2" ><a style="text-decoration:none; Color:white;" href="<?php echo "../ORMAWA/f_bukti/".$dbk[0] ?>" > <i class = "fa fa-download"></i> </a></button>
                        <label for="#dok">Dokumentasi</label>
                        <button type="button" id="dok" class="btn btn-primary mb-2" ><a style="text-decoration:none; Color:white;" href="<?php echo "../ORMAWA/f_bukti/".$dbk[1] ?>" > <i class = "fa fa-download"></i> </a></button>
                        <label for="#sertifikat">Sertifikat</label>
                        <button type="button" id="sertifikat" class="btn btn-primary mb-2" ><a style="text-decoration:none; Color:white;" href="<?php echo "../ORMAWA/f_bukti/".$dbk[2] ?>" > <i class = "fa fa-download"></i> </a></button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
   
</body>

</html>
<?php include 'Template/EditProfilePass.php' ?>
<?php
if ( isset($_SESSION['eks']) && $_SESSION['eks']==true) {
    ?>
    <script>
          Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: 'Ekstensi Salah',
          
          })
          </script>
<?php
unset($_SESSION['eks']);
}
if (!isset($_SESSION['notif'])) {
    ?>
                 
          <?php
          unset($_SESSION['notif']);
  }  else if($_SESSION['notif']==true) {
    ?>
     <script>
                              Swal.fire({
                              icon: 'success',
                              title: 'Berhasil',
                              text: 'upload Berhasil',
                              
                              })
                              </script>
<?php
unset($_SESSION['notif']);
  }else{
?>
<script>
          Swal.fire({
          icon: 'error',
          title: 'gagal',
          text: 'gagal Berhasil',
          
          })
          </script>
          
<?php } 
unset($_SESSION['notif']);


if (!isset($_SESSION['notifA'])) {
    ?>
                 
          <?php
          unset($_SESSION['notifA']);
  }  else if($_SESSION['notifA']==true) {
    ?>
     <script>
                              Swal.fire({
                              icon: 'success',
                              title: 'Berhasil',
                              text: 'Approve Berhasil',
                              
                              })
                              </script>
<?php
unset($_SESSION['notifA']);
  }else{
?>
<script>
          Swal.fire({
          icon: 'error',
          title: 'gagal',
          text: 'Approve gagal',
          
          })
          </script>
          
<?php } 
unset($_SESSION['notifA']);

if (!isset($_SESSION['notifU'])) {
    ?>
                 
          <?php
          unset($_SESSION['notifU']);
  }  else if($_SESSION['notifU']==true) {
    ?>
     <script>
                              Swal.fire({
                              icon: 'success',
                              title: 'Berhasil',
                              text: 'Unapproved Berhasil',
                              
                              })
                              </script>
<?php
unset($_SESSION['notifU']);
  }else{
?>
<script>
          Swal.fire({
          icon: 'error',
          title: 'gagal',
          text: 'UnApproved gagal',
          
          })
          </script>
          
<?php } 
unset($_SESSION['notifU']);
?>