<?php
if (file_exists('./inc/config.inc.php')) {
  unlink('./install.php');
  header('Location: /');
}

// https://stackoverflow.com/questions/4356289/php-random-string-generator
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (isset($_POST['database_form'])) {
  $database = trim($_POST['database']);
  $username = trim($_POST['username']);
  $password = $_POST['password'];
  $host = trim($_POST['host']);
  $min_birthday = trim($_POST['min_birthday']);
  $max_birthday = trim($_POST['max_birthday']);
  $admin_password = $_POST['admin_password'];

  // Check connection
  $connection = @new mysqli($host, $username, $password, $database);
  if ($connection->connect_errno) {
    $msg = "Es konnte sich leider nicht mit dem MySQL-Server verbunden werden. Bitte überprüfen Sie, ob Ihre Eingaben korrekt waren und versuchen Sie es erneut. (".$connection->connect_errno.") ".$connection->connect_error;
  } else {
    // Informationen in ./inc/config.inc.php schreiben
    file_put_contents('./inc/config.inc.php', '<?php
$min_birthday = "'.$min_birthday.'";
$max_birthday = "'.$max_birthday.'";
$db_host = "'.$host.'";
$db_name = "'.$database.'";
$db_user = "'.$username.'";
$db_password = "'.$password.'";
$salt1 = "'.generateRandomString().'";
$salt2 = "'.generateRandomString().'";
$admin_password = "'.hash('sha256', $salt1.$admin_password.$salt2).'";
$admin_cookie_hash = "'.generateRandomString(32).'";
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);');

    $query = "CREATE TABLE IF NOT EXISTS `registrations` (
`id` INT unsigned NOT NULL AUTO_INCREMENT,
`name_child` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
`birthdate` TEXT COLLATE utf8_unicode_ci NOT NULL,
`allergy` TEXT COLLATE utf8_unicode_ci DEFAULT NULL,
`medication` TEXT COLLATE utf8_unicode_ci DEFAULT NULL,
`swimmingbadge` INT COLLATE utf8_unicode_ci DEFAULT 0,
`sailingexperience` INT COLLATE utf8_unicode_ci NOT NULL,
`clothingsize` INT COLLATE utf8_unicode_ci NOT NULL,
`lifejacket` INT COLLATE utf8_unicode_ci DEFAULT 0,
`firstname_parent1` TEXT COLLATE utf8_unicode_ci NOT NULL,
`lastname_parent1` TEXT COLLATE utf8_unicode_ci NOT NULL,
`email_parent1` TEXT COLLATE utf8_unicode_ci NOT NULL,
`mobilenumber_parent1` TEXT COLLATE utf8_unicode_ci NOT NULL,
`phonenumber_parent1` TEXT COLLATE utf8_unicode_ci NOT NULL,
`plz_parent1` TEXT COLLATE utf8_unicode_ci NOT NULL,
`town_parent1` TEXT COLLATE utf8_unicode_ci NOT NULL,
`street_parent1` TEXT COLLATE utf8_unicode_ci NOT NULL,
`housenumber_parent1` TEXT COLLATE utf8_unicode_ci NOT NULL,
`firstname_parent2` TEXT COLLATE utf8_unicode_ci NOT NULL,
`lastname_parent2` TEXT COLLATE utf8_unicode_ci NOT NULL,
`email_parent2` TEXT COLLATE utf8_unicode_ci NOT NULL,
`mobilenumber_parent2` TEXT COLLATE utf8_unicode_ci NOT NULL,
`phonenumber_parent2` TEXT COLLATE utf8_unicode_ci NOT NULL,
`plz_parent2` TEXT COLLATE utf8_unicode_ci NOT NULL,
`town_parent2` TEXT COLLATE utf8_unicode_ci NOT NULL,
`street_parent2` TEXT COLLATE utf8_unicode_ci NOT NULL,
`housenumber_parent2` TEXT COLLATE utf8_unicode_ci NOT NULL,
`other` TEXT COLLATE utf8_unicode_ci NOT NULL,
`correctinformation` INT COLLATE utf8_unicode_ci NOT NULL,
`disclaimer` INT COLLATE utf8_unicode_ci NOT NULL,
`coronasymptoms` INT COLLATE utf8_unicode_ci NOT NULL,
`whatsapp` INT COLLATE utf8_unicode_ci DEFAULT 0,
`publishphotos` INT COLLATE utf8_unicode_ci DEFAULT 0,
`user_ip` TEXT COLLATE utf8_unicode_ci NOT NULL,
`user_useragent` TEXT COLLATE utf8_unicode_ci DEFAULT NULL,
`accepted` INT COLLATE utf8_unicode_ci DEFAULT 0,
`amount_payed` TEXT COLLATE utf8_unicode_ci DEFAULT '0,00 €',
`boat_name` TEXT COLLATE utf8_unicode_ci DEFAULT NULL,
`changed_by_admin` TEXT COLLATE utf8_unicode_ci DEFAULT NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
UNIQUE (`name_child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
      mysqli_query($connection,$query) or die('Problem beim Ausführen der SQL-Abfrage.');
      $msg = "Die grundlegenden Einstellungen konnten alle vorgenommen werden.";
      unlink('./install.php');
      header('Location: /');

    }
  } else {
    $show_form = true;
  }
?>
<!DOCTYPE HTML>
<html lang="de">
	<head>
        <meta charset="utf-8" />
		<title>Installieren...</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="language" content="de">
        <meta name="audience" content="Administrator">
        <meta name="page-type" content="Formular">
        <meta name="description" content="Über diese Seite können Sie das Tool installieren. Sollten Sie nicht berechtigt sein, diese Seite zu betreten, verlassen Sie diese bitte wieder und geben dem Administrator der Webseite bescheid.">
        <meta name="robots" content="noindex, nofollow">
        <meta http-equiv="language" content="german, de">
        <meta name="author" content="Tom Aschmann">
        <meta name="copyright" content="Tom Aschmann">
        <meta name="publisher" content="Seglergemeinschaft Lohheider See e.V.">
        <meta name="date" content="2021-02-15">
        <link rel="apple-touch-icon" sizes="57x57" href="./assets/icons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="./assets/icons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="./assets/icons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="./assets/icons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="./assets/icons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="./assets/icons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="./assets/icons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="./assets/icons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="./assets/icons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="./assets/icons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="./assets/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="./assets/icons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="./assets/icons/favicon-16x16.png">
        <link rel="manifest" href="./assets/icons/manifest.json">
        <meta name="msapplication-TileColor" content="#f56a6a">
        <meta name="msapplication-TileImage" content="./assets/icons/ms-icon-144x144.png">
        <meta name="theme-color" content="#f56a6a">
		<link rel="stylesheet" href="./assets/css/main.css">
	</head>
	<body class="is-preload">
			<div id="wrapper">
					<div id="main">
						 <div class="inner">
								<section id="banner">
									<div class="content">
										 <header>
										   <h2>Anmeldewebseite installieren</h2>
                       <p><?php if(isset($msg)) { echo $msg; } ?></p>
										</header>
                    <?php if($show_form = true) { ?>
                    <form method="post">
                      <div class="row gtr-uniform">
                      <div class="col-6 col-12-xsmall">
                      <input type="text" name="database" id="database" value="<?php if(!empty($database)) { echo $database; } ?>" placeholder="* Datenbankname" title="Bitte geben Sie einen gültigen Datenbanknamen einer existierenden Datenbank an." minlenght="2" maxlength="64" required />
                    </div>
                    <div class="col-6 col-12-xsmall">
                      <input type="text" name="username" id="username"  value="<?php if(!empty($username)) { echo $username; } ?>" placeholder="* MySQL-Nutzername" title="Bitte geben Sie einen MySQL-Nutzernamen an, der berechtigt ist auf die oben angegebene Datenbank zuzugreifen." minlenght="2" maxlength="64" required />
                    </div>
                    <div class="col-6 col-12-xsmall">
                      <input type="password" name="password" id="password" placeholder="* MySQL-Passwort" title="Bitte geben Sie das zum MySQL-Nutzernamen zugehörige Passwort an. Dieses sollte aus Sicherheitsgründen mindestens 8 Zeichen entsprechen." minlenght="8" maxlength="64" required />
                    </div>
                    <div class="col-6 col-12-xsmall">
                      <input type="text" name="host" id="host" value="<?php if(!empty($host)) { echo $host; } else { echo 'localhost'; } ?>" placeholder="* MySQL-Hostname/IP" title="Bitte geben Sie den Hostname oder die IP ein, über welche der MySQL-Server erreichbar ist. Sollte dieser, üblicherweise, auf dem gleichen Server laufen, auf dem auch diese Webseite läuft, geben Sie 'localhost' ein." value="localhost" minlenght="2" maxlength="64" required />
                    </div>
                    <div class="col-6 col-12-xsmall">
                      * Mindestgeburtsdatum
                      <input type="date" name="min_birthday" id="min_birthday" value="<?php if(!empty($min_birthday)) { echo $min_birthday; } else { echo '2009-08-01'; } ?>" placeholder="* Mindestgeburtsdatum" minlength="10" maxlength="10" required />
                    </div>
                    <div class="col-6 col-12-xsmall">
                      * Maximalgeburtsdatum
                      <input type="date" name="max_birthday" id="max_birthday" value="<?php if(!empty($max_birthday)) { echo $max_birthday; } else { echo '2014-06-01'; } ?>" placeholder="* Maximalgeburtsdatum" minlength="10" maxlength="10" required />
                    </div>
                    <div class="col-6 col-12-xsmall">
                      * Administrationspasswort
                      <input type="password" name="admin_password" id="admin_password" placeholder="* Administrationspasswort" minlength="8" maxlength="64" required />
                    </div>
                    <div class="col-6 col-12-xsmall">
                      <input type="submit" name="database_form" value="Anmelden">
                    </div>
                  </div>
                    </form>
                    <?php } ?>
									  </div>
								  </section>
                </div>
            </div>
        </div>
    </body>
</html>
