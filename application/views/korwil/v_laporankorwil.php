<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Korwil
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo site_url('C_User'); ?>">Data Korwil</a></li>
        <li class="active">Data Korwil</li>
      </ol>
    </section>
    <div class="box-body">
    <?php if ($this->session->flashdata('Sukses')) { ?>
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fa fa-check"></i> Sukses!</h5>
          <?=$this->session->flashdata('Sukses')?>.
        </div>                 
      <?php } ?>
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Korwil</h3>
            </div>

            <div class="box-body">
                <div class='row'>
                  <div class='col-lg-12'>
                    <div class="col-sm-3">
                      <a href="<?php echo site_url('C_Korwil/excel'); ?>"><button type="button" class="btn btn-success">Excel</button></a>
                    </div>
                  </div>
                </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal Berdiri</th>
                  <th>Nama Korwil</th>
                  <th>Alamat Kesekretariatan</th>
                  <th>Kode Korwil</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  foreach ($korwil as $korwil) { ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $korwil->tglberdiri; ?></td>
                  <td><?php echo $korwil->namakorwil; ?></td>
                  <td><?php echo $korwil->alamat.', '.$korwil->name_kota.', '.$korwil->name_prov; ?></td>
                  <td><?php echo $korwil->kodekorwil; ?></td>
                </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>