<!-- Modal -->
			<div class="modal fade" id="modal_dispatch">
				<div class="modal-dialog">
					<div class="modal-content">
					      <div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        				<h3 class="modal-title">Action Tugas</h3>
      						</div>
						<div class="modal-body">
						<div class="form-group">
						<label for="action">Action</label>
							<select id="action" class="form-control">
							 <option value="KO: FORWARD">Forward To SPV</option>
							 <option value="KO: APPROVED">Approved</option>
							 <option value="KO: REVISION">Revisi</option>
							</select>
						</div>	
							<div class="form-group">
													<label for="comment_koor">Comment</label>
													<textarea name="comment" id="comment_koor" cols="10" rows="3" class="form-control"></textarea>
												</div>
						</div>
						<div class="modal-footer">
            					<button type="button" id="btnSave" onclick="dispatch()" class="btn btn-primary">Save</button>
            					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          				</div>
					</div>
				</div>
			</div>			
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
									<h3 class="heading_a">From</h3>
									<address>
										<p class="addres_name"><?php echo $row->nama_staff ?></p>
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
									<h3>Comment Staff :</h3>
									<blockquote style="font-size:-1px;font-size:inherit;margin-left:15px;border-left:5px solid #2D2D2D;"><?php $detail = explode("::", $row->comment_staff); echo $detail[0]; ?></blockquote>
								<div class="well well-sm">
								<h4>Attachment Tugas :</h4>
								<span class="fa fa-lg fa-paperclip"></span>
								<a href="<?php echo base_url()?>index.php/koor/down_attach/<?php echo $detail[1]?>"><?php echo $detail[1] ?> </a>
								</div>
							</div>
						</div>
						<div class="row">
								<div class="col-md-7 text-right"> 
								    <button type="submit" class="btn btn-danger btn-md" data-toggle="modal" data-target="#modal_dispatch"><span class="fa fa fa-share"></span>ACTION</button>	
								</div>
							</div>
					</div>
				</div>
			</div>
		
		</div>
		<?php } echo $this->load->view('main/footer'); ?>
		<script type="text/javascript">
		function dispatch(){
			var id_tugas = $('#id_tugas').val();
			var status   = $('#status').val();
			var comment  = $('#comment_koor').val();

		$.ajax({
            url : "<?php echo site_url('koor/action_tugas')?>/",
            type: "POST",
            data: {id: id_tugas, status: status, comment: comment},
            success: function(data)
            {
               $('#modal_dispatch').modal('hide');
               window.location = "<?php echo site_url('koor/inbox_submit')?>";
          
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error Dalam Dispatch !!');
            }
        });

		}
		</script>
