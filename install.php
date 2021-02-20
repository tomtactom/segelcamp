<?php
if (isset($_POST['database_form'])) {
  $database = trim($_POST['database']);
  $username = trim($_POST['username']);
  $password = $_POST['password'];
  $host = trim($_POST['host']);
  $min_birthday = trim($_POST['min_birthday']);
  $max_birthday = trim($_POST['max_birthday']);

  // check connection
  $connection = @new mysqli($host, $username, $password, $database);
  if ($connection->connect_errno) {
    $msg = "Es konnte sich leider nicht mit dem MySQL-Server verbunden werden. Bitte überprüfen Sie, ob Ihre Eingaben korrekt waren und versuchen Sie es erneut. (".$connection->connect_errno.") ".$connection->connect_error;
  } else {
    // Informationen in ./inc/config.inc.php schreiben
    file_put_contents('./inc/config.inc.php', '$min_birthday = "'.$min_birthday.'";
$max_birthday = "'.$max_birthday.'";
$db_host = "'.$host.'";
$db_name = "'.$database.'";
$db_user = "'.$username.'";
$db_password = "'.$password.'";
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);');

      $query = '';
      $sqlScript = file('./inc/import.sql');
      foreach ($sqlScript as $line)	{
        $startWith = substr(trim($line), 0 ,2);
        $endWith = substr(trim($line), -1 ,1);
        if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
          continue;
        }
        $query = $query . $line;
        if ($endWith == ';') {
          mysqli_query($connection,$query) or die('Problem beim Ausführen der SQL-Abfrage <b>'.$query.'</b>');
          echo '<pre>'.$query.'</pre>';
        }
      }
      $msg = "Die grundlegenden Einstellungen konnten alle vorgenommen werden.";
    }
  }
?>
<p><?php if(isset($msg)) { echo $msg; } ?></p>
<form method="post">
  <input type="text" name="database" id="database" placeholder="* Datenbankname" title="Bitte geben Sie einen gültigen Datenbanknamen einer existierenden Datenbank an." minlenght="2" maxlength="64" required />
  <input type="text" name="username" id="username" placeholder="* MySQL-Nutzername" title="Bitte geben Sie einen MySQL-Nutzernamen an, der berechtigt ist auf die oben angegebene Datenbank zuzugreifen." minlenght="2" maxlength="64" required />
  <input type="password" name="password" id="password" placeholder="* MySQL-Passwort" title="Bitte geben Sie das zum MySQL-Nutzernamen zugehörige Passwort an. Dieses sollte aus Sicherheitsgründen mindestens 8 Zeichen entsprechen." minlenght="8" maxlength="64" required />
  <input type="text" name="host" id="host" placeholder="* MySQL-Hostname/IP" title="Bitte geben Sie den Hostname oder die IP ein, über welche der MySQL-Server erreichbar ist. Sollte dieser, üblicherweise, auf dem gleichen Server laufen, auf dem auch diese Webseite läuft, geben Sie 'localhost' ein." value="localhost" minlenght="2" maxlength="64" required />
  * Mindestgeburtsdatum
  <input type="date" name="min_birthday" id="min_birthday" value="2009-08-01" placeholder="* Mindestgeburtsdatum" minlength="10" maxlength="10" required />
  * Maximalgeburtsdatum
  <input type="date" name="max_birthday" id="max_birthday" value="2014-06-01" placeholder="* Maximalgeburtsdatum" minlength="10" maxlength="10" required />
  <input type="submit" name="database_form" value="Anmelden">
</form>
