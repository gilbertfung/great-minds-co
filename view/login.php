<section class="content">
	<div id="hero">
		<h1>Log in or Sign up:</h1>
	</div>

	<div id="registerArea">
		<form id="registerPromoter" action="process.php?action=registerP" method="post">
			<h2>Sign up to be a Promoter!</h2>
			<label>Name:</label>
			<input type="text" name="name" value="" />

			<label>Email:</label>
			<input type="email" name="email" value="" />

			<label class="nolabel"></label>
			<input type="submit" name="submit" value="Sign Up" />
		</form>

		<form id="registerIdeaMaker" action="process.php?action=registerIM" method="post">
			<h2>Sign up to be an Idea-Maker!</h2>
			
			<label>Email:</label>
			<input type="email" name="email" value="" />
			
			<label>Password:</label>
			<input type="password" name="password" value="" />

			<label>Name:</label>
			<input type="text" name="name" value="" />
			
			<!-- TODO: maybe have following part of form to be in another page? More friendly that way. -->
			<label>Location:</label>
			<input type="text" name="location" value="" />
			
			<label>Website:</label>
			<input type="url" name="website" value="" />
			
			<label>Main Industry / Field:</label>
			<input type="text" name="expertise" value="" />
			
			<label>Years of expertise:</label>
			<input type="text" name="expertiseyears" value="" />
			
			<label>Bio:</label>
			<textarea name="bio" form="registerIdeaMaker" ></textarea>
			
			<label>Profile photo:</label>
			<input type="text" name="profilepic" value="" />
			
			<label>Contact Preference:</label>
			<input type="text" name="contactby" value="" />
			
			<label class="nolabel"></label>
			<input type="submit" name="submit" value="Sign Up" />
			
			<label>*Project Note: Ideally, Idea-Makers will be "upgraded" from Promoters.</label>
		</form>
	</div>
	<div id="loginArea">
		<form id="login" action="process.php?action=loggingin" method="post">
			<h2>Log in here:</h2>
			<label>Email:</label>
			<input type="email" name="email" value="" />

			<label>Password:</label>
			<input type="password" name="password" value="" />

			<label class="nolabel"></label>
			<input type="submit" name="submit" value="Log in" />
		</form>
	</div>
</section>