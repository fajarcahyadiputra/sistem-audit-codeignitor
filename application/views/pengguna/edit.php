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
                                    <input type="text" name="first_name" id="first_name" value="<?php echo $pengguna->first_name ?>" placeholder="Nama Depan" class="form-control">
                              </div>
                        </div>
                        <div class="col-sm-6">
                              <div class="form-group">
                                    <label for="last_name" class="label label-default">Nama Belakang</label>
                                    <input type="text" name="last_name" id="last_name" value="<?php echo $pengguna->last_name ?>" placeholder="Nama Belakang" class="form-control">
                              </div>
                        </div>
                  </div>
                  <div class="form-group">
                        <label for="group_id" class="label label-default">Select Group</label>
                      <select class="form-control" name="group_id" id="group_id">
                        <?php foreach($groups as $group): ?>
                              <option <?= $userGroup->group_id == $group->id?"selected":'' ?> value="<?= $group->id ?>"><?= $group->name?></option>     
                        <?php endforeach ?>
                      </select>
                  </div>
                  <div class="form-group">
                        <label for="username" class="label label-default">Username</label>
                        <input type="text" name="username" id="username" value="<?php echo $pengguna->username ?>" placeholder="Username" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="email" class="label label-default">Email</label>
                        <input type="text" name="email" id="email" value="<?php echo $pengguna->email ?>" placeholder="Email" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="phone" class="label label-default">No. Telp</label>
                        <input type="text" name="phone" id="phone" value="<?php echo $pengguna->phone ?>" placeholder="No. Telp" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="password" class="label label-default">Password</label>
                        <input type="password" name="password" id="password" value="" placeholder="Biarkan kosong jika tidak ingin diubah" class="form-control">
                  </div>
                  <div class="form-group">
                        <input type="submit" name="submit" id="submit" value="Simpan" class="btn btn-primary">
                        <a href="<?php echo base_url('pengguna') ?>" class="btn btn-danger">Kembali</a>
                        <?php if(!$this->ion_auth->is_admin($pengguna->id)) { echo '<a href="javascript:void(0);" onclick="var a=confirm(\'Anda yakin ingin menghapus?\');if(a){window.location.replace(\''.base_url('pengguna/delete/'.$pengguna->id).'\')}">Hapus</a>'; } ?>
                  </div>
            </form>
      </div>
</div>
