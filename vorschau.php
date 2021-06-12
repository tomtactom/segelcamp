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
											<li class="list-group-item"><strong>Handynummer: </strong><?php echo $row['mobilenumber_parent1']; ?></li>
											<?php
												if(!empty($row['phonenumber_parent1'])) {
											?>
												<li class="list-group-item"><strong>Telefonnummer (Festnetz): </strong><?php echo $row['phonenumber_parent1']; ?></li>
											<?php } ?>
											<?php $row_adress_parent1 = $row['plz_parent1']." ".$row['town_parent1'].", ".$row['street_parent1']." ".$row['housenumber_parent1']; ?>
											<li class="list-group-item"><strong>Adresse: </strong><?php echo $row_adress_parent1; ?></li>
										</ul>
									</td>
								</tr>
								<?php
									if(!empty($row['firstname_parent2'])) {
								?>
								<tr>
									<th>2. Elternteil</th>
									<td>
										<ul class="list-group">
											<?php
												if(empty($row['lastname_parent2'])) {
													$row_lastname_parent2 = $row['lastname_parent1'];
												} else {
													$row_lastname_parent2 = $row['lastname_parent2'];
												}
											?>
											<li class="list-group-item"><strong>Name: </strong><?php echo $row['firstname_parent2']." ".$row_lastname_parent2; ?></li>
											<li class="list-group-item"><strong>E-Mail-Adresse: </strong><a href="mailto:<?php echo $row['email_parent2']; ?>"><?php echo $row['email_parent2']; ?></a></li>
											<li class="list-group-item"><strong>Handynummer: </strong><?php echo $row['mobilenumber_parent2']; ?></li>
											<?php
												if(!empty($row['phonenumber_parent2'])) {
													$row_phonenumber_parent2 = $row['phonenumber_parent2'];
												}	elseif(empty($row['plz_parent2']) && !empty($row['phonenumber_parent1'])) {
													$row_phonenumber_parent2 = $row['phonenumber_parent1'];
												}
												if(!empty($row_phonenumber_parent2)) {
											?>
												<li class="list-group-item"><strong>Telefonnummer (Festnetz): </strong><?php echo $row_phonenumber_parent2; ?></li>
											<?php
												}
												if(empty($row['plz_parent2'])) {
													$row_adress_parent2 = $row_adress_parent1;
												} else {
													$row_adress_parent2 = $row['plz_parent2']." ".$row['town_parent2'].", ".$row['street_parent2']." ".$row['housenumber_parent2'];
												}
											?>
											<li class="list-group-item"><strong>Adresse: </strong><?php echo $row_adress_parent2; ?></li>
										</ul>
									</td>
								</tr>
								<?php
									if(!empty($row['other'])) {
								?>
								<tr>
									<th>Sonstiges</th>
									<td><?php echo $row['other']; ?></td>
								</tr>
								<?php
									}
								?>
								<tr>
									<th>Datenschutz</th>
									<td>
										<ul class="list-group">
											<li class="list-group-item"><strong>Per WhatsApp kontaktieren: </strong><?php if($row['whatsapp'] == true) { echo "Ja"; } else { echo "Nein"; } ?></li>
											<li class="list-group-item"><strong>Foto hochladen: </strong><?php if($row['publishphotos'] == true) { echo "Ja"; } else { echo "Nein"; } ?></li>
										</ul>
									</td>
								</tr>
								<tr>
									<th>Bootsname</th>
									<td><?php echo $row['boat_name']; ?></td>
								</tr>
								<?php
									}
								?>

							</tbody>
						</table><br><br><hr size="4"><br><br>
					<?php }
							}
						}
					?>
  </div>
</section>
<?php require('./inc/footer.inc.php'); ?>
