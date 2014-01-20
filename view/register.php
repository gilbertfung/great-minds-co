<section class="content">
	<div id="hero">
		<h1>Wow, much register!</h1>
	</div>

	<section class="formArea">
		<form id="register" action="process.php?action=createAccount" method="post">
			<h3>Create your account</h3>
			
			<fieldset>
				<legend>User Type</legend>
				<select id="userType" name="userType">
					<option value="">-Select User Type -</option>
					<option value="promoter" disabled>Promoter</option>
					<option value="ideaMaker">Idea-Maker</option>
				</select>
				<br>*Project Note: Ideally, Idea-Makers will be "upgraded" from Promoters, and this fieldset would not exist.
			</fieldset>

			<label id="nameLabel">
				<strong>Name</strong>
				<input type="text" name="name" value="">
			</label>
			
			<label id="emailLabel">
				<strong>Email</strong>
				<input type="email" name="email" value="">
			</label>

			<label id="passwordLabel">
				<strong>Password</strong>
				<input type="password" name="password" value="">
			</label>

			<label id="confirmPasswordLabel">
				<strong>Confirm password</strong>
				<input type="password" name="confirmPassword" value="">
			</label>

			<div id="ideaMakerOnly">
			<label id="locationLabel">
				<strong>Location</strong>
				<input type="text" name="location" value="">
			</label>

			<label id="websiteLabel">
				<strong>Website</strong>
				<input type="url" name="website" value="http://">
			</label>

			<fieldset id="bioFieldset">
				<legend><strong>Bio</strong></legend>
				<label>
					<div>
						<p><textarea name="bio" form="register" rows="5"></textarea></p>
					</div>
					<strong>Choose your profile picture</strong><br>
					<input class="" id="profile-image-input" type="file" name="profileImage" value="">
					<!-- <span id="profile-image"></span> -->
				</label>
			</fieldset>

			<label id="industryLabel">
				<strong>Current Industry / Field</strong>
				<input type="text" name="industry" value="">
			</label>

			<label id="yearsLabel">
				<strong>Years of expertise</strong>
				<input type="number" name="years" value="">
			</label>

			<fieldset id="contactByFieldset">
				<legend>Contact Preference:</legend>
				<select name="contactBy">
					<option name="contactBy" value="byEmail">Reach me by email.</option>
					<option name="contactBy" value="byUrl">Through my website</option>
				</select>
			</fieldset>
			</div>

			<label>
				<input class="button" type="submit" name="submit" value="Let's get started.">
			</label>
		</form>
		<script type="text/javascript">
			$(document).ready(function() {
				if ($('#userType').value != 'ideaMaker') {
					$("#ideaMakerOnly").hide();
				}

				$("#userType").click(function() {
					if (this.value == 'ideaMaker') {
						$("#ideaMakerOnly").show();
					} else {
						$("#ideaMakerOnly").hide();
					}
				});
			});
		</script>
	</section>
	
	<aside>
		<dl>
			<dt>
				<h3>As a Promoter, you can:</h3>
			</dt>
			<dd>
				<ul>
					<li>Promote other people's Ideas</li>
					<li>Post your own Ideas</li>
					<li>Find other people with the same Ideas as you, and connect with them</li>
				</ul>
			</dd>

			<dt>
				<h3>As an Idea-Maker, you can:</h3>
			</dt>

			<dd>
				<ul>
					<li>Do all of the above</li>
					<li>Make your Project with the partners you've connected</li>
				</ul>
			</dd>
		</dl>
	</aside>
</section>