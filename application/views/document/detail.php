<h1><?php echo lang('edit_user_heading');?></h1>
<p><?php echo lang('edit_user_subheading');?></p>


<div class="row">
    <div class="col-sm-12">
        <a href="<?php echo base_url('document') ?>" class="btn btn-danger">Kembali</a>
        <div class="row" style="margin-top: 40px !important;">
                <div class="form-group">
                    <label class="label label-default">Nama</label>
                    <input class="form-control" type="text" readonly value="<?= $data->nama ?>">
                 </div>
                 <div class="form-group">
                     <label class="label label-default">Description</label>
                     <textarea class="form-control"  cols="30" rows="10"><?= $data->description ?></textarea>
             </div>
     <div class="form-group">
     <label class="label label-default">Document</label>
        <?php if($data->file_url != NULL || $data->file_url != ""): ?>
            <iframe src ="<?= base_url($data->file_url) ?>" width='100%' height='550' allowfullscreen webkitallowfullscreen></iframe>
            <?php endif ?>
        </div>
      </div>
</div>
</div>

