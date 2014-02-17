<?php require_once 'includes/session.php'; ?>
<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'includes/functions.php'; ?>
<?php requireSSL(true);

if (isset($_POST['login-submit'])) {
	// process login (required fields already indicated in html form)
	$email = $_POST['email'];
	$password = $_POST['password'];

	// try to login
	$login = login($email, $password);

	if ($login) {
		// success, make rest of session logged in
		$_SESSION['user_id'] = $login['user_id'];
		$_SESSION['email'] = $login['email'];
		$_SESSION['loggedin'] = true;
		if (is_ideamaker($login['user_id'])) {
			$_SESSION['ideamaker'] = true;
		} else {
			$_SESSION['ideamaker'] = false;
		}
		$_SESSION['message'] = 'Hey, welcome to Great Minds!';
		redirect_to("index.php?action=loggedin");
	} else {
		// failure, throw error
		$_SESSION['message'] = 'Email / password combination was not found. Please try again.';
	}
} else if (isset($_POST['register-submit'])) {
	if ($_POST['password'] === $_POST['confirmPassword']) {
		// passwords match, check if duplicate
		if (find_user_by_email($_POST['email'])) { // could work with user_id as well, but this is more logical and practical
			// there is a duplicate user
			$_SESSION['message'] = 'There is an account with that email already.';
		} else {
			// process register, try to login in with registered info and show a completion message
			register($_POST);
			//make_ideamaker($_POST);
			$login = login($_POST['email'], $_POST['password']);

			if ($login) {
				// success, make rest of session logged in
				$_SESSION['user_id'] = $login['user_id'];
				$_SESSION['email'] = $login['email'];
				$_SESSION['loggedin'] = true;
				
				if (is_ideamaker($login['user_id'])) {
					$_SESSION['ideamaker'] = true;
				} else {
					$_SESSION['ideamaker'] = false;
				}

				$_SESSION['message'] = 'Thanks for registering! We hope you enjoy being a part of this community.';
				redirect_to("index.php?action=accountCreated");
			} else {
				// failure, throw error
				$_SESSION['message'] = 'That\'s weird. Your email / password changed while submitting.';
			}
		}
	} else {
		// passwords don't match.
		$_SESSION['message'] = 'Your passwords don\'t match. Please try again.';
	}
} else {

}
?>
<?php require 'includes/layouts/header.php'; ?>
<div id="cover">
	<h2>Log in or Sign up</h2>
	<div id="forms">
		<form id="login" name="login" action="login.php" method="post">
			<h3>Log in:</h3>
			<fieldset>
				<!-- <label>Email</label> -->
				<input type="email" name="email" placeholder="Email Address" value="" required>
				<br>
				<!-- <label>Password</label> -->
				<input type="password" name="password" placeholder="Password" value="" required>
				<input class="button" type="submit" name="login-submit" value="Log in">
			</fieldset>
			<!-- <p><a href="index.php?action=register">New to Great Minds? Sign up.</a></p> -->
		</form>
		<form id="register" name="register" action="login.php" method="post">
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
				<input type="text" name="name" placeholder="Name" required>
				<br>
				<!-- <label>Email</label> -->
				<input type="email" name="email" placeholder="Email Address" required>
				<br>
				<!-- <label>Password</label> -->
				<input type="password" name="password" placeholder="Password" required>
				<br>
				<!-- <label>Confirm password</label> -->
				<input type="password" name="confirmPassword" placeholder="Confirm Password" required>
			</fieldset><br>
			<fieldset>
				<!-- <label>Your location</strong> -->
				</label>
				<input type="text" name="location" placeholder="Location">
				<br>
				<!-- <label>Your site</label> -->
				<input type="url" name="website" placeholder="http://yoursite.com">
				<br>
				<!-- <label>A little bit about you:</label> -->
				<textarea name="bio" placeholder="A little bit about you..." rows="5"></textarea>
				<br>
				<label>Profile picture:</label>
				<input id="profile-image-input" type="file" name="profileImage">
				<!-- <span id="profile-image"></span> -->
				<br>
				<!-- <label id="industryLabel">Current Industry / Field</label> -->
				<input type="text" name="industry" placeholder="Current Industry or Field">
				<br>
				<!-- <label id="yearsLabel">Years of expertise</label> -->
				<input type="number" name="ind_years" placeholder="Years of Expertise">
				<br>
				<!-- <label>Contact Preference:</label> -->
				<select name="contact_pref">
					<option name="contact_pref" value="" disabled selected>Contact Preference:</option>
					<option name="contact_pref" value="byEmail">Reach me by email.</option>
					<option name="contact_pref" value="byUrl">Through my website</option>
				</select>
				<br>
				<input type="checkbox" name="ideamaker" value="ideamaker">I am an Ideamaker. <!--TODO advanced user "upgrading"-->
				<input class="button" type="submit" name="register-submit" value="Let's get started.">
			</fieldset>
		</form>
	</div>
</div>
</section>
<?php require 'includes/layouts/footer.php'; ?>