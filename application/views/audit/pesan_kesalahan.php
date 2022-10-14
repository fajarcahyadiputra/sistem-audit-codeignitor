<h1><?php echo lang('edit_user_heading');?></h1>
<p><?php echo lang('edit_user_subheading');?></p>

<div id="infoMessage"><?php echo ($message ? '<div class="alert alert-success">'.$message.'</div>' : '');?></div>

<div class="row">
      <div class="col-sm-12">
            <form action="" method="post">
            <div class="form-group">
                              <label for="pesan_kesalahan" class="label label-default">Pesan Kesalahan</label>
                              <textarea required class="form-control" name="pesan_kesalahan" id="pesan_kesalahan" cols="30" rows="10"><?= $data->pesan_kesalahan ?></textarea>
                        </div>
                  <div class="form-group">
                        <input type="submit" name="submit" id="submit" value="Simpan" class="btn btn-primary">
                        <a href="<?php echo base_url('audit') ?>" class="btn btn-danger">Kembali</a>
                        <a href="javascript:void(0);" onclick="var a=confirm('Anda yakin ingin menghapus?');if(a){window.location.replace('<?php echo base_url('audit/delete/' . $data->id) ?>')}">Hapus</a>
                  </div>
            </form>
      </div>
</div>
