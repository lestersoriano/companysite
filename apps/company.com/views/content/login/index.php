<div class="row-fluid titleBar">
	<h1 class="marginTop10">Login</h1>
	<hr/>
	<div class="span6">

		<form class="mainSignUp" action="/login" method="post">
			<div class="clearfix">
				
				
			<div class="control-group error">
				<div class="controls">
					<input type="text" name="email" placeholder="Email or Username">
					<span class="help-inline"><?php echo !empty($message) ? $message : ""?></span>
				</div>
			</div>
				
				
				
				<input type="password" name="password"  placeholder="password">
			</div>
			<div class="clearfix">
				<input type="submit" value="Log In" class="btn">
			</div>
			<hr/>
		</form>
	</div>
	<div class="span6 hidden-phone additionalInfo">
		<div class="row-fluid">
			<h3>Learn More</h3>
			<p>Some lorem ipsum text which is random info you can use</p>
			<a href="#">Learn More</a>
		</div>
		<div class="row-fluid borderTop ">
			<h3>Learn More</h3>
			<p>Some lorem ipsum text which is random info you can use</p>
			<a href="#">Learn More</a>
		</div>
	</div>
</div>