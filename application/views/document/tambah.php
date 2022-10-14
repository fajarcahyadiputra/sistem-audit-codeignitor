<h1><?php echo lang('edit_user_heading');?></h1>
<p><?php echo lang('edit_user_subheading');?></p>

<div id="infoMessage"><?php echo ($message ? '<div class="alert alert-success">'.$message.'</div>' : '');?></div>

<div class="row">
      <div class="col-sm-6">
            <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                        <label for="nama" class="label label-default">Nama Document</label>
                        <input type="nama" name="nama" id="nama" value="" placeholder="nama" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="file_doc" class="label label-default">Document File <small class="text-info">*hanya pdf</small></label>
                        <input type="file" name="file_doc" id="file_doc" value="" placeholder="file_doc" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="description" class="label label-default">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                  </div>
                  <div class="form-group">
                        <input type="submit" name="submit" id="submit" value="Simpan" class="btn btn-primary">
                        <a href="<?php echo base_url('pengguna') ?>" class="btn btn-danger">Kembali</a>
                  </div>
            </form>
      </div>
</div>
