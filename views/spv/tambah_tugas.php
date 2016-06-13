
<!-- main content -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lib/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lib/bootstrap-datepicker/css/datepicker3.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lib/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
		<div id="main_wrapper">
			<div class="page_bar clearfix">
				<div class="row">
					<div class="col-lg-10">
						<h1 class="page_title">Tambah Tugas Baru</h1>
					</div>
				</div>
			</div>
			
			<nav class="breadcrumbs">
				<ul>
					<li><a href="#">Tugas</a></li>
					<li class="sep">\</li>
					<li>Tugas Baru</li>
				</ul>
			</nav>
			
			<div class="page_content">
				<div class="container-fluid">
					<?php echo form_open_multipart('spv/insert_tugas');?>
						<div class="row">
							<div class="col-lg-12">
								<div class="panel panel-default">
									<div class="panel-body">
									
									<input type="hidden" name="tgl_input" id="tgl_input" class="form-control">
									<div class="form-group">	
										<label for="select_koor">Koordinator</label>
										<select id="select_koor" name="koordinator" class="form-control">
											<option>Pilih Koordinator</option>
											<?php foreach ($koordina as $row ) {?>
											<option value="<?php echo $row->nik;?>"><?php echo $row->nama."(".$row->nik.")";?></option>	
											<?php } ?>
										</select>
									 </div>
										<div class="form-group">
											<label for="nama_tugas">Nama Tugas</label>
											<input type="text" name="nama_tugas" id="nama_tugas" class="form-control">
										</div>

										<div class="form-group">
										<label for="nama_tugas">Rincian Tugas</label>
											<textarea name="desc_tugas" id="desc_tugas" cols="30" rows="12" class="form-control"></textarea>
										</div>

										<div class="form-group">
											<select name = "prioritas" class="form-control">
												<option value = 1>Prioritas 1</option>
												<option value = 2>Prioritas 2</option>
												<option value = 3>Prioritas 3</option>
												<option value = 4>Prioritas 4</option>
											</select>
										</div>

										<div class="form-group">
											<label for="nama_tugas">Attachment Tugas</label>
											<input type="file" name="file_attachment"></input>
										</div>

										<div class="form-group">
										<label for="nama_tugas">Deadline Tugas</label>
										<div class="input-group date ts_datepicker col-lg-3" data-date-format="yyyy-mm-dd" style="float:left">
												<input class="form-control" name="tgl_deadline" type="text" placeholder="Tanggal Deadline" required>
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										</div>
										<div class="input-group bootstrap-timepicker col-lg-3" style="float:">
												<input id="tp-default" type="text" name="waktu_deadline" class="form-control" placeholder="Waktu Deadline" required>
												<span class="input-group-btn">
													<button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
												</span>
											</div>
										</div>

	
										<div class="form-group form-sep">
											<button type="submit" class="btn btn-success btn-sm"><span class="fa fa-envelope-o"></span> Submit</button>	
										</div>

									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>		
		</div>

		<?php echo $this->load->view('main/footer'); ?> 
		<!-- wysiwg editor -->
		<script src="<?php echo base_url(); ?>assets/lib/ckeditor/ckeditor.js"></script>
		<script src="<?php echo base_url(); ?>assets/lib/ckeditor/adapters/jquery.js"></script>
		<!-- select2 -->
		<script src="<?php echo base_url(); ?>assets/lib/select2/select2.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		
		<!-- mail functions -->
		<script src="<?php echo base_url(); ?>assets/js/apps/tisa_mail.js"></script>

		<script type="text/javascript" charset="utf-8">
		function js_yyyy_mm_dd() {
  			now = new Date();
  			year = "" + now.getFullYear();
  			month = "" + (now.getMonth() + 1); if (month.length == 1) { month = "0" + month; }
  			day = "" + now.getDate(); if (day.length == 1) { day = "0" + day; }
  			hour = "" + now.getHours(); if (hour.length == 1) { hour = "0" + hour; }
  			minute = "" + now.getMinutes(); if (minute.length == 1) { minute = "0" + minute; }
  			second = "" + now.getSeconds(); if (second.length == 1) { second = "0" + second; }
  			return year + "-" + month + "-" + day;
		}
		 $(document).ready(function() {
             $(function(){
                  tisa_wysiwg.message();
                  tisa_datepicker.init();
				  tisa_timepicker.init();
				  document.getElementById('tgl_input').value = js_yyyy_mm_dd();
              });

             tisa_wysiwg = {
	     	message: function() {
	     		if ($('#desc_tugas').length) {
	     			CKEDITOR.replace( 'desc_tugas', {
	     				toolbarGroups: [
	     					{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
	     					{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
	     					{ name: 'forms' },
	     					{ name: 'links' },
	     					{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
	     					'/',
	     					{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	     					{ name: 'styles' },
	     					{ name: 'insert' },
	     					{ name: 'colors' },
	     					{ name: 'tools' },
	     					{ name: 'others' },
	     				]
	     			});
	     		}
	     	}
	     }

	  tisa_timepicker = {
		init: function() {
			if($('#tp-default').length) {
				$('#tp-default').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: false
				})
			}
			if($('#tp-24h').length) {
				$('#tp-24h').timepicker({
					minuteStep: 1,
					template: 'modal',
					showSeconds: true,
					showMeridian: false
				})
			}
			if($('#tp-modal').length) {
				$('#tp-modal').timepicker({
					minuteStep: 1,
					secondStep: 5,
					showInputs: false,
					modalBackdrop: true,
					showSeconds: true,
					showMeridian: false
				})
			}
		}
	}

		tisa_datepicker = {
		init: function() {
			if($('.ts_datepicker').length) {
				$('.ts_datepicker').datepicker({
					todayHighlight: true
				})
			}
			if( ($('#dpStart').length) && ($('#dpEnd').length) ) {
				$('#dpStart').datepicker({
					todayHighlight: true
				}).on('changeDate', function(e){
					$('#dpEnd').datepicker('setStartDate', e.date);
				});
				$('#dpEnd').datepicker({
					todayHighlight: true
				}).on('changeDate', function(e){
					$('#dpStart').datepicker('setEndDate', e.date)
				});
			}
		}
	}
            

              } );

		
			// wysiwg editor
	     
	     </script>