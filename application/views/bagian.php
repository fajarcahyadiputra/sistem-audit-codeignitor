<div id="infoMessage"><?php echo (isset($message) ? '<div class="alert alert-success">'.$message.'</div>' : '');?></div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default pt-2">
            <div class="panel-heading no-collapse">Data Bagian
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
                        <?php $i=1;foreach($bagian as $data): ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $data->nama ?></td>
                            <td><?php echo $data->description ?></td>
                            <td><a href="<?php echo base_url('bagian/edit/'. $data->id) ?>" class="badge btn-warning">Edit</a> <a href="<?php echo base_url('bagian/delete/'. $data->id) ?>" class="badge btn-danger">Hapus</a></td>
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
      reversedHeaders; // to give us the export order we want
      ignorePositions; // reversed for when we splice() - see below
    },
    buttons: [
      { 
        extend: 'pdf',
        text: 'To PDF',
        exportOptions: {
          modifier: {
                    page: 'current'
                },
          pageSize: "A4",
          rows: function ( idx, data, node ) {
            var keepRowData = [];
            // we splice to remove those data fields we do not want to export:
            ignorePositions.forEach(idx => data.splice(idx, 1) );
            return data;
          },
          columns: ':visible:not(.not-export-col)',
          format: { 
            header: function ( data, idx, node ) {
              return reversedHeaders[idx];
            }
          }
        },
        // customize: function ( doc ) {
        //         // Splice the image in after the header, but before the table
        //         doc.content.splice( 1, 0, {
        //             margin: [ 0, 0, 0, 8 ],
        //             alignment: 'center',
        //             image: 'data:image/png;base64,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'
        //         } );
                // Data URL generated by http://dataurl.net/#dataurlmaker
            // }
      },
      { 
        extend: 'excelHtml5',
        text: 'To Excel',
        exportOptions: {
          rows: function ( idx, data, node ) {
            var keepRowData = [];
            // we splice to remove those data fields we do not want to export:
            ignorePositions.forEach(idx => data.splice(idx, 1) );
            return data;
          },
          columns: ':visible:not(.not-export-col)',
          format: { 
            header: function ( data, idx, node ) {
              return reversedHeaders[idx];
            }
          }
        },
        
      }
    ]
  } );
} );
</script>