<h1><?php echo lang('edit_user_heading');?></h1>
<p><?php echo lang('edit_user_subheading');?></p>

<div id="infoMessage"><?php echo ($message ? '<div class="alert alert-success">'.$message.'</div>' : '');?></div>

<div class="row">
      <div class="col-sm-6">
            <form id="tambah-audit" method="post">
            <div class="form-group">
                        <label for="user_id" class="label label-default">Auditor</label>
                        <select name="user_id" id="user_id" class="form-control">
                              <?php foreach($users as $user): ?>
                              <option value="<?= $user->id ?>"><?= $user->first_name ?> <?= $user->last_name ?></option>
                              <?php endforeach ?>
                        </select>
                  </div>
                  <div class="form-group">
                        <label for="bagian_id" class="label label-default">Nama Bagian</label>
                        <select name="bagian_id" id="bagian_id" class="form-control">
                              <?php foreach($bagians as $bagian): ?>
                              <option value="<?= $bagian->id ?>"><?= $bagian->nama ?></option>
                              <?php endforeach ?>
                        </select>
                  </div>
                  <div class="form-group">
                        <label for="start_date" class="label label-default">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" value="" placeholder="Start Date" class="form-control">
                  </div>
                  <div class="form-group">
                        <input type="submit" name="submit" id="submit" value="Simpan" class="btn btn-primary">
                        <a href="<?php echo base_url('pengguna') ?>" class="btn btn-danger">Kembali</a>
                  </div>
            </form>
      </div>
</div>
<script>
      $(document).ready(function(){
            //insert
            $(document).on('submit', '#tambah-audit', function(e){
                  e.preventDefault();
                  let data = $(this).serialize();
                  $.ajax({
                        url: `<?= base_url('audit/tambah') ?>`,
                        type: 'POST',
                        data,
                        dataType: "JSON",
                        success: function(hasil){
                              let message = `*List Auditee yang harus di check:* \n\n`;
                              message += `*Tanggal Mulai:* ${hasil.start_date} \n`
                              message += `*Bagian Yang Di Audit:* ${hasil.nama_bagian}\n`
                              message += `*Auditor:* ${hasil.nama}\n`
                              async function sendMessage(){
                                          try {
                                          let request = await fetch("http://103.139.192.77:5000/send-message",{
                                                method: "POST",
                                                headers: {
                                                      "Content-Type": "application/json",
                                                },
                                                body: JSON.stringify({'message': message, 'number': hasil.phone})
                                          })
                                          let response = await request.json();
                                          console.log(response);
                                          } catch (error) {
                                          console.log(error);
                                          }
                                    }
                               sendMessage()
                               document.location.href = "<?= base_url('audit') ?>"
                        }
                  })
                 
            })

            $(document).on('change', '#user_id', function(){
                  let id = $(this).val();
                 
                 
            })
      })
      //  <?php if(isset($audit_user)): ?>
      //       let message = `*List Auditee yang harus di check:* \n\n`;

      //       <?php foreach($audit_user as $audit): ?>
      //           message += `status: <?= $audit->status ?> \n`
      //           message += `start date: <?= $audit->start_date ?> \n`
      //           message += `kisi-kisi: <?= $audit->kisi_kisi ?> \n`
      //           message += `\n`
      //       <?php endforeach ?>
      //     async function sendMessage(){
      //       try {
      //           let request = await fetch("http://103.139.192.77:5000/send-message",{
      //               method: "POST",
      //               headers: {
      //                   "Content-Type": "application/json",
      //               },
      //               body: JSON.stringify({'message': message, 'number': "<?= $this->session->userdata()['phone'] ?>"})
      //           })
      //           let response = await request.json();
      //           console.log(response);
      //       } catch (error) {
      //           console.log(error);
      //       }
      //      }
      //      sendMessage()
      //      <?php endif ?>
</script>