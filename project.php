<?php require_once 'includes/session.php'; ?>
<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'includes/functions.php'; ?>
<?php require_once 'includes/layouts/header.php'; ?>
<?php requireSSL(false); 

$idea;

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
	<div class="flex bar">
		<h3>Project Updates 
			<span class="action">
				<?php 
					if (is_project($idea['idea_id'])) {
						if (is_project_owner($idea['idea_id'], $_SESSION['user_id'])) {// if this project owner is current user...
							$_SESSION['idea_id'] = $idea['idea_id'];
							echo '<a href="update.php">Create a new update</a>';
						}
					}
				?>
			</span>
		</h3>
		<?php 
			if (is_project($idea['idea_id'])) {
				$updates = find_all_updates_by_project($idea['idea_id']);
				while ($update = mysqli_fetch_assoc($updates)) {
					echo '<div id="'.$update["update_id"].'" class="bar" style="background:#'.randcol().'">';
						echo '<h3>'.$update["update_name"].'<span class="action">'.$update['date_created'].'</span></h3>';
						echo '<p>'.$update['content'].'</p>';
					echo '</div>'; 
				}
			}
		?>
	</div>
</section>


</div>
</section>
<?php require 'includes/layouts/footer.php'; ?>