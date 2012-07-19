<?php if($logged_in):?>
<div class = "navbar clientBranding clearfix">
	<img class="clientLogo" src="http://corporate.matchmovegames.com/wp-content/uploads/2012/01/logo1.png"/>
</div>
<?php endif;?>
<div class="navbar navbarMain clearfix">
	<div class="navbar-inner colorGradient mainNav">
		<div class="container-fluid">
			<a class="brand hidden-phone" href="/">Company</a>
			<a href="#modal" class="hidden-desktop sideNav floatLeft marginRight10 marginTop10"><i class="icon-th-large icon-white"></i></a>
			
			<?php echo !empty($notification) ? $notification : "";?>
			<ul class="nav visible-desktop">
				<li class="">
					<form class="form-search">
						<input type="text" class="input-medium search-query">
					</form>
				</li>
				<li class="">
					<a href="/profile/feeds"><i class="icon-white icon-tasks navIcon"></i>Feeds</a>
				</li>
				<li class="">
					<a href="/profile/feeds/<?php echo !empty($user->id) ? $user->id : ""?>"><i class="icon-white icon-info-sign navIcon"></i>Profile</a>
				</li>
				<li class="">
					<a href="/people"><i class="icon-white icon-user navIcon"></i>People</a>
				</li>
				<li class="">
					<a href="/group"><i class="icon-white icon-th navIcon"></i>Group</a>
				</li>
				<?php echo !empty($dropdown) ? $dropdown : "";?>
			</ul>
		</div>
	</div>
	<div id="modal">
		<!-- <p class="marginBottom10 clearfix marginLeft10"><a href="javascript:$.pageslide.close()" class="sideNav titleBar floatLeft marginRight10 marginTop10"><i class="icon-remove-sign"></i></a></p>
         -->
		<ul class="marginTop10 clearfix">
			<li class="clearfix">
				<form class="form-search">
					<input type="text" class="input-medium search-query">
				</form>
			</li>
			<li class="">
				<a href="feed.html"><i class="icon-white icon-tasks navIcon"></i>Feeds</a>
			</li>
			<li class="">
				<a href=""><i class="icon-white icon-info-sign navIcon"></i>Profile</a>
			</li>
			<li class="">
				<a href="people.html"><i class="icon-white icon-user navIcon"></i>People</a>
			</li>
			<li class="">
				<a href=""><i class="icon-white icon-th navIcon"></i>Group</a>
			</li>
			<li class="paddinTop10 clearfix paddingBottom10">
				<div class="imgSmall floatLeft marginRight10 marginTop10 marginBottom10">
					<img src="http://company-site.s3.amazonaws.com/site-assets/images/profile1-40.gif">
				</div>
				<a href="#">Sign Out</a>
			</li>
		</ul>
    </div>
</div>
