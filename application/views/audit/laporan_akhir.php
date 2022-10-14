
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<style>
    textarea{  
  /* box-sizing: padding-box; */
  overflow:hidden;
  /* demo only: */
  padding:10px;
  width:250px;
  font-size:14px;
  display:block;
  border-radius:10px;
  border:6px solid #556677;
}

</style>
<div class="row">
      <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <labeln class="mb-0" >Nama Yang Audit</label>
                    <input class="form-control" type="text" readonly value="<?= $data->first_name.' '.$data->last_name ?>">
                 </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label >Nama Bagian Yang Di Audit</label>
                    <input class="form-control" type="text" readonly value="<?= $data->nama_bagian ?>">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label >Status</label>
                    <input class="form-control" type="text" readonly value="<?= $data->status ?>">
                 </div>
             </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label >Tanggal Mulai</label>
                    <input class="form-control" type="text" readonly value="<?= $data->start_date ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label >Tanggal Berakhir</label>
                    <input class="form-control" type="text" readonly value="<?= $data->end_date ?>">
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group">
                <label >Kisi-kisi</label>
                <textarea readonly id="kisikisi" class="form-control"  rows='5'><?= empty($data->kisi_kisi)?'NULL':$data->kisi_kisi ?></textarea>
        </div>
        <hr>
        <div class="form-group">
                <label >Jawaban Auditee</label>
                <p><?= empty($text)?'NULL':$text ?></p>
        </div>
        <hr>
        <div class="form-group">
                <label >Ringkasan Audit/Temuan</label>
                <textarea readonly class="form-control" id="materi" rows='5'><?= empty($data->pesan_kesalahan)?'NULL':$data->pesan_kesalahan ?></textarea>
        </div>
        <hr>
        <div class="form-group">
                <label >Balasan Kesalahan</label>
                <textarea readonly class="form-control" id="balasan" rows='5'><?= empty($data->balasan_kesalahan)?'NULL':$data->balasan_kesalahan ?></textarea>
        </div>
      <!-- <div class="form-group">
            <label for="kisi_kisi" >Kisi-kisi</label>
            <textarea class="form-control" class="form-control" name="kisi_kisi" id="kisi_kisi" cols="30" rows="10"></textarea>
     </div> -->
</div>
</div>

<script>
    window.onload = () => {
        var kisiKisi = document.querySelector('#kisikisi');
        action(kisiKisi)
        var materi = document.querySelector('#materi');
        action(materi)
        var balasan = document.querySelector('#balasan');
        action(balasan)
        function action(el){
            setTimeout(function(){
                el.style.cssText = 'height:auto; padding:0';
                // for box-sizing other than "content-box" use:
                    el.style.cssText = '-moz-box-sizing:content-box';
                    el.style.cssText = 'height:' + el.scrollHeight + 'px';
                },0);
            }
        };
        setTimeout(()=> {
            window.print();
        }, 400)
</script>