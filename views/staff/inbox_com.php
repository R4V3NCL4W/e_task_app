		<link rel="stylesheet" href="<?php echo base_url()?><?php echo base_url()?>assets/lib/footable/css/footable.core.min.css">
	
		<!-- main content -->
		<div id="main_wrapper">
		
			<div class="page_bar clearfix">
				<div class="row">
					<div class="col-sm-8">
						<h1 class="page_title">Inbox</h1>
						<p class="text-muted">24 new emails</p>
					</div>
				</div>
			</div>
			<nav class="breadcrumbs">
				<ul>
					<li><a href="#">Mail</a></li>
					<li class="sep">\</li>
					<li>Inbox</li>
				</ul>
			</nav>
			<div class="page_content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default" style="background-color: #D8D8D8;">
								<div >
									<div class="row">
										<div class="col-lg-4 text-right col-lg-push-8">
											<input type="text" id="mailbox_search" class="form-control input-sm" placeholder="Find message">
										</div>
									</div>
								</div>
								<table id="mail_inbox" class="mail_table table table-hover toggle-arrow-tiny" data-filter="#mailbox_search" data-page-size="20">
									<thead>
										<tr>

											<th data-hide="phone,tablet">From</th>
											<th>Tugas</th>
											<th data-hide="phone,tablet">Tgl Create</th>
											<th data-hide="phone">Deadline</th>
											<th data-hide="phone">Nilai</th>
											<th data-hide="phone,tablet"><i class="fa fa-lg fa-paperclip"></i></th>
										</tr>
									</thead>
									<tbody data-link="row" class="rowlink">
									<?php foreach ($inbox as $row) {
										if($row->status_now == "KO: DISPATCHED"){?>
										<tr class="unreaded">
									<?php } else {?>
									<tr > <?php } ?>
											<td><?php echo $row->nama_koor ?></td>
											<td><a href="<?php echo base_url()?>index.php/staff/view_inbox_com/<?php echo $row->id?>">
												<?php  echo $row->tugas; ?></a></td>
											<td><?php $time = strtotime($row->tgl_input);
													 $f_time = date("j M", $time);
													 echo $f_time?></td>
											<td><?php $d_time = strtotime($row->deadline);
													 $fd_time = date("j M", $time);
													 echo $fd_time?></td>
											<td><?php echo $row->nilai ?></td>													 
											<td class="col_sm"><?php if($row->file != ' '){?><span class="fa fa-lg fa-paperclip"></span><?php } ?></td>
										</tr>
									<?php } ?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="7">
												<div class="row">
													<div class="col-md-4">
														<span class="mailbox_count_msg"><b class="page_start_row">1</b>-<b class="page_end_row">20</b> of <b class="all_rows">85</b></span>
													</div>
													<div class="col-md-8 text-right hide-if-no-paging">
														<ul class="pagination pagination-sm"></ul>
													</div>
												</div>
											</td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>

						<!-- <div class="col-lg-3">
							<div id="mini-clndr">
								<script>
									// todo calendar events 
									var currentMonth = moment().format('YYYY-MM'),
										nextMonth    = moment().add('month', 1).format('YYYY-MM');
									
									todo_events = [
										{ date: currentMonth + '-' + '07', title: 'Voluptatum autem sit aut.', url: 'javascript:void(0)' },
										{ date: currentMonth + '-' + '08', title: 'Est eum occaecati ratione.', url: 'javascript:void(0)' },
										{ date: currentMonth + '-' + '08', title: 'Dolorum harum perspiciatis maxime.', url: 'javascript:void(0)' },
										{ date: currentMonth + '-' + '12', title: 'Et rerum cumque optio dolor.', url: 'javascript:void(0)' },
										{ date: currentMonth + '-' + '19', title: 'Modi nisi.', url: 'javascript:void(0)' },
										{ date: currentMonth + '-' + '19', title: 'Magni vero quis ab.', url: 'javascript:void(0)' },
										{ date: currentMonth + '-' + '22', title: 'Hic nostrum aperiam.', url: 'javascript:void(0)' },
										{ date: currentMonth + '-' + '25', title: 'Quis nam asperiores deserunt.', url: 'javascript:void(0)' },
										{ date: currentMonth + '-' + '25', title: 'Accusamus natus laboriosam non.', url: 'javascript:void(0)' },
										{ date: currentMonth + '-' + '25', title: 'Est modi quibusdam sit.', url: 'javascript:void(0)' },
										{ date: currentMonth + '-' + '28', title: 'Ex aperiam cumque corrupti.', url: 'javascript:void(0)' },
										{ date: currentMonth + '-' + '28', title: 'Eligendi nihil quia voluptas.', url: 'javascript:void(0)' },
										{ date: nextMonth + '-' + '04',    title: 'Neque iusto.', url: 'javascript:void(0)' },
										{ date: nextMonth + '-' + '18',    title: 'Voluptatem aut omnis.', url: 'javascript:void(0)' }
									]
								</script>
								<script id="mini-clndr-template" type="text/template">
									<div class="controls">
										<div class="clndr-previous-button"><span class="glyphicon glyphicon-chevron-left"></span></div><div class="month"><%= month+' '+year %></div><div class="clndr-next-button"><span class="glyphicon glyphicon-chevron-right"></span></div>
									</div>
						
									<div class="days-container">
										<div class="days">
											<div class="headers">
												<% _.each(daysOfTheWeek, function(day) { %><div class="day-header"><%= day %></div><% }); %>
											</div>
											<% _.each(days, function(day) { %><div class="<%= day.classes %>" id="<%= day.id %>"><%= day.day %></div><% }); %>
										</div>
										<div class="events">
											<div class="headers">
												<div class="x-button"><span class="glyphicon glyphicon-remove"></span></div>
												<div class="event-header">EVENTS</div>
											</div>
											<div class="events-list-wrapper">
												<div class="events-list">
													<% _.each(eventsThisMonth, function(event) { %>
														<div class="event">
															<a href="<%= event.url %>"><%= moment(event.date).format('MMM Do') %>: <%= event.title %></a>
														</div>
													  <% }); %>
												</div>
											</div>
										</div>
									</div>
								</script>
							</div>
						</div>
					</div> -->
				</div>
			</div>		
		</div>

		<?php echo $this->load->view('main/footer'); ?> 
		<!-- rowlink -->
		<script src="<?php echo base_url()?>assets/lib/jasny/rowlink.js"></script>
		<!-- responsive table -->
		<script src="<?php echo base_url()?>assets/lib/footable/js/footable.js"></script>
		<script src="<?php echo base_url()?>assets/lib/footable/js/footable.filter.js"></script>
		<script src="<?php echo base_url()?>assets/lib/footable/js/footable.paginate.js"></script>
		<!-- clndr -->
		<script src="<?php echo base_url()?>assets/lib/underscore-js/underscore-min.js"></script>
		<script src="<?php echo base_url()?>assets/lib/CLNDR/src/clndr.js"></script>
		<!-- mail functions -->
		<script src="<?php echo base_url()?>assets/js/apps/tisa_mail.js"></script>
		
    </body>
</html>
