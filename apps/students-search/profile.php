<?php 
	if( $secretary == 1 )
		include( "secretary_page.php" );
	else {
?>
<div class="span3 offset1">
<center>
				<div class="widget"  style="float:right;width:400px; margin:10px;">
					<div class="widget-header">
						<i class="icon-star"></i>
						<h3><?php if($nick!="") echo $nick."'s"; ?>Profile</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
	          			<table>
							<tr>
								<td style="width:100px;"><a href="#">Name</a></td>
								<td><?php echo $name; ?></td>
							</tr><tr>
								<td style="width:100px;"><a href="#">Nickname</a></td>
								<td><?php echo $nick; ?></td>
							</tr><tr>
								<td style="width:100px;"><a href="#">Roll Number</a></td>
								<td><?php echo $uname; ?></td>
							</tr><tr>
								<td style="width:100px;"><a href="#">Room No.</a></td>
								<td><?php echo $room; ?></td>
							</tr><tr>
								<td style="width:100px;"><a href="#">Hostel.</a></td>
								<td><?php echo $hostel; ?></td>
							</tr><tr>
								<td style="width:100px;"><a href="#">Contact No.</a></td>
								<td><?php if($contact!=0) echo $contact; ?></td>
							</tr><tr>
								<td style="width:100px;"><a href="#">E-Mail ID</a></td>
								<td><?php echo $email; ?></td>
							</tr>
						</table>
				</div> <!-- /widget-content -->
						
				</div> <!-- /widget -->	
</center>
</div>

<?php
	} // end of if-else to check for secretary
?>
