<ul class="nav nav-tabs">
    <li><a href="<?php echo base_url('pengaturan') ?>">Umum</a></li>
    <li class="active"><a href="<?php echo base_url('pengaturan/produk') ?>">Produk</a></li>
</ul>

<br>

<div id="infoMessage"><?php echo ($message ? '<div class="alert alert-success">'.$message.'</div>' : '');?></div>

<form action="" method="post">
      <div class="row">
            <div class="col-sm-6">
                  <div class="form-group">
                        <label for="mata_uang" class="label label-default">Mata Uang</label>
                        <select name="mata_uang" id="mata_uang" class="form-control">
                              <option <?php echo ($data->mata_uang == 'Rp' ? 'selected' : '') ?> value="Rp">Rupiah Indonesia (rp)</option>
                              <option <?php echo ($data->mata_uang == '$' ? 'selected' : '') ?> value="$">Dolar Amerika ($)</option>
                        </select>
                  </div>
                  <div class="form-group">
                        <label for="satuan_berat" class="label label-default">Satuan Berat</label>
                        <select name="satuan_berat" id="satuan_berat" class="form-control">
                              <option <?php echo ($data->satuan_berat == 'kg' ? 'selected' : '') ?> value="kg">Kilogram (kg)</option>
                              <option <?php echo ($data->satuan_berat == 'g' ? 'selected' : '') ?> value="g">Gram (g)</option>
                        </select>
                  </div>
                  <div class="form-group">
                        <input type="submit" name="submit" id="submit" value="Simpan" class="btn btn-primary">
                  </div>
            </div>
      </div>
</form>
