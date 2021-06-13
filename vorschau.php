<?php require('./inc/backend.inc.php'); ?>
<?php $page_title = 'Übersicht'; ?>
<?php require('./inc/header.inc.php'); ?>
<section>
	<header class="major not_print">
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
				$statement = $pdo->prepare("SELECT * FROM `registrations` ORDER BY sailingexperience");
				$result = $statement->execute();
				if(!$statement->fetch()) {
					?>
					<h3>Bis jetzt hat sich noch kein Kind für das Sommercamp angemeldet.</h3>
					<?php
				} else {
					$statement = $pdo->prepare("SELECT * FROM `registrations` ORDER BY id");
					$result = $statement->execute();
					$count = 1;

					$total_mails = "";
					?>
					<a class="not_print" href="javascript:self.print()" style="display:block;text-decoration:none;float:right;"><img src="/images/drucker.png" alt="Seite Drucken" class="not_print"></a>
					<?php

					while($row = $statement->fetch()) {
					$today = date("Y-m-d");
				  $diff = date_diff(date_create($row['birthdate']), date_create($today));
				  $row_age = $diff->format('%y').' Jahre';
					if ($diff->format('%m') > 0) {
						$row_age = $diff->format('%y').' Jahre und '.$diff->format('%m').' Monate';
					}
					?>
						<h2 class="print"><?php echo $row['name_child']; ?></h2>
						<table class="print">
							<tbody>
								<tr>
									<th>Geburtsdatum</th>
									<td><?php echo $row['birthdate']; ?></td>
								</tr>
								<tr>
									<th>Alter</th>
									<td><?php echo $row_age; ?></td>
								</tr>
								<?php if(!empty($row['allergy'])) { ?>
								<tr>
									<th>Allergie</th>
									<td><?php echo $row['allergy']; ?></td>
								</tr>
								<?php
									}
									if(!empty($row['allergy'])) {
								?>
								<tr>
									<th>Medikamente</th>
									<td><?php echo $row['medication']; ?></td>
								</tr>
								<?php } ?>
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
										<?php
											$vcard[$row['id']][0] = "BEGIN:VCARD\r\n";
											$vcard[$row['id']][0] .= "VERSION:2.1\r\n";
											$vcard[$row['id']][0] .= "N;LANGUAGE=de:".$row['lastname_parent1'].";".$row['firstname_parent1']."\r\n";
											$vcard[$row['id']][0] .= "FN:".$row['firstname_parent1']." ".$row['lastname_parent1']."\r\n";
											if(!empty($row['phonenumber_parent1'])) {
												$vcard[$row['id']][0] .= "TEL;HOME;VOICE:".$row['phonenumber_parent1']."\r\n";
											}
											$vcard[$row['id']][0] .= "TEL;CELL;VOICE:".$row['mobilenumber_parent1']."\r\n";
											$vcard[$row['id']][0] .= "ADR;HOME;PREF:;;".$row_adress_parent1."\r\n";
											$vcard[$row['id']][0] .= "LABEL;HOME;PREF:".$row_adress_parent1."\r\n";
											$vcard[$row['id']][0] .= "EMAIL;PREF;INTERNET:".$row['email_parent1']."\r\n";
											$vcard[$row['id']][0] .= "END:VCARD\r\n";
											$fp = fopen('./assets/'.$row['id'].'_1.vcf', "wb");
											fwrite($fp, $vcard[$row['id']][0]);
											fclose($fp);
										?>
										<a href="/assets/<?php echo $row['id']; ?>_1.vcf">vCard</a>
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
										<?php
											$vcard[$row['id']][1] = "BEGIN:VCARD\r\n";
											$vcard[$row['id']][1] .= "VERSION:2.1\r\n";
											$vcard[$row['id']][1] .= "N;LANGUAGE=de:".$row_lastname_parent2.";".$row['firstname_parent2']."\r\n";
											$vcard[$row['id']][1] .= "FN:".$row['firstname_parent2']." ".$row_lastname_parent2."\r\n";
											if(!empty($row_phonenumber_parent2)) {
												$vcard[$row['id']][1] .= "TEL;HOME;VOICE:".$row_phonenumber_parent2."\r\n";
											}
											$vcard[$row['id']][1] .= "TEL;CELL;VOICE:".$row['mobilenumber_parent2']."\r\n";
											$vcard[$row['id']][1] .= "ADR;HOME;PREF:;;".$row_adress_parent2."\r\n";
											$vcard[$row['id']][1] .= "LABEL;HOME;PREF:".$row_adress_parent2."\r\n";
											$vcard[$row['id']][1] .= "EMAIL;PREF;INTERNET:".$row['email_parent2']."\r\n";
											$vcard[$row['id']][1] .= "END:VCARD\r\n";
											$fp = fopen('./assets/'.$row['id'].'_2.vcf', "wb");
											fwrite($fp, $vcard[$row['id']][1]);
											fclose($fp);
										?>
										<a href="/assets/<?php echo $row['id']; ?>_2.vcf" title="Speichern Sie <?php echo $row['firstname_parent2']." ".$row_lastname_parent2; ?> als Kontakt ab.">vCard</a>
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
								<?php
									if(!empty($row['boat_name'])) {
								?>
								<tr>
									<th>Bootsname</th>
									<td><?php echo $row['boat_name']; ?></td>
								</tr>
								<?php
									}
										}
								?>

							</tbody>
						</table><br><br><hr style="height: 5px; background-color: lightgrey;" class="not_print"><br class="not_print"><br class="not_print">
					<?php
							if(!empty($row['email_parent2'])) {
								$maby_both_mails = $row['email_parent1']."; ".$row['email_parent2'];
							} else {
								$maby_both_mails = $row['email_parent1'];
							}
							if($count == 1) {
								$total_mails = $maby_both_mails;
							} else {
								$total_mails .= "; ".$maby_both_mails;
							}
							$count++;
							}
							$total_vcard = "";
							foreach($vcard as $v) {
								foreach($v as $i) {
									$total_vcard .= $i."\r\n";
								}
							}
							$fp = fopen('./assets/all_contacts.vcf', "wb");
							fwrite($fp, $total_vcard);
							fclose($fp);
							?>
							<blockquote class="not_print">
								<p>Alle Eltern als Kontakt herunterladen: <a href="./assets/all_contacts.vcf" rel="download">vCard</a></p>
								<p>An alle Eltern eine E-Mail schreiben (bitte nur per <a href="https://webmail01.webhosting.systems" target="_blank" title="E-Mail-Web-Programm öffnen. (Das Passwort ist in der WhatsApp-Gruppe)">segelcamp@lohheider-see.de</a>): <strong><a href="mailto:?bcc=<?php echo $total_mails; ?>&subject=Information%20zum%20Segelcamp%202021&body=Hallo%20zusammen%2C%0A%0A%0AViele%20Gr%C3%BC%C3%9Fe%0AEuer%20SLS-Jugend-Team">Verteiler</a></strong></p>
							</blockquote>
							<?php
							}
						}
					?>
  </div>
</section>
<?php require('./inc/footer.inc.php'); ?>
