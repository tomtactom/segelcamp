<?php require('./inc/backend.inc.php'); ?>
<?php $page_title = 'Administrator'; ?>
<?php require('./inc/header.inc.php'); ?>
<section>
	<header class="major">
		<h2>Administrator Bereich<?php if(isset($_COOKIE['token'])) { echo ' - <u><a href="?logout">Abmelden</a></u>'; }?></h2>
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
		?>
		<div class="table-scrollable">
			<table id="sort">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name Kind</th>
						<th>Geburtsdatum</th>
						<th>Alter</th>
						<th>Allergie</th>
						<th>Medikamente</th>
						<th>Schwimmabzeichen</th>
						<th>Segelerfahrung</th>
						<th>Kleidungsgröße</th>
						<th>Schwimmweste</th>
						<th>Name 1. Elternteil</th>
						<th>E-Mail-Adresse 1. Elternteil</th>
						<th>Handynummer 1. Elternteil</th>
						<th>Telefonnummer 1. Elternteil</th>
						<th>Adresse 1. Elternteil</th>
						<th>Name 2. Elternteil</th>
						<th>E-Mail-Adresse 2. Elternteil</th>
						<th>Handynummer 2. Elternteil</th>
						<th>Telefonnummer 2. Elternteil</th>
						<th>Adresse 2. Elternteil</th>
						<th>Sonstiges</th>
						<th>Datenschutz WhatsApp</th>
						<th>Datenschutz Foto hochladen</th>
						<th>Nutzer IP</th>
						<th>Nutzer Useragent</th>
						<th>Wurde von uns akzeptiert</th>
						<th>Beitrag überwiesen</th>
						<th>Bootsname</th>
						<th>Nachträglich geändert</th>
						<th>Angemeldet am</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$statement = $pdo->prepare("SELECT * FROM `registrations` ORDER BY id");
					$result = $statement->execute();
					$count = 1;
						while($row = $statement->fetch()) {
					?>
					<tr>
						<form method="post">
						<td scope="row"><?php echo $count++ ?></td>
						<td><input type="text" value="<?php echo $row['name_child'] ?>" name="" placeholder="" minlenght="" maxlength="" required></td>
						<td><input type="date" value="<?php echo $row['birthdate'] ?>" name="" placeholder="" minlenght="" maxlength="" min="" max="" required></td>
						<td><?php
						$today = date("Y-m-d");
					  $diff = date_diff(date_create($row['birthdate']), date_create($today));
					  echo $diff->format('%y').' Jahre';
						if ($diff->format('%m') > 0) {
							echo ' und '.$diff->format('%m').' Monate';
						}
						?></td>
						<td><input type="text" value="<?php echo $row['allergy'] ?>" name="" placeholder="" minlenght="" maxlength="" required></td>
						<td><input type="text" value="<?php echo $row['medication'] ?>" name="" placeholder="" minlenght="" maxlength="" required></td>
						<td><select name="swimmingbadge" required>
							<option value="1"<?php if($row['swimmingbadge']=="1") { echo ' selected'; } ?>>Seepferdchen</option>
							<option value="2"<?php if($row['swimmingbadge']=="2") { echo ' selected'; } ?>>Bronze</option>
							<option value="3"<?php if($row['swimmingbadge']=="3") { echo ' selected'; } ?>>Silber</option>
							<option value="4"<?php if($row['swimmingbadge']=="4") { echo ' selected'; } ?>>Gold</option>
						</select></td>
						<td><?php if($row['sailingexperience'] == 1) { echo 'Keine'; } elseif($row['sailingexperience'] == 2) { echo 'Auf Boot mitgefahren'; } elseif($row['sailingexperience'] == 3) { echo 'Schonmal selbst gesegelt'; } elseif($row['sailingexperience'] == 4) { echo 'Kann alleine segeln'; } elseif($row['sailingexperience'] == 5) { echo 'Kann gut alleine segeln'; } elseif($row['sailingexperience'] == 6) { echo 'Fortgeschritten'; } ?></td>
						<td><?php if($row['clothingsize'] == 1) { echo '122'; } elseif($row['clothingsize'] == 2) { echo '128'; } elseif($row['clothingsize'] == 3) { echo '134'; } elseif($row['clothingsize'] == 4) { echo '140'; } elseif($row['clothingsize'] == 5) { echo '152'; } elseif($row['clothingsize'] == 6) { echo '158'; } elseif($row['clothingsize'] == 7) { echo '164'; } elseif($row['clothingsize'] == 8) { echo '170'; } ?></td>
						<td><?php if($row['lifejacket'] == 1) { echo 'Ja'; } else { echo 'Nein'; } ?></td>
						<td><?php echo $row['firstname_parent1'].' '.$row['lastname_parent1'] ?></td>
						<td><a href="mailto:<?php echo $row['email_parent1'] ?>"><?php echo $row['email_parent1'] ?></a></td>
						<td><a href="tel:<?php echo $row['mobilenumber_parent1'] ?>"><?php echo $row['mobilenumber_parent1'] ?></a></td>
						<td><a href="tel:<?php echo $row['phonenumber_parent1'] ?>"><?php echo $row['phonenumber_parent1'] ?></a></td>
						<td><?php echo $row['plz_parent1'].' '.$row['town_parent1'].' '.$row['street_parent1'].' '.$row['housenumber_parent1'] ?></td>
						<td><?php echo $row['firstname_parent2'].' '.$row['lastname_parent2'] ?></td>
						<td><a href="mailto:<?php echo $row['email_parent2'] ?>"><?php echo $row['email_parent2'] ?></a></td>
						<td><a href="tel:<?php echo $row['mobilenumber_parent2'] ?>"><?php echo $row['mobilenumber_parent2'] ?></a></td>
						<td><a href="tel:<?php echo $row['phonenumber_parent2'] ?>"><?php echo $row['phonenumber_parent2'] ?></a></td>
						<td><?php echo $row['plz_parent2'].' '.$row['town_parent2'].' '.$row['street_parent2'].' '.$row['housenumber_parent2'] ?></td>
						<td><?php echo $row['other'] ?></td>
						<td><?php if($row['whatsapp'] == 1) { echo 'Ja'; } else { echo 'Nein'; } ?></td>
						<td><?php if($row['publishphotos'] == 1) { echo 'Ja'; } else { echo 'Nein'; } ?></td>
						<td><?php echo $row['user_ip'] ?></td>
						<td><small><?php echo $row['user_useragent'] ?></small></td>
						<td><?php if($row['accepted'] == 1) { echo 'Ja'; } else { echo 'Noch nicht'; } ?></td>
						<td><?php if($row['amount_payed'] == "1") { echo 'Ja'; } elseif($row['amount_payed'] == "0" || $row['amount_payed'] == "0,00 €") { echo 'Nein'; } else { echo $row['amount_payed']; } ?></td>
						<td><?php echo $row['boat_name'] ?></td>
						<td><?php echo $row['changed_by_admin'] ?></td>
						<td><?php echo $row['created_at'] ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
		<?php
			}
			}
	?>
  </div>
</section>
<?php require('./inc/footer.inc.php'); ?>
