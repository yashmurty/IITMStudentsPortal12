
<div class="span3 offset2">
	<div class="widget" style="float:right;width:400px; margin:10px;">
		<div class="widget-header">
			<ul class="nav nav-pills">
				<li>
					<i class="icon-star"></i>
					<h3><?php if($nick!="") echo $nick."'s"; ?></h3>
				</li>
				<li class="" id="profile_sec_page"><a href="javascript:update('apps/home/secretary/updateprofile_sec.php', 'inner_body_sec'); ">Profile</a></li>
				<li id="teams_sec_page"><a href="javascript:update('apps/home/secretary/updateteams_sec.php', 'inner_body_sec');">Teams</a></li>
				<li id="contacts_sec_page"><a href="javascript:update('apps/home/secretary/updatecontact_sec.php', 'inner_body_sec');">Contact</a></li>
			</ul>
		</div> <!-- /widget-header -->

		<div class="widget-content" id="inner_body_sec">
			<?php include("secretary/updateprofile_sec.php"); ?>
		</div> <!-- /widget-content -->
						
	</div> <!-- /widget -->	
</div>


