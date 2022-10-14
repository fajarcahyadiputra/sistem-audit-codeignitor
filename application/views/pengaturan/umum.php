<ul class="nav nav-tabs">
    <li class="active"><a href="<?php echo base_url('pengaturan') ?>">Umum</a></li>
    <li><a href="<?php echo base_url('pengaturan/produk') ?>">Produk</a></li>
</ul>

<br>

<div id="infoMessage"><?php echo ($message ? '<div class="alert alert-success">'.$message.'</div>' : '');?></div>

<form action="" method="post">
      <div class="row">
            <div class="col-sm-6">
                  <div class="form-group">
                        <label for="penanggungjawab" class="label label-default">Nama Penanggungjawab Perusahaan</label>
                        <input type="text" name="penanggungjawab" id="penanggungjawab" value="<?php echo $data->penanggungjawab ?>" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="nama_perusahaan" class="label label-default">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" id="nama_perusahaan" value="<?php echo $data->nama_perusahaan ?>" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="alamat_perusahaan" class="label label-default">Alamat Lengkap</label>
                        <input type="text" name="alamat_perusahaan" id="alamat_perusahaan" value="<?php echo $data->alamat_perusahaan ?>" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="telp_perusahaan" class="label label-default">No. Telp</label>
                        <input type="text" name="telp_perusahaan" id="telp_perusahaan" value="<?php echo $data->telp_perusahaan ?>" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="email_perusahaan" class="label label-default">Email</label>
                        <input type="text" name="email_perusahaan" id="email_perusahaan" value="<?php echo $data->email_perusahaan ?>" class="form-control">
                  </div>
                  <div class="form-group">
                        <input type="submit" name="submit" id="submit" value="Simpan" class="btn btn-primary">
                  </div>
            </div>
      </div>
</form>