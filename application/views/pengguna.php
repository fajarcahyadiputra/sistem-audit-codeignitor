<div id="infoMessage"><?php echo (isset($message) ? '<div class="alert alert-success">'.$message.'</div>' : '');?></div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default pt-2">
            <div class="panel-heading no-collapse">Data Pengguna
            </div>
            <div style="padding:20px;">
                <table id="datatablenya" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>No. Telp</th>
                            <th>Status</th>
                            <th class="not-export-col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;foreach($pengguna as $data): ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $data->username ?></td>
                            <td><?php echo $data->first_name . ($data->last_name ? ' '.$data->last_name : '') ?></td>
                            <td><?php echo $data->email ?></td>
                            <td><?php echo $data->nama_group ?></td>
                            <td><?php echo $data->phone ?></td>
                            <td><?php echo ($data->active ? 'Aktif' : 'Tidak Aktif') ?></td>
                            <td><a href="<?php echo base_url('pengguna/edit/'. $data->id) ?>" class="badge btn-warning">Edit</a> <a href="<?php echo base_url('pengguna/delete/'. $data->id) ?>" class="badge btn-danger">Hapus</a></td>
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
  var ignorePositions = []; // column indexes of data NOT to be exported
  var reversedHeaders = []; // with "not-export" headings removed

  var table = $('#datatablenya').DataTable( {
    dom: 'Bfrtip',
    initComplete:function (  ) {
      var thead = $( '#datatablenya' ).DataTable().table().header();
      var tds = $( thead ).find( 'th' ).each(function( index ) {
        if ( ! $( this ).hasClass('not-export-col') ) {
          reversedHeaders.push( $( this ).text() );
        } else {
          ignorePositions.push(index);
        }
      });
      reversedHeaders.reverse(); // to give us the export order we want
      ignorePositions.reverse(); // reversed for when we splice() - see below
    },
    buttons: [
      { 
        extend: 'pdf',
        text: 'To PDF',
        exportOptions: {
          rows: function ( idx, data, node ) {
            var keepRowData = [];
            // we splice to remove those data fields we do not want to export:
            ignorePositions.forEach(idx => data.splice(idx, 1) );
            return data.reverse();
          },
          columns: ':visible:not(.not-export-col)',
          format: { 
            header: function ( data, idx, node ) {
              return reversedHeaders[idx];
            }
          }
        }
      },
      { 
        extend: 'excelHtml5',
        text: 'To Excel',
        exportOptions: {
          rows: function ( idx, data, node ) {
            var keepRowData = [];
            // we splice to remove those data fields we do not want to export:
            ignorePositions.forEach(idx => data.splice(idx, 1) );
            return data.reverse();
          },
          columns: ':visible:not(.not-export-col)',
          format: { 
            header: function ( data, idx, node ) {
              return reversedHeaders[idx];
            }
          }
        }
      }
    ]
  } );
} );
</script>