<?php require('./inc/backend.inc.php'); ?>
<?php $page_title = 'Administrator'; ?>
<?php require('./inc/header.inc.php'); ?>
<section>
	<header class="major">
		<h2>Administrator Bereich<?php if(isset($_COOKIE['token'])) { echo ' - <u><a href="?logout">Abmelden</a></u>'; }?></h2>
	</header>
  <div class="content" style="max-width: 900px; margin: auto;">
		<?php if(isset($msg_field)) { echo $msg_field; } ?>
    <?php if($_COOKIE['token'] != $admin_cookie_hash) { ?>
			<div class="row gtr-uniform">
				<p>Bitte denken Sie unbedingt daran sich Abzumelden, wenn Sie sich auf einem öffentlichen Computer anmelden.</p>
				<form method="post">
					<div class="col-6 col-12-xsmall">
						<input type="password" name="password" placeholder="Passwort" required autofocus autocomplete="off">
					</div>
					<div class="col-6 col-12-xsmall">
						<input type="submit" name="admin_login" value="Einloggen">
					</div>
				</form>
			</div>
		<?php
			} else {
				$statement = $pdo->prepare("SELECT * FROM `registrations` ORDER BY id");
				$result = $statement->execute();
				print_r($statement->fetch());
				$count = 1;
		?>
			<table id="sort">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name Kind</th>
						<th>Geburtsdatum</th>
						<th>Allergie</th>
						<th>Medikamete</th>
						<th>Schwimmabzeichen</th>
						<th>Segelerfahrung</th>
						<th>Kleidungsgröße</th>
						<th>Schwimmweste</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($row = $statement->fetch()) {
					?>
					<tr>
						<td scope="row"><?php echo $count++ ?></td>
						<td><?php echo $row['name_child'] ?></td>
						<td><?php echo $row['birthdate'] ?></td>
						<td><?php echo $row['allergy'] ?></td>
						<td><?php echo $row['medication'] ?></td>
						<td><?php echo $row['swimmingbadge'] ?></td>
						<td><?php echo $row['sailingexperience'] ?></td>
						<td><?php echo $row['clothingsize'] ?></td>
						<td><?php echo $row['lifejacket'] ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		<?php } ?>
  </div>
</section>
<?php require('./inc/footer.inc.php'); ?>
