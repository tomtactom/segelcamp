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
					<a href="javascript:self.print()" style="display:block;text-decoration:none;float:right;"><img src="/images/drucker.png" alt="Seite Drucken"></a>
					<?php
					while($row = $statement->fetch()) {
					$today = date("Y-m-d");
				  $diff = date_diff(date_create($row['birthdate']), date_create($today));
				  $row_age = $diff->format('%y').' Jahre';
					if ($diff->format('%m') > 0) {
						$row_age = $diff->format('%y').' Jahre und '.$diff->format('%m').' Monate';
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
									<td><?php if($row['swimmingbadge'] == 1) { echo "Seepferdchen"; } elseif($row['swimmingbadge'] == 2) { echo "Bronze"; } elseif($row['swimmingbadge'] == 3) { echo "Silber"; } elseif($row['swimmingbadge'] == 4) { echo "Gold"; } ?></td>
								</tr>
								<tr>
									<th>Segelerfahrung</th>
									<td><?php if($row['sailingexperience'] == 1) { echo "Keine"; } elseif($row['sailingexperience'] == 2) { echo "Auf Boot mitgefahren"; } elseif($row['sailingexperience'] == 3) { echo "Schonmal selbst gesegelt"; } elseif($row['sailingexperience'] == 4) { echo "Kann alleine segeln"; } elseif($row['sailingexperience'] == 5) { echo "Kann gut alleine segeln"; } elseif($row['sailingexperience'] == 6) { echo "Fortgeschritten"; } ?></td>
								</tr>
								<tr>
									<th>Kleidungsgröße</th>
									<td><?php if($row['clothingsize'] == 1) { echo "122"; } elseif($row['clothingsize'] == 2) { echo "128"; } elseif($row['clothingsize'] == 3) { echo "134"; } elseif($row['clothingsize'] == 4) { echo "140"; } elseif($row['clothingsize'] == 5) { echo "152"; } elseif($row['clothingsize'] == 6) { echo "158"; } elseif($row['clothingsize'] == 7) { echo "164"; } elseif($row['clothingsize'] == 8) { echo "170"; } ?></td>
								</tr>
								<tr>
									<th>Eigene Schwimmweste</th>
									<td><?php if($row['lifejacket'] == 1) { echo "Ja"; } else { echo "Nein"; } ?></td>
								</tr>
								<tr>
									<th>1. Elternteil</th>
									<td>
										<ul class="list-group">
											<li class="list-group-item"><strong>Name: </strong><?php echo $row['firstname_parent1']." ".$row['lastname_parent1']; ?></li>
											<li class="list-group-item"><strong>E-Mail-Adresse: </strong><a href="mailto:<?php echo $row['email_parent1']; ?>"><?php echo $row['email_parent1']; ?></a></li>
											<li class="list-group-item"></li>
											<li class="list-group-item"></li>
											<li class="list-group-item"></li>
											<li class="list-group-item"></li>
										</ul>
									</td>
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
