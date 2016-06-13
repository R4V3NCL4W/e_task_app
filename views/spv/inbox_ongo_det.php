
<link href="<?php echo base_url(); ?>assets/lib/fancybox/source/jquery.fancybox.css" rel="stylesheet">
<!-- main content -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lib/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lib/bootstrap-datepicker/css/datepicker3.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lib/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
		<div id="main_wrapper">
			<div class="page_bar clearfix">
			  


				<div class="row">
			<?php foreach ($tugas as $row) { ?>
					<div class="col-md-8">
						<h1 class="page_title"><?php echo $row->tugas ?></h1>
						<p class="text-muted">Date: <?php $time = strtotime($row->tgl_input);
												  $f_time = date("j M Y", $time);
												  echo $f_time?>  ;
										    Due By: <?php $time = strtotime($row->deadline);
												  $f_time = date("j M Y h:i:s", $time);
												  echo $f_time?> </p>
					</div>
				</div>

			<div class="row">
			    <div class="col-sm-12 text-left"> 
			    	<a href="<?php echo base_url();?>index.php/spv/inbox_tugas_ongo"><span class="fa fa-lg fa fa-arrow-left"></span> Back To Inbox </a>
			    </div>
			   </div> 
			</div>
			<div class="page_content">
				<div class="container-fluid">
					<div class="panel panel-default" style="background-color:#DFE1E3;">
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-6">
									<h3 class="heading_a">From</h3>
									<address>
										<p class="addres_name"><?php echo $row->nama_spv ?></p>
										<p><?php  $time = strtotime($row->tgl_input);
												  $f_time = date("l, j M Y", $time);
												  echo $f_time?></p>
										<p>STATUS:</p>
										<small><?php echo $row->status_now ?></small>
									</address>
									<input type="hidden" id="id_tugas" value="<?php echo $row->id;?>">
								</div>
								<div class="col-sm-6">
								<h3 class="heading_a">Nama Tugas :</h3>
									<address>
										<p class="addres_name"><?php echo $row->tugas ?></p>
									</address>
								</div>
							</div>
							<hr style="border-top:1px solid #2D2D2D;">
							<div class="row">
								<div class="col-md-12">
									<h3>Rincian Tugas :</h3>
									<blockquote style="font-size:-1px;font-size:inherit;margin-left:15px;border-left:5px solid #2D2D2D;"><?php echo $row->rincian ?></blockquote>
								<div class="well well-sm">
								<h4>Attachment Tugas :</h4>
								<span class="fa fa-lg fa-paperclip"></span>
								<a href="<?php echo base_url()?>index.php/koor/down_attach/<?php echo $row->file?>"><?php echo $row->file ?> </a>
								</div>
							</div>
						</div>				
					</div>
				</div>
			</div>
		
		</div>
		<?php } echo $this->load->view('main/footer'); ?>
		<script src="<?php echo base_url(); ?>assets/lib/ckeditor/ckeditor.js"></script>
		<script src="<?php echo base_url(); ?>assets/lib/ckeditor/adapters/jquery.js"></script>
		<!-- select2 -->
		<script src="<?php echo base_url(); ?>assets/lib/select2/select2.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		 <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/lib/fancybox/source/jquery.fancybox.js"></script>

		
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
		
		function dispatch(){
			var id_project = $('#id_tugas').val();
			var staff = $('#staff').val();

		$.ajax({
            url : "<?php echo site_url('koor/dispatch_tugas')?>/",
            type: "POST",
            data: {id: id_project, staff: staff},
            success: function(data)
            {
               $('#modal_dispatch').modal('hide');
               window.location = "<?php echo site_url('koor/inbox_tugas')?>";
          
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error Dalam Dispatch !!');
            }
        });
		}
		$(document).ready(function() {
			          $(".manage_deadline").fancybox({
            maxWidth    : 500,
            maxHeight    : 500,
            fitToView    : true,
            width        : '70%',
            autoSize    : false,
            closeClick    : false,
            openEffect    : 'none',
            closeEffect    : 'none'

         });


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
		</script>
