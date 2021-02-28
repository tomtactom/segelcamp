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
						<th>Allergie</th>
						<th>Medikamente</th>
						<th>Schwimmabzeichen</th>
						<th>Segelerfahrung</th>
						<th>Kleidungsgröße</th>
						<th>Schwimmweste</th>
						<th>Vorname 1. Elternteil</th>
						<th>Nachname 1. Elternteil</th>
						<th>E-Mail-Adresse 1. Elternteil</th>
						<th>Handynummer 1. Elternteil</th>
						<th>Telefonnummer 1. Elternteil</th>
						<th>PLZ 1. Elternteil</th>
						<th>Stadt 1. Elternteil</th>
						<th>Straße 1. Elternteil</th>
						<th>Hausnummer 1. Elternteil</th>
						<th>Vorname 2. Elternteil</th>
						<th>Nachname 2. Elternteil</th>
						<th>E-Mail-Adresse 2. Elternteil</th>
						<th>Handynummer 2. Elternteil</th>
						<th>Telefonnummer 2. Elternteil</th>
						<th>PLZ 2. Elternteil</th>
						<th>Stadt 2. Elternteil</th>
						<th>Straße 2. Elternteil</th>
						<th>Hausnummer 2. Elternteil</th>
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
						<td scope="row"><?php echo $count++ ?></td>
						<td><?php echo $row['name_child'] ?></td>
						<td><?php echo $row['birthdate'] ?></td>
						<td><?php echo $row['allergy'] ?></td>
						<td><?php echo $row['medication'] ?></td>
						<td><?php if($row['swimmingbadge'] == 1) { echo 'Seepferdchen'; } elseif($row['swimmingbadge'] == 2) { echo 'Bronze'; } elseif($row['swimmingbadge'] == 3) { echo 'Silber' } elseif($row['swimmingbadge'] == 4) { echo 'Gold'; } ?></td>
						<td><?php echo $row['sailingexperience'] ?></td>
						<td><?php echo $row['clothingsize'] ?></td>
						<td><?php echo $row['lifejacket'] ?></td>
						<td><?php echo $row['firstname_parent1'] ?></td>
						<td><?php echo $row['lastname_parent1'] ?></td>
						<td><a href="mailto:<?php echo $row['email_parent1'] ?>"><?php echo $row['email_parent1'] ?></a></td>
						<td><a href="tel:<?php echo $row['mobilenumber_parent1'] ?>"><?php echo $row['mobilenumber_parent1'] ?></a></td>
						<td><a href="tel:<?php echo $row['phonenumber_parent1'] ?>"><?php echo $row['phonenumber_parent1'] ?></a></td>
						<td><?php echo $row['plz_parent1'] ?></td>
						<td><?php echo $row['town_parent1'] ?></td>
						<td><?php echo $row['street_parent1'] ?></td>
						<td><?php echo $row['housenumber_parent1'] ?></td>
						<td><?php echo $row['firstname_parent2'] ?></td>
						<td><?php echo $row['lastname_parent2'] ?></td>
						<td><a href="mailto:<?php echo $row['email_parent2'] ?>"><?php echo $row['email_parent2'] ?></a></td>
						<td><a href="tel:<?php echo $row['mobilenumber_parent2'] ?>"><?php echo $row['mobilenumber_parent2'] ?></a></td>
						<td><a href="tel:<?php echo $row['phonenumber_parent2'] ?>"><?php echo $row['phonenumber_parent2'] ?></a></td>
						<td><?php echo $row['plz_parent2'] ?></td>
						<td><?php echo $row['town_parent2'] ?></td>
						<td><?php echo $row['street_parent2'] ?></td>
						<td><?php echo $row['housenumber_parent2'] ?></td>
						<td><?php echo $row['other'] ?></td>
						<td><?php echo $row['whatsapp'] ?></td>
						<td><?php echo $row['publishphotos'] ?></td>
						<td><?php echo $row['user_ip'] ?></td>
						<td><?php echo $row['user_useragent'] ?></td>
						<td><?php echo $row['accepted'] ?></td>
						<td><?php echo $row['amount_payed'] ?></td>
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
