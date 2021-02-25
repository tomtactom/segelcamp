<?php require('./inc/backend.inc.php'); ?>
<?php $page_title = 'Administrator'; ?>
<?php require('./inc/header.inc.php'); ?>
<section>
	<header class="major">
		<h2>Administrator Bereich</h2>
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
		<?php } else { ?>
			Du bist erfolgreich eingeloggt!
		<?php } ?>
  </div>
</section>
<?php require('./inc/footer.inc.php'); ?>
