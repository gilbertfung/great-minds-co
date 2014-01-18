<section class="content">
	<div id="hero">
		<h1>Log in or Sign up:</h1>
	</div>

	<div id="formArea">
		<article id="registerArea">
			<form id="registerPromoter" action="process.php?action=registerP" method="post">
				<h2>Sign up to be a Promoter!</h2>
				<table>
					<tr>
						<td><label>Name:</label></td>
						<td><input type="text" name="name" value=""></td>
					</tr>
					<tr>
						<td><label>Email:</label></td>
						<td><input type="email" name="email" value=""></td>
					</tr>
					<tr>
						<td><input class="button" type="submit" name="submit" value="Sign Up"></td>
					</tr>
				</table>
			</form>

			<form id="registerIdeaMaker" action="process.php?action=registerIM" method="post">
				<h2>Sign up to be an Idea-Maker!</h2>
				<table>
					<tr>
						<td><label>Email:</label></td>
						<td><input type="email" name="email" value=""></td>
					</tr>
					<tr>
						<td><label>Password:</label></td>
						<td><input type="password" name="password" value=""></td>
					</tr>
					<tr>
						<td><label>Name:</label></td>
						<td><input type="text" name="name" value=""></td>
					</tr>
					<tr>
						<!-- TODO: maybe have following part of form to be in another page? More friendly that way. -->
						<td><label>Location:</label></td>
						<td><input type="text" name="location" value=""></td>
					</tr>
					<tr>
						<td><label>Website:</label></td>
						<td><input type="url" name="website" value=""></td>
					</tr>
					<tr>
						<td><label>Main Industry / Field:</label></td>
						<td><input type="text" name="expertise" value=""></td>
					</tr>
					<tr>
						<td><label>Years of expertise:</label></td>
						<td><input type="text" name="expertiseyears" value=""></td>
					</tr>
					<tr>
						<td><label>Bio:</label></td>
						<td><textarea name="bio" form="registerIdeaMaker"></textarea></td>
					</tr>
					<tr>
						<td><label>Profile photo:</label></td>
						<td><input type="file" name="profilepic" value=""></td>
					</tr>
					<tr>
						<td><label>Contact Preference:</label></td>
						<td><input type="radio" name="contactBy" value="byEmail"> Reach me by email.</td>
					</tr>
					<tr>
						<td><span class="nolabel"><input type="radio" name="contactBy" value="byUrl"> Through my website</span></td>
					</tr>
					<tr>
						<td><span class="nolabel"><input type="radio" name="contactBy" value="Other"> <input type="text" name="contactByOther" value=""></span></td>
					</tr>
					<tr>
						<td><input class="button" type="submit" name="submit" value="Sign Up"></td>
					</tr>
				</table>
				
				<label>*Project Note: Ideally, Idea-Makers will be "upgraded" from Promoters.</label>
			</form>
		</article>
		<article id="loginArea">
			<form id="login" action="process.php?action=loggingin" method="post">
				<h2>Log in here:</h2>
				<table>
					<tr>
						<td><label>Email:</label></td>
						<td><input type="email" name="email" value=""></td>
					</tr>
					<tr>
						<td><label>Password:</label></td>
						<td><input type="password" name="password" value=""></td>
					</tr>
					<tr>
						<td><input class="button" type="submit" name="submit" value="Log in"></td>
					</tr>
				</table>
			</form>
		</article>
	</div>
</section>