<?php require_once 'includes/session.php'; ?>
<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'includes/functions.php'; ?>
<?php requireSSL(true);

if (isset($_POST['submit'])) {
	// passwords match process register
	update_profile($_POST);
	$_SESSION['message'] = "Profile updated.";
} else {
}
$user = find_user_by_id($_SESSION['user_id']);
?>

<?php require 'includes/layouts/header.php'; ?>
<div id="cover">
	<h2>Settings</h2>
	<form id="profile" name="profile" action="settings.php" method="post">
		<h3>Edit your profile</h3>
		<!-- <fieldset>
			<input type="text" name="name" placeholder="Name" required><br>
			<input type="email" name="email" placeholder="Email Address" required><br>
			<input type="password" name="password" placeholder="Password" required><br>
			<input type="password" name="confirmPassword" placeholder="Confirm Password" required>
		</fieldset><br> -->
		<fieldset>
			<input type="text" name="location" placeholder="Location" value="<?php echo $user['location']; ?>"><br>
			<input type="url" name="website" placeholder="http://yoursite.com" value="<?php echo $user['website']; ?>"><br>
			<textarea name="bio" placeholder="A little bit about you..." rows="5"><?php echo $user['bio']; ?></textarea><br>
			<label>Profile picture:</label>
			<input id="profile-image-input" type="file" name="profileImage"><br>
			<input type="text" name="industry" placeholder="Current Industry or Field" value="<?php echo $user['industry']; ?>"><br>
			<input type="number" name="ind_years" placeholder="Years of Expertise" value="<?php echo $user['ind_years']; ?>"><br>
			<!-- <select name="contact_pref">
				<option name="contact_pref" value="" disabled selected>Contact Preference:</option>
				<option name="contact_pref" value="byEmail">Reach me by email.</option>
				<option name="contact_pref" value="byUrl">Through my website</option>
			</select><br> -->
			<!--<?php echo '<input type="checkbox" name="ideamaker" value="ideamaker" checked="'.$_SESSION['ideamaker'].'">I am an Ideamaker.'; ?> --><!--TODO advanced user "upgrading"-->
			<input class="button" type="submit" name="submit" value="Update">
		</fieldset>
	</form>
</div>
</section>
<?php require 'includes/layouts/footer.php'; ?>