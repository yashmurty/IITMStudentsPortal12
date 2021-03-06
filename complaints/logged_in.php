<!-- Basic Navigation Bar -- always showing -->
    <!-- Navbar ================================================== -->
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"bJQueryUI" : true
  
				} );
				$('.tooltip-desc').tooltip({
					selector: "a[rel=tooltip]"
				})
			} );
			$(window).bind('resize', function () {
				oTable.fnAdjustColumnSizing();
			} );
		</script>
		<style>
			a:hover {
				color:#000000;
				text-decoration:underline;
			}
			a {
				color:#aaaaaa;
			}
		</style>
    <div class="navbar navbar-inverse navbar-fixed-top pull-left">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="index.php?q=home" >Online Complaints System</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="">
                <a href="index.php?q=view">View Complaints</a>
              </li>
            </ul>
			<ul class="nav pull-right">
			<!--  
			  <li class="">
				<form class="navbar-search" action="index.php" method="GET">
				  <input class="search-query " placeholder="Search ..." type="text">
				</form>
			  </li>
			-->
			  <li class="">
				<a href="#">
					Logged in as <strong><?php echo $uname ?></strong> 
					from <strong><?php echo $dept ?></strong>
				</a>
			  </li>
              <li class="">
                <a href="index.php?log=out">Log Out</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
	<div id="attention" class="container" width="60%" style="padding-top:50px;">
		
	</div>
	<div class="container" id="main_body"> 

<?php // figure out what user wants : view complaints, etc
	if( ! isset($loggedin_query) )
		$loggedin_query = "home";
		
	// NOTE : Currently Home is VIEW ... so, both have same IF
	// while changing later, need to change this !
	if( $loggedin_query == "view" || $loggedin_query == "home" ) {
		// debug: echo "GOING TO SHOW ALL COMPLAINTS"
		// Show current complaints with your dept
?>
	<!-- TODO : GET data-table ... + tooltop-->
	
		
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered display" id="example" width="80%">
	<thead>
		<tr>
			<th>ID</th>
			<th>Hostel</th>
			<th>Room</th>
			<th>Date Updated</th>
			<th>Status</th>
			<th>Subj</th>
		</tr>
	</thead>
	<tbody>
<?php
	$sql_tbl = "SELECT * FROM ocs_complaints WHERE complaint_cat = '$dept';";
	$tbl_res = mysql_query($sql_tbl) or die("ERROR from ocs_complaints : ".mysql_error());
	
	while($row = mysql_fetch_array($tbl_res)) {
		$sql_usr = "SELECT * FROM users WHERE id = '".$row['user_id']."';";
		$usr_res = mysql_query($sql_usr) or die("ERROR from user : ".mysql_error());
		$usr_row = mysql_fetch_array($usr_res); // got user info also !
?>
		
		<tr class="tooltip-desc" >
			<td><?php echo $row['id'] ?></td>
			<td><?php echo $usr_row['hostel'] ?></td>
			<td><?php echo $usr_row['room'] ?></td>
			<td><?php if( $row['status_update_datetime'] == 0 ) echo $row['regn_datetime']; else echo $row['status_update_datetime']; ?></td>
			<td width="20px" class="<?php echo $row['current_status'] ?>">
				<select width="20px" onChange="javascript:update('change_status.php?id=<?php echo $row['id'] ?>&stat='+this.options[this.selectedIndex].innerHTML, 'attention');">
					<option 
						<?php if($row['current_status'] == "PENDING") echo "selected='selected'"; ?>
						>
						PENDING
					</option><option 
						<?php if($row['current_status'] == "IN PROCESS") echo "selected='selected'"; ?>
						>
						IN PROCESS
					</option>
					<option 
						<?php if($row['current_status'] == "COMPLETED") echo "selected='selected'"; ?>
						>
						COMPLETED
					</option>
				</select>
			</td>
			<td>
				<a href="#modal_comp_<?php echo $row['id']; ?>" rel="tooltip" 
					data-placement="left" data-html="true" data-toggle="modal"
					title="Subject : <?php echo $row['complaint_sub']; ?> <br />
					Description : <?php echo $row['complaint_desc']; ?>" >
					<?php 
						if( strlen($row['complaint_sub']) > 50)
							echo substr($row['complaint_sub'], 0, 50)."..." ;
						else
							echo $row['complaint_sub']; 
					?>
				</a>		
			</td>		
		</tr>
		<!-- Modal -->
		<div style="color:#ffffff;" id="modal_comp_<?php echo $row['id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button style="color:#ffffff;" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel"><?php echo $row['current_status']; ?> complaint. ID : <?php echo $row['id'] ?></h3>
			</div>
			<div class="modal-body">
				<p>Status : 
					<?php if($row['current_status'] == "Completed") { ?>
						<span class="label label-success"> <?php echo $row['current_status']; ?> </span>
					<?php } else { ?>
						<span class="label label-important"> <?php echo $row['current_status']; ?> </span>
					<?php } ?>
				</p>
				<p><strong>Name</strong> : <?php echo $usr_row['fullname']; ?></p>
				<p><strong>Roll</strong> : <?php echo $usr_row['username']; ?></p>
				<p><strong>Room</strong> : <?php echo $usr_row['room']; ?></p>
				<p><strong>Hostel</strong> : <?php echo $usr_row['hostel']; ?></p>
				<p><strong>Contact</strong> : <?php echo $row['user_contact']; ?></p>
				<p><strong>Email</strong> : <?php echo $row['user_email']; ?></p>
				<p><strong>Ticket Created on</strong> : <?php echo $row['regn_datetime']; ?></p>
				<p><strong>Last Updated on</strong> : <?php if($row['status_update_datetime'] == 0 ) echo "Never"; else echo $row['status_update_datetime']; ?></p>
				<p><br /></p>
				<p><strong>Subject</strong> : <?php echo $row['complaint_sub']; ?></p>
				<p><strong>Description</strong> : <?php echo $row['complaint_desc']; ?></p>
			</div>
			<div class="modal-footer">
				<a class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
			</div>
		</div>
<?php
	}
?>
	</tbody>
</table>
	
	
	
<?php
	}
?>
</div>
