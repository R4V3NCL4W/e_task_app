<!-- main content -->
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
			    	<a href="<?php echo base_url();?>index.php/koor/inbox_tugas"><span class="fa fa-lg fa fa-arrow-left"></span> Back To Inbox </a>
			    </div>
			   </div>
			</div>
			<div class="page_content">
				<div class="container-fluid">
					<div class="panel panel-default" style="background-color:#DFE1E3;">
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-6">
								<div class="col-sm-3">
									<h3 class="heading_a">SPV :</h3>
									<address>
										<p class="addres_name"><?php echo $row->nama_spv ?></p>
									</address>		
									<address>
										<p><?php  $time = strtotime($row->tgl_input);
												  $f_time = date("l, j M Y", $time);
												  echo $f_time?></p>
										<p>STATUS:</p>
										<small><?php echo $row->status_now ?></small>
									</address>	
									<input type="hidden" id="id_tugas" value="<?php echo $row->id;?>">
									</div>
									<div class="col-sm-3">
									<h3 class="heading_a">KOOR :</h3>
									<address>
										<p class="addres_name"><?php echo $row->nama_koor ?></p>
									</address>		
									</div>

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
								</div><?php if ($row->status_now == 'ST: REVISION' or $row->status_now == 'KO: REVISION') {?>
									<h5>Comment KOOR</h5>
									<blockquote style="font-size:-1px;font-size:inherit;margin-left:15px;border-left:5px solid #2D2D2D;"><?php echo $row->comment_koor ?></blockquote>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		</div>
		<?php } echo $this->load->view('main/footer'); ?>
		<script src="<?php echo base_url(); ?>assets/lib/ckeditor/ckeditor.js"></script>
		<script src="<?php echo base_url(); ?>assets/lib/ckeditor/adapters/jquery.js"></script>
     	 <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/lib/fancybox/source/jquery.fancybox.js"></script>

		<script type="text/javascript">
		$(document).ready(function() {

          $(".submit_tugas").fancybox({
            maxWidth    : 500,
            maxHeight    : 500,
            fitToView    : true,
            width        : '70%',
            autoSize    : false,
            closeClick    : false,
            openEffect    : 'none',
            closeEffect    : 'none'

         });

	 });

		</script>
