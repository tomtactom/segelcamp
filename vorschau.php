<?php require('./inc/backend.inc.php'); ?>
<?php $page_title = 'Übersicht'; ?>
<?php require('./inc/header.inc.php'); ?>
<section>
	<header class="major">
		<h2>Übersicht Bereich<?php if(isset($_COOKIE['token'])) { echo ' - <u><a href="?logout">Abmelden</a></u>'; }?></h2>
	</header>
  <div class="content">
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
				if(!$statement->fetch()) {
					?>
					<h3>Bis jetzt hat sich noch kein Kind für das Sommercamp angemeldet.</h3>
					<?php
				} else {
					$statement = $pdo->prepare("SELECT * FROM `registrations` ORDER BY id");
					$result = $statement->execute();
					$count = 1;
					?>
					<a href="javascript:self.print()"><img scr="/images/drucker.png" alt="Seite Drucken"></a>
					<?php
					while($row = $statement->fetch()) {
					$today = date("Y-m-d");
				  $diff = date_diff(date_create($row['birthdate']), date_create($today));
				  $row_age = $diff->format('%y').' Jahre';
					if ($diff->format('%m') > 0) {
						$row_age = ' und '.$diff->format('%m').' Monate';
					}
					?>
						<table>
							<tbody>
								<tr>
									<th>Name des Kindes</th>
									<td><?php echo $row['name_child']; ?></td>
								</tr>
								<tr>
									<th>Geburtsdatum</th>
									<td><?php echo $row['birthdate']; ?></td>
								</tr>
								<tr>
									<th>Alter</th>
									<td><?php echo $row_age; ?></td>
								</tr>
								<tr>
									<th>Allergie</th>
									<td><?php echo $row['allergy']; ?></td>
								</tr>
								<tr>
									<th>Medikamente</th>
									<td><?php echo $row['medication']; ?></td>
								</tr>
								<tr>
									<th>Schwimmabzeichen</th>
									<td><?php echo $row['swimmingbadge']; ?></td>
								</tr>
								<tr>
									<th>Segelerfahrung</th>
									<td><?php echo $row['sailingexperience']; ?></td>
								</tr>
								<tr>
									<th>Kleidungsgröße</th>
									<td><?php #echo $row['']; ?></td>
								</tr>
								<tr>
									<th>Schwimmweste</th>
									<td><?php echo $row['']; ?></td>
								</tr>
								<tr>
									<th>Example</th>
									<td><?php echo $row['']; ?></td>
								</tr>

							</tbody>
						</table>
					<?php }
							}
						}
					?>
  </div>
</section>
<?php require('./inc/footer.inc.php'); ?>
