<?php
        include "SessionPengurus.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kegiatan</title>

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
                            $idOr= $array['ID_ORMAWA'];
                            $qK = mysqli_query($koneksi,"SELECT   NAMA_KEGIATAN, ID_PENGAJUAN, STATUS FROM pengajuan_kegiatan WHERE STATUS = 'Approve' and ID_ORMAWA = '$idOr' ");
                            
                            $jumlah = mysqli_num_rows($qK);
                            
                            if ($jumlah > 0) {
                                ?>
                                <table class="table table-bordered">
                        <h3>Pengajuan Proposal</h3>
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Kegiatan</th>
                                <th scope="col">Approval</th>
                                <th scope="col">Action</th>
                                <th scope="col">Revisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            error_reporting(0);
                                while($ds = mysqli_fetch_assoc($qK)){
                                $idp = $ds['ID_PENGAJUAN'];
                                $qPro = mysqli_query($koneksi, "SELECT * FROM proposal WHERE ID_PENGAJUAN = '$idp'");
                                $jmlPro = mysqli_num_rows($qPro);
                                if ($jmlPro > 0 ) {
                                    $no = 0;
                                    while($dataPro = mysqli_fetch_array($qPro))
                                    {
                                        $idAp =  $dataPro["ID_APPROVAL"];
                                        $dataApPro = mysqli_query($koneksi, "SELECT * FROM approval_proposal WHERE ID_APPROVAL = '$idAp'");
                                        $data =  mysqli_fetch_row($dataApPro);
                                        
                                        ?>
                                        <tr>
                                        <?php if (isset($data) && $data[3] != 'Approve') { 
                                            $no++; ?>
                                            <th scope="row"><?= $no ?></th>
                                            <td><?= $ds["NAMA_KEGIATAN"] ?></td>
                                            <?php if ( $data[3]=='Approve') {
                                                ?>  <td>Approve</td>  <?php
                                            } elseif($data[3]=='Unapproved'){
                                                ?>  <td>Unapproved</td>  <?php
                                            }elseif(!empty($data[5])){
                                                ?>  <td>Menunggu  Diperiksa</td>  <?php
                                            }else{
                                                ?>  <td>Menunggu proposal</td>  <?php
                                            }
                                              ?>
                                            <td> <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                            data-target="#Upload<?=trim($idp ) ?>">Upload Proposal</button></td>
                                            <?php if( !empty($data[6]) && $data[3]=='Unapproved'){ ?>
                                            <td> <button type="button" class="btn btn-danger mb-2" data-toggle="modal"
                                            data-target="#revisi<?=trim($data[0] ) ?>"><a style="text-decoration:none; Color:white;"> <i class = "fa fa-download"></i> </a></button></td>
                                            <?php } else{  ?>
                                                <td> <button type="button" class="btn btn-secondary mb-2" ><a style="text-decoration:none; Color:white;" > <i class = "fa fa-download"></i> </a></button></td>
                                            <?php } ?>
                                       <?php } ?>
                                        </tr>
                                        <?php
                                    }
                                  
                                } else {
                                   
                                    ?>
                                    <tr>
                                   
                                        <th scope="row">2</th>
                                        <td><?= $ds["NAMA_KEGIATAN"] ?></td>
                                        <td>Menunggu Proposal</td>
                                        <td>Menunggu Proposal</td>
                                        <td> <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                        data-target="#Upload<?=trim($idp ) ?>">Upload Proposal</button>
                                        </td>
                                        <td><button type="button" class="btn btn-danger mb-2" >Download Revisi</button></td>
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
                                <th scope="col">No</th>
                                <th scope="col">Nama Kegiatan</th>
                                <th scope="col">Approval</th>
                                <th scope="col">Action</th>
                                <th scope="col">Revisi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                                $idOr= $array['ID_ORMAWA'];
                                $qK = mysqli_query($koneksi,"SELECT   NAMA_KEGIATAN, ID_PENGAJUAN, STATUS FROM pengajuan_kegiatan WHERE STATUS = 'Approve' and ID_ORMAWA = '$idOr' ");
                            
                                
                                $jumlah = mysqli_num_rows($qK);
                                if ($jumlah > 0 ){
                                $n=1;
                                while($Ak =  mysqli_fetch_array($qK)){
                                        $idAk= $Ak['ID_PENGAJUAN'];
                                        $nmAk= $Ak['NAMA_KEGIATAN'];
                                        $pro = mysqli_query($koneksi,"SELECT ID_APPROVAL, ID_LPJ FROM proposal where ID_PENGAJUAN = '$idAk'");
                                        $pror = mysqli_fetch_row($pro);
                                        
                                        $ApPro = mysqli_query($koneksi,"SELECT APPROVAL_PROPOSAL_KEMAHASISWAAN , APPROVAL_PROPOSAL_WKIII FROM approval_proposal where ID_APPROVAL = '$pror[0]'");
                                        $cek= mysqli_fetch_row($ApPro);
                                        if ($cek[0]=='Approve' && $cek[1]=='Approve') {
                                        $qlpj = mysqli_query($koneksi,"SELECT * from approval_lpj  where ID_APPROVALLPJ='$pror[1]'"); 
                                        $dlpj= mysqli_fetch_row($qlpj);
                                    ?>
                                    <tr>
                                        <?php if ($dlpj[3] != 'Approve') { ?>
                                        <td><?=$n++?></td>
                                        <td><?=$nmAk?></td>
                                        <?php if ($dlpj) {?>

                                            <?php if($dlpj[3]=='Approve') {?>
                                                <td>Approve</td>
                                            <?php  }elseif($dlpj[3]=='Unapproved'){ ?>
                                                <td>Unapprove</td>
                                            <?php  }elseif(!empty($dlpj[5])){ ?>
                                        <td>menunggu Diperiksa</td>
                                            <?php  }else{ ?>
                                        <td>menunngu LPJ</td>
                                        <?php } ?>
                                        <?php  }else{?>
                                        <td>menunngu LPJ</td>
                                        <?php } ?>
                                        <td>
                                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#UpLPJ<?=trim($idAk ) ?>">Upload LPJ
                                            </button>
                                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#UpBukti<?=trim($idAk ) ?>">Upload BK
                                            </button>
                                        </td>
                                        <?php if( isset($dlpj[6]) && $dlpj[3]=='Unapproved'){ ?>
                                            <td> <button type="button" class="btn btn-danger mb-2" ><a style="text-decoration:none; Color:white;" > <i class = "fa fa-download"  data-toggle="modal" data-target="#revisilpj<?=trim($dlpj[0] ) ?>"></i> </a></button></td>
                                            <?php } else{  ?>
                                                <td> <button type="button" class="btn btn-secondary mb-2" ><a style="text-decoration:none; Color:white;" > <i class = "fa fa-download"></i> </a></button></td>
                                            <?php } ?>
                                    <?php } ?>
                                    </tr>
                                <?php  
                                        }  
                                    }
                                }?>
                        </tbody>
                    </table>

                                <?php
                            } else {
                            
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
     $idOr= $array['ID_ORMAWA'];
     $qK = mysqli_query($koneksi,"SELECT   NAMA_KEGIATAN, ID_PENGAJUAN, STATUS FROM pengajuan_kegiatan WHERE STATUS = 'Approve' and ID_ORMAWA = '$idOr' ");
     while($data = mysqli_fetch_array($qK)){
    ?>

      <!--Upload proposal Modal -->
      <div class="modal fade" id="Upload<?= trim($data['ID_PENGAJUAN']) ?>" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Upload Proposal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="Logic/Administrasi.php" method="post"  enctype="multipart/form-data">
                        <input class="form-control mb-2" name="id" value="<?= $data['ID_PENGAJUAN']?>" hidden type="text"  >
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


      <!--Upload LPJ Modal -->
      <div class="modal fade" id="UpLPJ<?= trim($data['ID_PENGAJUAN']) ?>" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Upload LPJ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="Logic/Administrasi.php" method="post"  enctype="multipart/form-data">
                        <input class="form-control mb-2" name="id" value="<?= $data['ID_PENGAJUAN']?>" hidden type="text"  >
                        <label for="lpj">LPJ</label>
                        <input class="form-control mb-2" name="proposal" id="lpj" type="file"  required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="UpLPJ" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

      <!--Upload Bukti Modal -->
      <div class="modal fade" id="UpBukti<?= trim($data['ID_PENGAJUAN']) ?>" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Upload Bukti Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="Logic/Administrasi.php" method="post"  enctype="multipart/form-data">
                        <input class="form-control mb-2" name="id" value="<?= $data['ID_PENGAJUAN']?>" hidden type="text"  >
                        <label for="absen">Absensi Bukti Kegiatan</label>
                        <input class="form-control mb-2" name="absen" id="absen" type="file"  required>
                        <label for="dok">Dokumentasi</label>
                        <input class="form-control mb-2" name="dok" id="dok" type="file"  required>
                        <label for="sertif">Sertifikat</label>
                        <input class="form-control mb-2" name="sertif" id="sertif" type="file"  required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="UpBukti" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

     
    <?php }?>
    
    <?php
     $qKema = mysqli_query($koneksi,"SELECT ID_APPROVAL, NIDN_KEMAHASISWAAN,  REVISI, tgl FROM approval_proposal where APPROVAL_PROPOSAL_KEMAHASISWAAN = 'Unapproved' " );
    
     while($dataD = mysqli_fetch_array($qKema)){
    ?>
     <!--Revisi Modal -->
     <div class="modal fade" id="revisi<?= trim($dataD['ID_APPROVAL']) ?>" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Revisi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php
                    $kema = $dataD['NIDN_KEMAHASISWAAN'];
                    $qK = mysqli_query($koneksi,"SELECT NAMA_KEMAHASISWAAN FROM kemahasiswaan where NIDN_KEMAHASISWAAN = $kema " );
                    $nama = mysqli_fetch_row($qK) ?>
                </div>
                <div class="modal-body">
                    <form action="Logic/Administrasi.php" method="post" >
                      <label for="revisi">Note Revisi</label>
                      <textarea  class="form-control mb-2" name="revisi" id="revisi" cols="30" rows="3" disabled><?=$dataD['REVISI'] ?></textarea>
                      <label for="kema">Kemahasiswaan</label>
                      <input class="form-control mb-2" type="text" value="<?= $nama[0] ?>" disabled>
                      <label for="kema">Tanggal</label>
                      <input class="form-control mb-2" type="text" value="<?= $dataD['tgl'] ?>" disabled>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="UpBukti" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php }?>

    //revisi lpj
    <?php
     $qKema = mysqli_query($koneksi,"SELECT ID_APPROVALLPJ, NIDN_KEMAHASISWAAN,  REVISI_LPJ, tgl FROM approval_lpj where APPROVAL_LPJ_KEMAHASISWAAN = 'Unapproved' " );
    
     while($datalpj = mysqli_fetch_array($qKema)){
    ?>
     <!--Revisi Modal -->
     <div class="modal fade" id="revisilpj<?= trim($datalpj['ID_APPROVALLPJ']) ?>" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Revisi LPJ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php
                    $kema = $datalpj['NIDN_KEMAHASISWAAN'];
                    $qK = mysqli_query($koneksi,"SELECT NAMA_KEMAHASISWAAN FROM kemahasiswaan where NIDN_KEMAHASISWAAN = $kema " );
                    $nama = mysqli_fetch_row($qK) ?>
                </div>
                <div class="modal-body">
                    <form action="Logic/Administrasi.php" method="post" >
                      <label for="revisi">Note Revisi</label>
                      <textarea  class="form-control mb-2" name="revisi" id="revisi" cols="30" rows="3" disabled><?=$datalpj['REVISI_LPJ'] ?></textarea>
                      <label for="kema">Kemahasiswaan</label>
                      <input class="form-control mb-2" type="text" value="<?= $nama[0] ?>" disabled>
                      <label for="kema">Tanggal</label>
                      <input class="form-control mb-2" type="text" value="<?= $datalpj['tgl'] ?>" disabled>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="UpBukti" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
</body>

</html>
<?php include 'Template/EditProfilePass.php' ?>
<?php

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
          text: 'gagal ',
          
          })
          </script>
          
<?php } 
unset($_SESSION['notif']);
?>