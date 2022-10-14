<h1><?php echo lang('edit_user_heading');?></h1>
<p><?php echo lang('edit_user_subheading');?></p>

<div id="infoMessage"><?php echo ($message ? '<div class="alert alert-success">'.$message.'</div>' : '');?></div>

<div class="row">
      <div class="col-sm-12">
            <form action="" method="post">
            <div class="form-group">
                    <label for="balasan_kesalahan" class="label label-default">Balasan Kesalahan</label>
                    <textarea required class="form-control" name="balasan_kesalahan" id="balasan_kesalahan" cols="30" rows="10"><?= $data->balasan_kesalahan ?></textarea>
            </div>
            <div class="form-group">
                    <label for="document_id" class="label label-default">Pilih Document</label>
                    <select required name="document_id" id="document_id" class="form-control">
                        <?php foreach($documents as $doc): ?>
                        <option <?= $data->document_id == $doc->id ? "selected":"" ?> value="<?= $doc->id ?>"><?= $doc->nama ?></option>
                        <?php endforeach ?>
                    </select>
             </div>
                  <div class="form-group">
                        <input type="submit" name="submit" id="submit" value="Simpan" class="btn btn-primary">
                        <a href="<?php echo base_url('audit') ?>" class="btn btn-danger">Kembali</a>
                        <a href="javascript:void(0);" onclick="var a=confirm('Anda yakin ingin menghapus?');if(a){window.location.replace('<?php echo base_url('audit/delete/' . $data->id) ?>')}">Hapus</a>
                  </div>
            </form>
      </div>
</div>
