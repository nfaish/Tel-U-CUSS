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
            <h1>Proses Pengajuan Penelitian</h1><hr><br>
            <?php if ($this->session->flashdata('alert_tolak')) {?>
                <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $this->session->flashdata('alert_tolak'); ?>
                </div>
            <?php } ?>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="<?= base_url('/Penelitian_kk') ?>" class="btn btn-secondary">Pengajuan belum disetujui</a>
                <a href="<?= base_url('/Penelitian_kk/pengajuanSetuju') ?>" class="btn btn-secondary">Pengajuan sudah disetujui</a>
                <a href="" class="btn btn-secondary active">Pengajuan ditolak</a>
            </div><br><br>
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Skema Penelitian</th>
                    <th>Dosen Pemohon</th>
                    <th>Tanggal Mengajukan</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach($list_penelitian as $row){ ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $row['judul_penelitian'] ?></td>
                        <td><?= $row['skema'] ?></td>
                        <td><?= $row['nama_awal']; ?> <?= $row['nama_akhir']; ?></td>
                        <td><?= tgl_indo($row['tgl_mengajukan']) ?></td>
                        <td><?= $row['status'] ?></td>
                        <td>
                          <center><a href='<?= base_url('/Penelitian_kk/penelitianDetail/'.$row['id_penelitian']) ?>' class='btn btn-sm btn-primary'>Detail</i></a></center>
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
