<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view("_partials/header.php") ?>
  </head>
  <body id="page-top">
    <?php $this->load->view("_partials/js.php") ?>
    <?php $this->load->view("_partials/navbar.php", $this->data) ?>

    <div id="wrapper">
      <?php $this->load->view("_partials/sidebar.php") ?>
      <div id="content-wrapper">
       <div class="container-fluid">
            <div class="mb-3">
            <h1>Pengajuan Mahasiswa</h1><hr><br>
            <?php if ($this->session->flashdata('alert_setuju')) {?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $this->session->flashdata('alert_setuju'); ?>
                </div>
            <?php } ?>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="<?= base_url('/data/pengajuantopik') ?>" class="btn btn-secondary">Pengajuan Topik</a>
                <a href="<?= base_url('/data/pengajuanpembimbing') ?>" class="btn btn-secondary">Pengajuan Pembimbing</a>
                <a href="<?= base_url('/Data/topikdisetujui') ?>" class="btn btn-secondary">Pengajuan Judul</a>
                <a href="<?= base_url('/Data/prosespengerjaan') ?>" class="btn btn-secondary">Proses Pengerjaan</a>
                <a a href="" class="btn btn-secondary active">Proses Proposal</a>
                <!-- <a href="<?= base_url('/Data/prosesproposal2') ?>" class="btn btn-secondary">Proposal Pembimbing</a> -->
            </div><br><br>
                          <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>NAMA</th>
                    <th>PENERBIT</th>
                    <th>TOPIK</th>
                    <th>JUDUL</th>
                    <th>PBB1</th>
                    <th>PBB2</th>
                    <th>STATUS</th>
                    
                    <th>PROPOSAL</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach($list_judulproposalta as $row){ ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $row['nim'] ?></td>
                        <td><?= $row['nama_awal']; ?> <?= $row['nama_akhir']; ?></td>
                        <td><?= $row['penerbit'] ?></td>
                        <td><?= $row['topik'] ?></td>
                        <td><?= $row['judul'] ?></td>
                        <td><?= $row['kode1'] ?></td>
                        <td><?= $row['kode2'] ?></td>
                        <td><?= $row['status'] ?> </td>
                        
                        <td>
                        <a href="<?php print base_url('/assets/documents/proposal/'.$row['proposal']) ?>" target="blank">
                        <?= $row['proposal'] ?>
                        </a>
                        </td>
                        <td>
                          <?php if($this->session->userdata('nip') == $row['nip'])
                          { ?>

                          <center><a href='<?= base_url('/Data/proposalupdate2/'.$row['id_judul']) ?>' class='btn btn-sm btn-primary'>Accept Proposal</i></a></center>
                          <br>
                          <center><a href='<?= base_url('/Data/detailjudulta/'.$row['id_judul']) ?>' class='btn btn-sm btn-primary'>Detail</i></a></center>
                          <br>
                          <center><a href='<?= base_url('/Data/rejectproposal/'.$row['id_judul']) ?>' class='btn btn-sm btn-primary'>Reject</i></a></center>
                                                 
                          <?php }else 
                          { ?>
                          
                          <center><a href='<?= base_url('/Data/detailjudulta/'.$row['id_judul']) ?>' class='btn btn-sm btn-primary'>Detail</i></a></center>
                          <br>
                          <!--<center><a href='<?= base_url('/Data/rejectproposal/'.$row['id_judul']) ?>' class='btn btn-sm btn-primary'>Reject</i></a></center>-->
                          <?php }?>
                          
                        </td>
                      </tr>
                    <?php $no++; } ?>
                </tbody>
              </table>           
          </div>
        </div>
      </div>
    </div>
    <?php 
      $this->load->view("_partials/footer.php")
    ?>
  </body>
</html>
