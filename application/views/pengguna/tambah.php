<h1><?php echo lang('edit_user_heading');?></h1>
<p><?php echo lang('edit_user_subheading');?></p>

<div id="infoMessage"><?php echo ($message ? '<div class="alert alert-success">'.$message.'</div>' : '');?></div>

<div class="row">
      <div class="col-sm-6">
            <form action="" method="post">
                  <div class="row">
                        <div class="col-sm-6">
                              <div class="form-group">
                                    <label for="first_name" class="label label-default">Nama Depan</label>
                                    <input type="text" name="first_name" id="first_name" value="" placeholder="Nama Depan" class="form-control">
                              </div>
                        </div>
                        <div class="col-sm-6">
                              <div class="form-group">
                                    <label for="last_name" class="label label-default">Nama Belakang</label>
                                    <input type="text" name="last_name" id="last_name" value="" placeholder="Nama Belakang" class="form-control">
                              </div>
                        </div>
                  </div>
                  <div class="form-group">
                        <label for="username" class="label label-default">Username</label>
                        <input type="text" name="username" id="username" value="" placeholder="Username" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="group_id" class="label label-default">Select Group</label>
                      <select class="form-control" name="group_id" id="group_id">
                        <?php foreach($groups as $group): ?>
                              <option value="<?= $group->id ?>"><?= $group->name?></option>
                        <?php endforeach ?>
                      </select>
                  </div>
                  <div class="form-group">
                        <label for="bagian_id" class="label label-default">Select Bagian <span class="text-info">* Jika Bukan Auditee jangan di isi</span></label>
                      <select class="form-control" name="bagian_id" id="bagian_id">
                        <option value="" selected disabled hidden>- Select Bagian -</option>
                        <?php foreach($bagian as $bag): ?>
                              <option value="<?= $bag->id ?>"><?= $bag->nama?></option>
                        <?php endforeach ?>
                      </select>
                  </div>
                  <div class="form-group">
                        <label for="email" class="label label-default">Email</label>
                        <input type="email" name="email" id="email" value="" placeholder="Email" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="phone" class="label label-default">No. Telp</label>
                        <input type="text" name="phone" id="phone" value="" placeholder="No. Telp" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="password" class="label label-default">Password</label>
                        <input type="password" name="password" id="password" value="" placeholder="Password" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="password_confirm" class="label label-default">Konfirmasi Password</label>
                        <input type="password" name="password_confirm" id="password_confirm" value="" placeholder="Konfirmasi Password" class="form-control">
                  </div>
                  <div class="form-group">
                        <input type="submit" name="submit" id="submit" value="Simpan" class="btn btn-primary">
                        <a href="<?php echo base_url('pengguna') ?>" class="btn btn-danger">Kembali</a>
                  </div>
            </form>
      </div>
</div>
<script>
      // $(document).ready(function(){
      //       $(document).on('change', '#group_id', function(){
      //             let id = $(this).val();
      //             if(id == 4){

      //             }
      //       })
      // })
</script>
