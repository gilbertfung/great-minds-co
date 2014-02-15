<?php
require 'view/header.php';

require 'security.php';
requireSSL();
?>
<div id="cover">
	<h2>Log in or Sign up</h2>
	<div id="forms">
		<form id="login" action="process.php?action=login" method="post">
			<h3>Log in:</h3>
			<fieldset>
				<!-- <label>Email</label> -->
				<input type="email" name="email" placeholder="Email Address" value="">
				<br>
				<!-- <label>Password</label> -->
				<input type="password" name="password" placeholder="Password" value="">
				<input class="button" type="submit" name="submit" value="Log in">
			</fieldset>
			<!-- <p><a href="index.php?action=register">New to Great Minds? Sign up.</a></p> -->
		</form>
		<form id="register" action="process.php?action=createAccount" method="post">
			<h3>Sign up to start sharing:</h3>
			<!--<fieldset>
				<legend>User Type</legend>
				<select id="userType" name="userType">
					<option value="">-Select User Type -</option>
					<option value="promoter" disabled>Promoter</option>
					<option value="ideaMaker">Idea-Maker</option>
				</select>
				<br>*Project Note: Ideally, Idea-Makers will be "upgraded" from Promoters, and this fieldset would not exist.
			</fieldset>-->
			<fieldset>
				<!-- <label>Name</label> -->
				<input type="text" name="name" placeholder="Name" value="">
				<br>
				<!-- <label>Email</label> -->
				<input type="email" name="email" placeholder="Email Address" value="">
				<br>
				<!-- <label>Password</label> -->
				<input type="password" name="password" placeholder="Password" value="">
				<br>
				<!-- <label>Confirm password</label> -->
				<input type="password" name="confirmPassword" placeholder="Confirm Password" value="">
			</fieldset><br>
			<fieldset>
				<!-- <label>Your location</strong> -->
				</label>
				<input type="text" name="location" placeholder="Location" value="">
				<br>
				<!-- <label>Your site</label> -->
				<input type="url" name="website" placeholder="http://yoursite.com" value="http://">
				<br>
				<!-- <label>A little bit about you:</label> -->
				<textarea name="bio" form="register" placeholder="A little bit about you..." rows="5"></textarea>
				<br>
				<label>Profile picture:</label>
				<input id="profile-image-input" type="file" name="profileImage" value="">
				<!-- <span id="profile-image"></span> -->
				<br>
				<!-- <label id="industryLabel">Current Industry / Field</label> -->
				<input type="text" name="industry" placeholder="Current Industry or Field" value="">
				<br>
				<!-- <label id="yearsLabel">Years of expertise</label> -->
				<input type="number" name="years" placeholder="Years of Expertise" value="">
				<br>
				<!-- <label>Contact Preference:</label> -->
				<select name="contactBy">
					<option name="contactBy" value="" disabled selected>Contact Preference:</option>
					<option name="contactBy" value="byEmail">Reach me by email.</option>
					<option name="contactBy" value="byUrl">Through my website</option>
				</select>
				<input class="button" type="submit" name="submit" value="Let's get started.">
			</fieldset>
			</div>
		</form>
	</div>
</div>
</section>
<?php
require 'view/footer.php';
?>
	