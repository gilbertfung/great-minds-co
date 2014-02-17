<?php require_once 'includes/session.php'; ?>
<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'includes/functions.php'; ?>
<?php require_once 'includes/layouts/header.php'; ?>
<?php requireSSL(false); 

if (isset($_GET['id'])) {
	$idea = find_idea_by_id($_GET['id']);
} else {
	$_SESSION['message'] = "Which project are you looking at?";
	redirect_to('index.php');
}

?>
<div id="cover">
<h2><?php echo $idea['title']; ?></h2>
<section class="content flex">
	<div class="flex bar">
		<div class="side"><img src="//" width="320" height="240"></div>
		<div class="section">
			<p><?php 
			if (empty($idea['content'])) {
				echo "This project doesn't have a blurb.";
			} else {
				echo $idea['content']; 
			}?>
			</p>
			<?php echo promote_button($idea) ?>
			<table>
				<tr>
					<th>Author</th>
					<th>Status</th>
					<th>Website</th>
					<th>Date Created</th>
				</tr>
				<tr>
					<td><?php $user = find_user_by_idea_id($idea['idea_id']); echo $user['name']; ?></td>
					<td><?php if(is_project($idea['idea_id'])) {echo "Project";} else {echo "Idea";} ?></td>
					<td><?php echo $idea['url']; ?></td>
					<td><?php echo $idea['date_created']; ?></td>
				</tr>
			</table>
		</div>
	</div>
</section>
</div>
</section>
<?php require 'includes/layouts/footer.php'; ?>