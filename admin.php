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
		<p>Bitte achten Sie darauf, dass nach dem bearbeiten der jeweiligen Zeile mit dem „Ändern“ Button, nur die Änderungen der jeweiligen Zeile übernommen werden.</p>
		<div class="table-scrollable">
			<table id="sort">
				<thead>
					<tr>
						<th>Löschen</th>
						<th>Ändern</th>
						<th>Nr.</th>
						<th>Name Kind</th>
						<th>Geburtsdatum</th>
						<th>Alter</th>
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
						<form method="post">
						<td><button type="submit" name="delete_user" value="<?php echo $row['id']; ?>" disabled>Löschen</button></td>
						<td><button type="submit" name="update_user" value="<?php echo $row['id']; ?>">Ändern</button></td>
						<td scope="row"><?php echo $count++ ?></td>
						<td><input type="text" value="<?php echo $row['name_child'] ?>" name="name_child" placeholder="* Vor- und Nachname des Kindes" required></td>
						<td><input type="date" value="<?php echo $row['birthdate'] ?>" name="birthdate" placeholder="* Geburtsdatum" minlenght="10" maxlength="10" required></td>
						<td><?php
						$today = date("Y-m-d");
					  $diff = date_diff(date_create($row['birthdate']), date_create($today));
					  echo $diff->format('%y').' Jahre';
						if ($diff->format('%m') > 0) {
							echo ' und '.$diff->format('%m').' Monate';
						}
						?></td>
						<td><input type="text" value="<?php echo $row['allergy'] ?>" name="allergy" placeholder="Allergien / Unverträglichkeiten"></td>
						<td><input type="text" value="<?php echo $row['medication'] ?>" name="medication" placeholder="Vorerkrankungen / Medikamente"></td>
						<td><select name="swimmingbadge" required>
							<option value="1"<?php if($row['swimmingbadge']==1) { echo ' selected'; } ?>>Seepferdchen</option>
							<option value="2"<?php if($row['swimmingbadge']==2) { echo ' selected'; } ?>>Bronze</option>
							<option value="3"<?php if($row['swimmingbadge']==3) { echo ' selected'; } ?>>Silber</option>
							<option value="4"<?php if($row['swimmingbadge']==4) { echo ' selected'; } ?>>Gold</option>
						</select></td>
						<td><select name="sailingexperience" required>
							<option value="1"<?php if($row['sailingexperience']==1) { echo ' selected'; } ?>>Keine</option>
							<option value="2"<?php if($row['sailingexperience']==2) { echo ' selected'; } ?>>Auf Boot mitgefahren</option>
							<option value="3"<?php if($row['sailingexperience']==3) { echo ' selected'; } ?>>Schonmal selbst gesegelt</option>
							<option value="4"<?php if($row['sailingexperience']==4) { echo ' selected'; } ?>>Kann alleine segeln</option>
							<option value="5"<?php if($row['sailingexperience']==5) { echo ' selected'; } ?>>Kann gut alleine segeln</option>
							<option value="6"<?php if($row['sailingexperience']==6) { echo ' selected'; } ?>>Fortgeschritten</option>
						</select></td>
						<td><select name="clothingsize" required>
							<option value="1"<?php if($row['clothingsize']==1) { echo ' selected'; } ?>>122</option>
							<option value="2"<?php if($row['clothingsize']==2) { echo ' selected'; } ?>>128</option>
							<option value="3"<?php if($row['clothingsize']==3) { echo ' selected'; } ?>>134</option>
							<option value="4"<?php if($row['clothingsize']==4) { echo ' selected'; } ?>>140</option>
							<option value="5"<?php if($row['clothingsize']==5) { echo ' selected'; } ?>>152</option>
							<option value="6"<?php if($row['clothingsize']==6) { echo ' selected'; } ?>>158</option>
							<option value="7"<?php if($row['clothingsize']==7) { echo ' selected'; } ?>>164</option>
							<option value="8"<?php if($row['clothingsize']==8) { echo ' selected'; } ?>>170</option>
						</select></td>
						<td><select name="lifejacket">
							<option value="1"<?php if($row['lifejacket']==1) { echo ' selected'; } ?>>Ja</option>
							<option value="0"<?php if($row['lifejacket']!=1) { echo ' selected'; } ?>>Nein</option>
						</select></td>
						<td><input type="text" value="<?php echo $row['firstname_parent1'] ?>" name="firstname_parent1" placeholder="* Vorname" required></td>
						<td><input type="text" value="<?php echo $row['lastname_parent1'] ?>" name="lastname_parent1" placeholder="* Nachname" required></td>
						<td><input type="email" value="<?php echo $row['email_parent1'] ?>" name="email_parent1" placeholder="* E-Mail-Adresse" required></td>
						<td><input type="tel" value="<?php echo $row['mobilenumber_parent1'] ?>" name="mobilenumber_parent1" placeholder="* Handynummer" required></td>
						<td><input type="tel" value="<?php echo $row['phonenumber_parent1'] ?>" name="phonenumber_parent1" placeholder="Telefonnummer (Festnetz)"></td>
						<td><input type="text" value="<?php echo $row['plz_parent1'] ?>" name="plz_parent1" placeholder="* PLZ" minlenght="5" maxlength="5" required></td>
						<td><input type="text" value="<?php echo $row['town_parent1'] ?>" name="town_parent1" placeholder="* Ort" required></td>
						<td><input type="text" value="<?php echo $row['street_parent1'] ?>" name="street_parent1" placeholder="* Straße" required></td>
						<td><input type="text" value="<?php echo $row['housenumber_parent1'] ?>" name="housenumber_parent1" placeholder="* Hausnummer" required></td>
						<td><input type="text" value="<?php echo $row['firstname_parent2'] ?>" name="firstname_parent2" placeholder="Vorname"></td>
						<td><input type="text" value="<?php echo $row['lastname_parent2'] ?>" name="lastname_parent2" placeholder="Nachname"></td>
						<td><input type="email" value="<?php echo $row['email_parent2'] ?>" name="email_parent2" placeholder="E-Mail-Adresse"></td>
						<td><input type="tel" value="<?php echo $row['mobilenumber_parent2'] ?>" name="mobilenumber_parent2" placeholder="Handynummer"></td>
						<td><input type="tel" value="<?php echo $row['phonenumber_parent2'] ?>" name="phonenumber_parent2" placeholder="Telefonnummer (Festnetz)"></td>
						<td><input type="text" value="<?php echo $row['plz_parent2'] ?>" name="plz_parent2" placeholder="PLZ"></td>
						<td><input type="text" value="<?php echo $row['town_parent2'] ?>" name="town_parent2" placeholder="Ort"></td>
						<td><input type="text" value="<?php echo $row['street_parent2'] ?>" name="street_parent2" placeholder="Straße"></td>
						<td><input type="text" value="<?php echo $row['housenumber_parent2'] ?>" name="housenumber_parent2" placeholder="Hausnummer"></td>
						<td><input type="text" value="<?php echo $row['other'] ?>" name="other" placeholder="Sonstiges"></td>
						<td><input type="text" value="<?php if($row['whatsapp'] == 1) { echo 'Ja';} else { echo 'Nein'; } ?>" disabled></td>
						<td><input type="text" value="<?php if($row['publishphotos'] == 1) { echo 'Ja';} else { echo 'Nein'; } ?>" disabled></td>
						<td><?php echo $row['user_ip'] ?></td>
						<td><small><?php echo $row['user_useragent'] ?></small></td>
						<td><select name="accepted">
							<option value="1"<?php if($row['accepted']==1) { echo ' selected'; } ?>>Ja</option>
							<option value="0"<?php if($row['accepted']!=1) { echo ' selected'; } ?>>Noch nicht</option>
						</select></td>
						<td><input type="text" value="<?php echo $row['amount_payed'] ?>" name="amount_payed" placeholder="Beitrag überwiesen?"></td>
						<td><input type="text" value="<?php echo $row['boat_name'] ?>" name="boat_name" placeholder="Bootsname"></td>
						<td><input type="text" value="<?php if (empty($row['changed_by_admin'])) { echo "Nein"; } else { echo $row['changed_by_admin']; } ?>" disabled></td>
						<input type="hidden" name="changed_by_admin" value="Ja">
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
