<li class="">
	<div class="imgSmall floatLeft">
		<img src="http://company-site.s3.amazonaws.com/site-assets/images/profile1-40.gif">
	</div>
</li>
<li class="dropdown" id="userMenu">
	<a class="dropdown-toggle floatRight" data-toggle="dropdown" href="#usermenu">
		<?php echo $user->displayname?>
		<b class="caret"></b>
	</a>
	<ul class="dropdown-menu">
		<li><a href="#">View Profile</a></li>

		<li><a href="#">Something else here</a></li>
		<li class="divider"></li>
		<li><a href="/logout">Logout</a></li>
	</ul>
</li>