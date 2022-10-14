<h1><?php echo lang('edit_user_heading');?></h1>
<p><?php echo lang('edit_user_subheading');?></p>

<div id="infoMessage"><?php echo ($message ? '<div class="alert alert-success">'.$message.'</div>' : '');?></div>

<div class="row">
      <div class="col-sm-6">
            <form action="" method="post">
                  <?php if($group == 'auditor'){ ?>
                        <?php if($data->tahapan == 4){ ?>
                        <div class="form-group">
                              <label for="pesan_kesalahan" class="label label-default">Pesan Kesalahan</label>
                              <textarea class="form-control" name="pesan_kesalahan" id="pesan_kesalahan" cols="30" rows="10"></textarea>
                        </div>
                        <?php }else{ ?>
                        <div class="form-group">
                              <label for="kisi_kisi" class="label label-default">Kisi-kisi</label>
                              <textarea class="form-control" name="kisi_kisi" id="kisi_kisi" cols="30" rows="10"></textarea>
                        </div>
                        <?php } ?>
                  <?php }else if($group == 'auditee'){ ?>
                        <?php if($data->tahapan == 5){ ?>
                        <div class="form-group">
                              <label for="balasan_kesalahan" class="label label-default">Balasan Kesalahan</label>
                              <textarea class="form-control" name="balasan_kesalahan" id="balasan_kesalahan" cols="30" rows="10"></textarea>
                        </div>
                        <?php }else{ ?>
                              <div class="form-group">
                              <label for="document_id" class="label label-default">Pilih Document</label>
                              <select name="document_id" id="document_id" class="form-control">
                                    <?php foreach($documents as $doc): ?>
                                    <option value="<?= $doc->id ?>"><?= $doc->nama ?></option>
                                    <?php endforeach ?>
                              </select>
                          </div>
                        <?php }?>
                       
                  <?php } ?>
                  
                  <div class="form-group">
                        <input type="submit" name="submit" id="submit" value="Simpan" class="btn btn-primary">
                        <a href="<?php echo base_url('audit') ?>" class="btn btn-danger">Kembali</a>
                        <a href="javascript:void(0);" onclick="var a=confirm('Anda yakin ingin menghapus?');if(a){window.location.replace('<?php echo base_url('audit/delete/' . $data->id) ?>')}">Hapus</a>
                  </div>
            </form>
      </div>
</div>

