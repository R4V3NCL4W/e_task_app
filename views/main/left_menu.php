<!-- side navigation -->
		<nav id="side_nav">
			<ul>
				<li>
					<a href="<?php echo base_url() ?>index.php/spv/index"><span class="ion-speedometer"></span> <span class="nav_title">Dashboard</span></a>
				</li>
			 <?php if ($menu=="spv"){?>
				<li>
					<a href="#">
						<span class="label label-danger"><?php foreach ($jumlah_notif as $row) {echo $row->jumlah;}?></span>
						<span class="ion-clipboard"></span>
						<span class="nav_title">Tugas</span>
					</a>
					<div class="sub_panel">
						<div class="side_inner">
							<h4 class="panel_heading panel_heading_first">TASK</h4>
							<ul>
								<li><a href="<?php echo base_url() ?>index.php/spv/inbox_tugas_ongo" onclick="addTab('Tambah Tugas','<?php echo base_url() ?>index.php/spv/add_tugas')">
								<span class="side_icon ion-android-timer"></span>
								<span class="badge badge-danger">
								<?php foreach ($jumlah_notif as $row) {echo $row->jumlah_tot;}?></span> On Going </a></li>
								<li><a href="<?php echo base_url() ?>index.php/spv/inbox_tugas_manage">
								<span class="side_icon ion-social-buffer-outline"></span>
								<span class="badge badge-danger">
								<?php foreach ($jumlah_notif as $row) {echo $row->jumlah_d;}?></span>Manage deadline</a></li>
								<li><a href="<?php echo base_url() ?>index.php/spv/inbox_tugas">
								<span class="side_icon ion-ios7-copy-outline"></span> 
								<span class="badge badge-danger">
								<?php foreach ($jumlah_notif as $row) {echo $row->jumlah;}?></span> Inbox </a></li>
								<li><a href="<?php echo base_url() ?>index.php/spv/inbox_tugas_complete">
								<span class="side_icon ion-social-buffer-outline"></span>
								<span class="badge badge-danger">
								<?php foreach ($jumlah_notif as $row) {echo $row->jumlah_c;}?></span> Complete</a></li>
							</ul>
							
							<div class="panel_section">
								<a href="<?php echo base_url() ?>index.php/spv/add_tugas"><button class="btn btn-primary">Tambahkan Tugas</button></a>
							</div>
						</div>
					</div>
				</li>

			<?php } else if ($menu == "koor") { ?>
				 <li>
					<a href="#">
						<span class="label label-danger">
							<?php foreach ($jumlah_notif as $row) {echo $row->jumlah_tot;}?>
						</span>
						<span class="ion-clipboard"></span>
						<span class="nav_title">Tugas</span>
					</a>
					<div class="sub_panel">
						<div class="side_inner">
							<ul>
								<li><a href="<?php echo base_url() ?>index.php/koor/inbox_dispatch">
									<span class="side_icon ion-social-buffer-outline">
									<span class="badge badge-danger"><?php foreach ($jumlah_notif as $row) {echo $row->jumlah_d;}?></span> Dispatch Task</a>
								</li>								
							</ul>
							<h4 class="panel_heading">TODAY TASK</h4>
							<ul>
								<li><a href="<?php echo base_url() ?>index.php/koor/inbox_dispatched">
									 <span class="side_icon ion-android-timer"></span>
									 <span class="badge badge-danger"><?php foreach ($jumlah_notif as $row) {echo $row->jumlah_dis;}?></span>Dispatched</a>
							    </li>

							    <li><a href="<?php echo base_url() ?>index.php/koor/inbox_completed">
									 <span class="side_icon ion-android-timer"></span>
									 <span class="badge badge-danger"><?php foreach ($jumlah_notif as $row) {echo $row->jumlah_c;}?></span>Completed</a>
							    </li>

							    <li><a href="<?php echo base_url() ?>index.php/koor/inbox_tugas">
									 <span class="side_icon ion-android-timer"></span>
									 <span class="badge badge-danger"><?php foreach ($jumlah_notif as $row) {echo $row->jumlah;}?></span>Submitted</a>
							    </li>

							    <li><a href="<?php echo base_url() ?>index.php/koor/inbox_tugasr">
									 <span class="side_icon ion-android-timer"></span>
									 <span class="badge badge-danger"><?php foreach ($jumlah_notif as $row) {echo $row->jumlah_rev;}?></span>Revisi</a>
							    </li>

							</ul>
						</div>
					</div>
				</li>

			<?php } else if ($menu == "staff") { ?>
				 <li>
					<a href="#">
						<span class="label label-danger"><?php foreach ($jumlah_not as $row) {echo $row->jumlah_tot;}?></span>
						<span class="ion-clipboard"></span>
						<span class="nav_title">Tugas</span>
					</a>
					<div class="sub_panel">
						<div class="side_inner">
							<ul>
								<li><a href=""><span class="side_icon ion-social-buffer-outline"></span> Inbox Tugas</a></li>
								<li><a href="<?php echo base_url() ?>index.php/staff/i_newTask"><span class="side_icon ion-android-timer"></span><span class="badge badge-danger"><?php foreach ($jumlah_not as $row) {echo $row->jumlah_dis;}?></span>Inbox</a></li>
								
							</ul>
							<h4 class="panel_heading">TODAY TASK</h4>
							<ul>

							    <li><a href="<?php echo base_url() ?>index.php/staff/inbox_completed">
									 <span class="side_icon ion-android-timer"></span>
									 <span class="badge badge-danger"><?php foreach ($jumlah_not as $row) {echo $row->jumlah_c;}?></span>Completed</a>
							    </li>

							    <li><a href="<?php echo base_url() ?>index.php/staff/inbox_ongo">
									 <span class="side_icon ion-android-timer"></span>
									 <span class="badge badge-danger"><?php foreach ($jumlah_not as $row) {echo $row->jumlah;}?></span>On Going</a>
							    </li>

							    <li><a href="<?php echo base_url() ?>index.php/staff/inbox_revisi">
									 <span class="side_icon ion-android-timer"></span>
									 <span class="badge badge-danger"><?php foreach ($jumlah_not as $row) {echo $row->jumlah_rev;}?></span>Revisi</a>
							    </li>

							</ul>
						</div>
					</div>
				</li>

			<?php } else { }?>


			</ul>
		</nav>