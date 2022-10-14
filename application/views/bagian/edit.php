<h1><?php echo lang('edit_user_heading');?></h1>
<p><?php echo lang('edit_user_subheading');?></p>

<div id="infoMessage"><?php echo ($message ? '<div class="alert alert-success">'.$message.'</div>' : '');?></div>

<div class="row">
      <div class="col-sm-6">
            <form action="" method="post">
            <div class="form-group">
                        <label for="nama_bagian" class="label label-default">Nama Bagian</label>
                        <input type="nama_bagian" name="nama" id="nama_bagian" value="<?=$data->nama ?>" placeholder="nama_bagian" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="description" class="label label-default">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10"><?=$data->description ?></textarea>
                  </div>
                  <div class="form-group">
                        <input type="submit" name="submit" id="submit" value="Simpan" class="btn btn-primary">
                        <a href="<?php echo base_url('bagian') ?>" class="btn btn-danger">Kembali</a>
                        <a href="javascript:void(0);" onclick="var a=confirm('Anda yakin ingin menghapus?');if(a){window.location.replace('<?php echo base_url('bagian/delete/' . $data->id) ?>')}">Hapus</a>
                  </div>
            </form>
      </div>
</div>
