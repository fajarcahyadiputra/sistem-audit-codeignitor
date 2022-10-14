<div id="infoMessage"><?php echo (isset($message) ? '<div class="alert alert-success">'.$message.'</div>' : '');?></div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default pt-2">
            <div class="panel-heading no-collapse">Data Document
            </div>
            <div style="padding:20px;">
                <table id="datatablenya" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th class="not-export-col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;foreach($document as $data): ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $data->nama ?></td>
                            <td><?php echo $data->description ?></td>
                            <td>
                                <a href="<?php echo base_url('document/edit/'. $data->id) ?>" class="badge btn-warning">Edit</a> 
                                <a href="<?php echo base_url('document/delete/'. $data->id) ?>" class="badge btn-danger">Hapus</a>
                                <a href="<?php echo base_url('document/detail/'. $data->id) ?>" class="badge btn-info">Detail</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
  var table = $('#datatablenya').DataTable()
} );
</script>