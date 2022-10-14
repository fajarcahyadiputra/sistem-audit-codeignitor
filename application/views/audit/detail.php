

<div class="row">
      <div class="col-sm-12">
        <a class="btn btn-info" href="<?= base_url("audit/laporanAkhir/". $data->id) ?>">Export PDF</a>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="label label-default">Nama Yang Audit</label>
                    <input class="form-control" type="text" readonly value="<?= $data->first_name.' '.$data->last_name ?>">
                 </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="label label-default">Nama Bagian Yang Di Audit</label>
                    <input class="form-control" type="text" readonly value="<?= $data->nama_bagian ?>">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="label label-default">Status</label>
                    <input class="form-control" type="text" readonly value="<?= $data->status ?>">
                 </div>
             </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="label label-default">Tanggal Mulai</label>
                    <input class="form-control" type="text" readonly value="<?= $data->start_date ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="label label-default">Tanggal Berakhir</label>
                    <input class="form-control" type="text" readonly value="<?= $data->end_date ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
                <label class="label label-default">Kisi-kisi</label>
                <textarea readonly class="form-control"  cols="30" rows="10"><?= $data->kisi_kisi ?></textarea>
        </div>
        <div class="form-group">
                <label class="label label-default">Ringkasan Audit/Temuan</label>
                <textarea readonly class="form-control"  cols="30" rows="10"><?= $data->pesan_kesalahan ?></textarea>
        </div>
        <div class="form-group">
                <label class="label label-default">Balasan Kesalahan</label>
                <textarea readonly class="form-control"  cols="30" rows="10"><?= $data->balasan_kesalahan ?></textarea>
        </div>
      <!-- <div class="form-group">
            <label for="kisi_kisi" class="label label-default">Kisi-kisi</label>
            <textarea class="form-control" class="form-control" name="kisi_kisi" id="kisi_kisi" cols="30" rows="10"></textarea>
     </div> -->
     <?php foreach($documents as $doc): ?>
     <div class="form-group">
     <label class="label label-default">Document Yang Di Check</label>
        <?php if($doc->file_url != NULL || $doc->file_url != ""): ?>
            <iframe src ="<?= base_url($doc->file_url) ?>" width='100%' height='550' allowfullscreen webkitallowfullscreen></iframe>
            <?php endif ?>
        </div>
      <?php endforeach ?>
      
      <div class="form-group">
     <label class="label label-default">Document Balasan Dari Kesalahan</label>
    <?php if($data->file_url_kesalahan != NULL || $data->file_url_kesalahan != ""): ?>
        <iframe src ="<?= base_url($data->file_url_kesalahan) ?>" width='100%' height='550' allowfullscreen webkitallowfullscreen></iframe>
        <?php endif ?>
      </div>
</div>
</div>

