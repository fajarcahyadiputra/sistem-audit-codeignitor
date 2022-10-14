<script type="text/javascript">
    $(function() {
        $(".knob").knob();
    });
</script>
<style>
.fc-event-time, .fc-event-title {
padding: 0 1px;
white-space: normal;
}
</style>
<div class="panel panel-default">
    <div class="panel-heading no-collapse">Status Terbaru </div>
    <div id="page-stats" class="panel-collapse panel-body collapse in">

        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="knob-container">
                    <input class="knob" data-width="200" data-min="0" data-max="<?php echo $jml_document; ?>" data-displayPrevious="true"
                        value="<?php echo $jml_document; ?>" data-fgColor="#92A3C2" data-readOnly=true;>
                    <h3 class="text-muted text-center">Jumlah Document</h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="knob-container">
                    <input class="knob" data-width="200" data-min="0" data-max="<?php echo $jml_audit_close; ?>" data-displayPrevious="true"
                        value="<?php echo $jml_audit_close; ?>" data-fgColor="#92A3C2" data-readOnly=true;>
                    <h3 class="text-muted text-center">Jumlah Audit Close</h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="knob-container">
                    <input class="knob" data-width="200" data-min="0" data-max="<?php echo $jml_audit_proses; ?>" data-displayPrevious="true"
                        value="<?php echo $jml_audit_proses; ?>" data-fgColor="#92A3C2" data-readOnly=true;>
                    <h3 class="text-muted text-center">Jumlah Audit On Progress</h3>
                </div>
            </div>
        </div>
        <hr>
        <?php if($group == 'auditee' || $group == 'admin'){ ?>
        <div class="container mt-4">
            <div class="row">
                <!-- <div class="col-lg-4">
                    <div class="alert alert-warning" role="alert">
                        <h4>Form Kegiatan</h4>
                    </div>
                    <div class="card">
                        <form action="<?= base_url("jadwal/tambah") ?>" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-label">Keterangan Kegiatan</div>
                                    <textarea required name="judul" class="form-control" id="kegiatan" cols="30"
                                        rows="2"></textarea>
                                </div>
                                <div class="form-group mt-4">
                                    <div class="form-label">Tgl Mulai</div>
                                    <input required type="datetime-local" class="form-control" name="mulai" id="mulai">
                                </div>
                                <div class="form-group mt-4">
                                    <div class="form-label">Tgl Selesai</div>
                                    <input required type="datetime-local" class="form-control" name="selesai" id="selesai">
                                </div>
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->
                <div class="col-lg-12">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>


        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.css' rel='stylesheet' />
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.js'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
            integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    let events = []
        <?php   foreach($jadwal as $jad){  ?>
    events.push({
        title: '<?php echo $jad->nama.' - '.$jad->status ?>', //menampilkan title dari tabel
        start: '<?php echo $jad->start_date . " 00:00:00"?>', //menampilkan tgl mulai dari tabel
        end: '<?php echo $jad->start_date ." 00:00:00"?>' //menampilkan tgl selesai dari tabel
    });
    <?php } ?>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            // initialView: 'timelineWeek',
            initialView: 'dayGridMonth',
            headerToolbar: {
      right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
      center: "title",
      left: "prevYear,prev,next,nextYear"
    },
            events,
            selectOverlap: function (event) {
                return event.rendering === 'background';
            }
        });
    
        calendar.render();
            });

           
        </script>