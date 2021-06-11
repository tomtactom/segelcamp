<?php
if (!file_exists('./inc/config.inc.php')) {
  die('<span style="font-family: sans-serif;">Bitte nehmen Sie die grundlegenden Einstellungen vor.</span>');
} else {
  require('./inc/config.inc.php');
}

if(isset($_POST['admin_login'])) {
  if(hash('sha256', $salt1.$_POST['password'].$salt2) == $admin_password) {
    setcookie("token", $admin_cookie_hash, time()+(3600*24)); # 24 Stunden
    unset($_POST['password']);
    header('Location: ./admin');
  } else {
    $msg = "Leider ist das Passwort nicht richtig.";
  }
}

if(isset($_GET['logout'])) {
  setcookie("token", "", time()-3600);
  header('Location: /');
}

function send_mail($empfaenger, $betreff, $text) {
  $from = "From: SLS-Jugend <segelcamp@lohheider-see.de>\r\n";
  $from .= "Reply-To: segelcamp@lohheider-see.de\r\n";
  $from .= "Content-Type: text/html\r\n";
  $mail = mail($empfaenger, $betreff, $text, $from);
  return $mail;
}


if(isset($_POST['sendform'])) {
    $name_child = ucfirst(trim($_POST['name_child']));
    setcookie('name_child', $name_child, time() + 60);
    $birthdate = trim($_POST['birthdate']);
    setcookie('birthdate', $birthdate, time() + 60);
    $allergy = trim($_POST['allergy']);
    setcookie('allergy', $allergy, time() + 60);
    $medication = trim($_POST['medication']);
    setcookie('medication', $medication, time() + 60);
    $swimmingbadge = trim($_POST['swimmingbadge']);
    setcookie('swimmingbadge', $swimmingbadge, time() + 60);
    $sailingexperience = trim($_POST['sailingexperience']);
    setcookie('sailingexperience', $sailingexperience, time() + 60);
    $clothingsize = trim($_POST['clothingsize']);
    setcookie('clothingsize', $clothingsize, time() + 60);
    $lifejacket = trim($_POST['lifejacket']);
    setcookie('lifejacket', $lifejacket, time() + 60);
    $firstname_parent1 = ucfirst(trim($_POST['firstname_parent1']));
    setcookie('firstname_parent1', $firstname_parent1, time() + 60);
    $lastname_parent1 = trim($_POST['lastname_parent1']);
    setcookie('lastname_parent1', $lastname_parent1, time() + 60);
    $email_parent1 = strtolower(trim($_POST['email_parent1']));
    setcookie('email_parent1', $email_parent1, time() + 60);
    $mobilenumber_parent1 = trim($_POST['mobilenumber_parent1']);
    setcookie('mobilenumber_parent1', $mobilenumber_parent1, time() + 60);
    $phonenumber_parent1 = trim($_POST['phonenumber_parent1']);
    setcookie('phonenumber_parent1', $phonenumber_parent1, time() + 60);
    $plz_parent1 = trim($_POST['plz_parent1']);
    setcookie('plz_parent1', $plz_parent1, time() + 60);
    $town_parent1 = ucfirst(trim($_POST['town_parent1']));
    setcookie('town_parent1', $town_parent1, time() + 60);
    $street_parent1 = ucfirst(trim($_POST['street_parent1']));
    setcookie('street_parent1', $street_parent1, time() + 60);
    $housenumber_parent1 = strtolower(trim($_POST['housenumber_parent1']));
    setcookie('housenumber_parent1', $housenumber_parent1, time() + 60);
    $firstname_parent2 = ucfirst(trim($_POST['firstname_parent2']));
    setcookie('firstname_parent2', $firstname_parent2, time() + 60);
    $lastname_parent2 = trim($_POST['lastname_parent2']);
    setcookie('lastname_parent2', $lastname_parent2, time() + 60);
    $email_parent2 = strtolower(trim($_POST['email_parent2']));
    setcookie('email_parent2', $email_parent2, time() + 60);
    $mobilenumber_parent2 = trim($_POST['mobilenumber_parent2']);
    setcookie('mobilenumber_parent2', $mobilenumber_parent2, time() + 60);
    $phonenumber_parent2 = trim($_POST['phonenumber_parent2']);
    setcookie('phonenumber_parent2', $phonenumber_parent2, time() + 60);
    $plz_parent2 = trim($_POST['plz_parent2']);
    setcookie('plz_parent2', $plz_parent2, time() + 60);
    $town_parent2 = ucfirst(trim($_POST['town_parent2']));
    setcookie('town_parent2', $town_parent2, time() + 60);
    $street_parent2 = ucfirst(trim($_POST['street_parent2']));
    setcookie('street_parent2', $street_parent2, time() + 60);
    $housenumber_parent2 = strtolower(trim($_POST['housenumber_parent2']));
    setcookie('housenumber_parent2', $housenumber_parent2, time() + 60);
    $other = trim($_POST['other']);
    setcookie('other', $other, time() + 60);
    $disclaimer = trim($_POST['disclaimer']);
    setcookie('disclaimer', $disclaimer, time() + 60);
    $coronasymptoms = trim($_POST['coronasymptoms']);
    setcookie('coronasymptoms', $coronasymptoms, time() + 60);
    $whatsapp = trim($_POST['whatsapp']);
    setcookie('whatsapp', $whatsapp, time() + 60);
    $correctinformation = trim($_POST['correctinformation']);
    setcookie('correctinformation', $correctinformation, time() + 60);
    $publishphotos = trim($_POST['publishphotos']);
    setcookie('publishphotos', $publishphotos, time() + 60);
    if(
      empty($name_child)
      || empty($birthdate)
      || empty($swimmingbadge)
      || empty($sailingexperience)
      || empty($clothingsize)
      || empty($firstname_parent1)
      || empty($lastname_parent1)
      || empty($email_parent1)
      || empty($mobilenumber_parent1)
      || empty($town_parent1)
      || empty($street_parent1)
      || empty($housenumber_parent1)
      || empty($disclaimer)
      || empty($correctinformation)
      || empty($coronasymptoms)
    ) {
      $msg = "Bitte achten Sie darauf alle Pflichtfelder, welche mit einem * gekennzeichnet sind auszuwählen und auszufüllen.";
      $error = true;
    } elseif(
      strlen($name_child) > 32
      || strlen($birthdate) > 10
      || (!empty($allergy) && strlen($allergy) > 255)
      || (!empty($medication) && strlen($medication) > 255)
      || strlen($firstname_parent1) > 32
      || strlen($lastname_parent1) > 32
      || strlen($email_parent1) > 64
      || strlen($mobilenumber_parent1) > 17
      || strlen($phonenumber_parent1) > 17
      || strlen($plz_parent1) > 5
      || strlen($town_parent1) > 32
      || strlen($street_parent1) > 39
      || strlen($housenumber_parent1) > 6
      || (!empty($firstname_parent2) && strlen($firstname_parent2) > 32)
      || (!empty($lastname_parent2) && strlen($lastname_parent2) > 32)
      || (!empty($email_parent2) && strlen($email_parent2) > 64)
      || (!empty($mobilenumber_parent2) && strlen($mobilenumber_parent2) > 17)
      || (!empty($phonenumber_parent2) && strlen($phonenumber_parent2) > 17)
      || (!empty($plz_parent2) && strlen($plz_parent2) > 5)
      || (!empty($town_parent2) && strlen($town_parent2) > 32)
      || (!empty($street_parent2) && strlen($street_parent2) > 39)
      || (!empty($housenumber_parent2) && strlen($housenumber_parent2) > 6)
      || (!empty($other) && strlen($other) > 1024)
    ) {
      $msg = "Bitte achte auf die maximale Anzahl an Zeichen in den einzelnen Ferldern.";
      $error = true;
    } elseif(
      strlen($name_child) < 2
      || strlen($birthdate) < 10
      || (!empty($allergy) && strlen($allergy) < 2)
      || (!empty($medication) && strlen($medication) < 2)
      || strlen($firstname_parent1) < 2
      || strlen($lastname_parent1) < 2
      || strlen($email_parent1) < 8
      || strlen($mobilenumber_parent1) < 8
      || (!empty($phonenumber_parent1) && strlen($phonenumber_parent1) < 8)
      || strlen($plz_parent1) < 5
      || strlen($town_parent1) < 2
      || strlen($street_parent1) < 3
      || (!empty($firstname_parent2) && strlen($firstname_parent2) < 2)
      || (!empty($lastname_parent2) && strlen($lastname_parent2) < 2)
      || (!empty($email_parent2) && strlen($email_parent2) < 8)
      || (!empty($mobilenumber_parent2) && strlen($mobilenumber_parent2) < 8)
      || (!empty($phonenumber_parent2) && strlen($phonenumber_parent2) < 8)
      || (!empty($plz_parent2) && strlen($plz_parent2) < 5)
      || (!empty($town_parent2) && strlen($town_parent2) < 2)
      || (!empty($street_parent2) && strlen($street_parent2) < 3)
      || (!empty($other) && strlen($other) < 3)
    ) {
      $msg = "Bitte achten Sie auf die minimale Anzahl an Zeichen in den einzelnen Ferldern.";
      $error = true;
    } elseif(
      (!empty($firstname_parent2) && empty($email_parent2)) ||
      (!empty($firstname_parent2) && empty($mobilenumber_parent2)) ||
      (!empty($email_parent2) && empty($firstname_parent2)) ||
      (!empty($email_parent2) && empty($mobilenumber_parent2)) ||
      (!empty($mobilenumber_parent2) && empty($firstname_parent2)) ||
      (!empty($lastname_parent2) && empty($firstname_parent2)) ||
      (!empty($phonenumber_parent2) && empty($firstname_parent2)) ||
      (!empty($plz_parent2) && empty($firstname_parent2)) ||
      (!empty($plz_parent2) && empty($town_parent2)) ||
      (!empty($town_parent2) && empty($plz_parent2)) ||
      (!empty($street_parent2) && empty($firstname_parent2)) ||
      (!empty($street_parent2) && empty($housenumber_parent2)) ||
      (!empty($housenumber_parent2) && empty($street_parent2)) ||
      (!empty($plz_parent2) && empty($street_parent2)) ||
      (!empty($plz_parent2) && empty($housenumber_parent2)) ||
      (!empty($town_parent2) && empty($street_parent2)) ||
      (!empty($town_parent2) && empty($housenumber_parent2)) ||
      (!empty($street_parent2) && empty($town_parent2)) ||
      (!empty($housenumber_parent2) && empty($town_parent2)) ||
      (!empty($housenumber_parent2) && empty($plz_parent2)) ||
      (!empty($street_parent2) && empty($plz_parent2)) ||
      (!empty($town_parent2) && empty($firstname_parent2)) ||
      (!empty($housenumber_parent2) && empty($firstname_parent2))
    ) {
      $msg = "Wenn Ihr Kind zwei Elternteile hat müssen alle Daten angegeben werden. Wenn das zweite Elternteil eine andere Adresse hat, muss die vollständige Adresse angegeben werden.";
      $error = true;
    } elseif($email_parent1 == $email_parent2) {
      $msg = "Bitte geben Sie pro Elternteil eine eigene E-Mail-Adresse ein.";
      $error = true;
    } elseif (
      ($mobilenumber_parent1 == $phonenumber_parent1) ||
      (($mobilenumber_parent2 == $phonenumber_parent2) && !empty($mobilenumber_parent2)) ||
      ($mobilenumber_parent1 == $mobilenumber_parent2) ||
      ($mobilenumber_parent1 == $phonenumber_parent2) ||
      (($phonenumber_parent1 == $phonenumber_parent2) && !empty($phonenumber_parent1)) ||
      (($phonenumber_parent1 == $mobilenumber_parent2) && !empty($phonenumber_parent1))
    ) {
      $msg = "Bitte geben Sie keine Telefonnummern doppelt an.";
      $error = true;
    } elseif(!preg_match("/[a-zA-ZÁÀȦÂÄǞǍĂĀÃÅǺǼǢĆĊĈČĎḌḐḒÉÈĖÊËĚĔĒẼE̊ẸǴĠĜǦĞG̃ĢĤḤáàȧâäǟǎăāãåǻǽǣćċĉčďḍḑḓéèėêëěĕēẽe̊ẹǵġĝǧğg̃ģĥḥÍÌİÎÏǏĬĪĨỊĴĶǨĹĻĽĿḼM̂M̄ʼNŃN̂ṄN̈ŇN̄ÑŅṊÓÒȮȰÔÖȪǑŎŌÕȬŐỌǾƠíìiîïǐĭīĩịĵķǩĺļľŀḽm̂m̄ŉńn̂ṅn̈ňn̄ñņṋóòôȯȱöȫǒŏōõȭőọǿơP̄ŔŘŖŚŜṠŠȘṢŤȚṬṰÚÙÛÜǓŬŪŨŰŮỤẂẀŴẄÝỲŶŸȲỸŹŻŽẒǮp̄ŕřŗśŝṡšşṣťțṭṱúùûüǔŭūũűůụẃẁŵẅýỳŷÿȳỹźżžẓǯßœŒçÇ \-]$/", $name_child)) {
      $msg = "Bitte halten Sie sich bei dem Namen des Kindes an die Vorgaben.";
      $error = true;
    } elseif(count(explode('-', $birthdate)) != 3) {
      $msg = "Leider stimmt etwas mit der Formatierung des Geburtsdatum nicht. Schreiben Sie: YYYY-MM-DD";
      $error = true;
    } elseif(
      !is_numeric(explode('-', $birthdate)[0]) || !is_numeric(explode('-', $birthdate)[1]) || !is_numeric(explode('-', $birthdate)[2])) {
      $msg = "Leider stimmt etwas mit der Formatierung des Geburtsdatum nicht. Schreiben Sie: YYYY-MM-DD";
      $error = true;
    } elseif(!checkdate(intval(explode('-', $birthdate)[1]), intval(explode('-', $birthdate)[2]), intval(explode('-', $birthdate)[0]))) {
      $msg = "Leider stimmt etwas mit der Formatierung des Geburtsdatum nicht. Schreiben Sie: YYYY-MM-DD";
      $error = true;
    } elseif(explode('-', $max_birthday)[0] < explode('-', $birthdate)[0]) {
      $msg = "Leider ist das Kind schon zu alt für dieses Segelcamp.";
      $error = true;
  	} elseif((explode('-', $max_birthday)[0] == explode('-', $birthdate)[0]) && (explode('-', $max_birthday)[1] < explode('-', $birthdate)[1])) {
      $msg = "Leider ist das Kind schon zu alt für dieses Segelcamp.";
      $error = true;
  	} elseif((explode('-', $max_birthday)[1] == explode('-', $birthdate)[1]) && (explode('-', $max_birthday)[2] < explode('-', $birthdate)[2])) {
      $msg = "Leider ist das Kind schon zu alt für dieses Segelcamp.";
      $error = true;
  	} elseif(explode('-', $min_birthday)[0] > explode('-', $birthdate)[0]) {
  		$msg = 'Leider ist das Kind noch zu jung für dieses Segelcamp.';
      $error = true;
  	} elseif((explode('-', $min_birthday)[0] == explode('-', $birthdate)[0]) && (explode('-', $min_birthday)[1] > explode('-', $birthdate)[1])) {
  		$msg = 'Leider ist das Kind noch zu jung für dieses Segelcamp.';
      $error = true;
  	} elseif((explode('-', $min_birthday)[1] == explode('-', $birthdate)[1]) && (explode('-', $min_birthday)[2] > explode('-', $birthdate)[2])) {
  		$msg = 'Leider ist das Kind noch zu jung für dieses Segelcamp.';
      $error = true;
  	} elseif($swimmingbadge != "1" && $swimmingbadge != "2" && $swimmingbadge != "3" && $swimmingbadge != "4") {
      $msg = 'Bitte wählen Sie ein gültiges Schwimmabzeichen des Kindes aus.';
      $error = true;
    } elseif($sailingexperience != "1" && $sailingexperience != "2" && $sailingexperience != "3" && $sailingexperience != "4" && $sailingexperience != "5" && $sailingexperience != "6") {
      $msg = 'Bitte wählen Sie die Segelerfahrung des Kindes aus.';
      $error = true;
    } elseif($clothingsize != "1" && $clothingsize != "2" && $clothingsize != "3" && $clothingsize != "4" && $clothingsize != "5" && $clothingsize != "6" && $clothingsize != "7" && $clothingsize != "8") {
      $msg = 'Bitte wählen Sie die T-Shirt Größe des Kindes aus.';
      $error = true;
    } elseif(!empty($lifejacket) && $lifejacket != "1") {
      $msg = 'Etwas scheint mit dem Auswahlfeld, ob das Kind eine eigene Schwimmweste besitzt, nicht geklappt zu haben.';
      $error = true;
    } elseif(!preg_match("/[a-zA-ZÁÀȦÂÄǞǍĂĀÃÅǺǼǢĆĊĈČĎḌḐḒÉÈĖÊËĚĔĒẼE̊ẸǴĠĜǦĞG̃ĢĤḤáàȧâäǟǎăāãåǻǽǣćċĉčďḍḑḓéèėêëěĕēẽe̊ẹǵġĝǧğg̃ģĥḥÍÌİÎÏǏĬĪĨỊĴĶǨĹĻĽĿḼM̂M̄ʼNŃN̂ṄN̈ŇN̄ÑŅṊÓÒȮȰÔÖȪǑŎŌÕȬŐỌǾƠíìiîïǐĭīĩịĵķǩĺļľŀḽm̂m̄ŉńn̂ṅn̈ňn̄ñņṋóòôȯȱöȫǒŏōõȭőọǿơP̄ŔŘŖŚŜṠŠȘṢŤȚṬṰÚÙÛÜǓŬŪŨŰŮỤẂẀŴẄÝỲŶŸȲỸŹŻŽẒǮp̄ŕřŗśŝṡšşṣťțṭṱúùûüǔŭūũűůụẃẁŵẅýỳŷÿȳỹźżžẓǯßœŒçÇ \-]$/", $firstname_parent1)) {
      $msg = 'Bitte halten Sie sich bei dem Vornamen des ersten angegebenen Elternteils an die Vorgaben.';
      $error = true;
    } elseif(!preg_match("/[a-zA-ZÁÀȦÂÄǞǍĂĀÃÅǺǼǢĆĊĈČĎḌḐḒÉÈĖÊËĚĔĒẼE̊ẸǴĠĜǦĞG̃ĢĤḤáàȧâäǟǎăāãåǻǽǣćċĉčďḍḑḓéèėêëěĕēẽe̊ẹǵġĝǧğg̃ģĥḥÍÌİÎÏǏĬĪĨỊĴĶǨĹĻĽĿḼM̂M̄ʼNŃN̂ṄN̈ŇN̄ÑŅṊÓÒȮȰÔÖȪǑŎŌÕȬŐỌǾƠíìiîïǐĭīĩịĵķǩĺļľŀḽm̂m̄ŉńn̂ṅn̈ňn̄ñņṋóòôȯȱöȫǒŏōõȭőọǿơP̄ŔŘŖŚŜṠŠȘṢŤȚṬṰÚÙÛÜǓŬŪŨŰŮỤẂẀŴẄÝỲŶŸȲỸŹŻŽẒǮp̄ŕřŗśŝṡšşṣťțṭṱúùûüǔŭūũűůụẃẁŵẅýỳŷÿȳỹźżžẓǯßœŒçÇ \-]$/", $lastname_parent1)) {
      $msg = 'Bitte halten Sie sich bei dem Nachnamen des ersten angegebenen Elternteils an die Vorgaben.';
      $error = true;
    } elseif(!filter_var($email_parent1, FILTER_VALIDATE_EMAIL)) {
      $msg = 'Es scheint so, als wäre die E-Mail-Adresse des ersten angegebenen Elternteils nicht gültig.';
      $error = true;
    } elseif($mobilenumber_parent1[0] != "0" || !is_numeric(str_replace('/', '', str_replace('-', '', str_replace(' ', '', $mobilenumber_parent1))))) {
      $msg = 'Bitte geben Sie bei dem ersten angegebenen Elternteil eine gültige Handynummer ein.';
      $error = true;
    } elseif(!empty($phonenumber_parent1) && ($phonenumber_parent1[0] != "0" || !is_numeric(str_replace('/', '', str_replace('-', '', str_replace(' ', '', $phonenumber_parent1)))))) {
      $msg = 'Bitte geben Sie bei dem ersten angegebenen Elternteil eine gültige Telefonnummer (Festznetz) ein.';
      $error = true;
    } elseif(!preg_match("/[0-9]$/", $plz_parent1)) {
      $msg = 'Bitte geben Sie bei dem ersten angegebenen Elternteil eine gültige Postleitzahl ein.';
      $error = true;
    } elseif(!preg_match("/[a-zA-ZÁÀȦÂÄǞǍĂĀÃÅǺǼǢĆĊĈČĎḌḐḒÉÈĖÊËĚĔĒẼE̊ẸǴĠĜǦĞG̃ĢĤḤáàȧâäǟǎăāãåǻǽǣćċĉčďḍḑḓéèėêëěĕēẽe̊ẹǵġĝǧğg̃ģĥḥÍÌİÎÏǏĬĪĨỊĴĶǨĹĻĽĿḼM̂M̄ʼNŃN̂ṄN̈ŇN̄ÑŅṊÓÒȮȰÔÖȪǑŎŌÕȬŐỌǾƠíìiîïǐĭīĩịĵķǩĺļľŀḽm̂m̄ŉńn̂ṅn̈ňn̄ñņṋóòôȯȱöȫǒŏōõȭőọǿơP̄ŔŘŖŚŜṠŠȘṢŤȚṬṰÚÙÛÜǓŬŪŨŰŮỤẂẀŴẄÝỲŶŸȲỸŹŻŽẒǮp̄ŕřŗśŝṡšşṣťțṭṱúùûüǔŭūũűůụẃẁŵẅýỳŷÿȳỹźżžẓǯßœŒçÇ \-.]$/", $town_parent1)) {
      $msg = 'Bitte geben Sie bei dem ersten angegebenen Elternteil einen gültigen Ortsnamen ein.';
      $error = true;
    } elseif(!preg_match("/[a-zA-ZÁÀȦÂÄǞǍĂĀÃÅǺǼǢĆĊĈČĎḌḐḒÉÈĖÊËĚĔĒẼE̊ẸǴĠĜǦĞG̃ĢĤḤáàȧâäǟǎăāãåǻǽǣćċĉčďḍḑḓéèėêëěĕēẽe̊ẹǵġĝǧğg̃ģĥḥÍÌİÎÏǏĬĪĨỊĴĶǨĹĻĽĿḼM̂M̄ʼNŃN̂ṄN̈ŇN̄ÑŅṊÓÒȮȰÔÖȪǑŎŌÕȬŐỌǾƠíìiîïǐĭīĩịĵķǩĺļľŀḽm̂m̄ŉńn̂ṅn̈ňn̄ñņṋóòôȯȱöȫǒŏōõȭőọǿơP̄ŔŘŖŚŜṠŠȘṢŤȚṬṰÚÙÛÜǓŬŪŨŰŮỤẂẀŴẄÝỲŶŸȲỸŹŻŽẒǮp̄ŕřŗśŝṡšşṣťțṭṱúùûüǔŭūũűůụẃẁŵẅýỳŷÿȳỹźżžẓǯßœŒçÇ \-.]$/", $street_parent1)) {
      $msg = 'Bitte geben Sie bei dem ersten angegebenen Elternteil einen gültigen Straßennamen ein.';
      $error = true;
    } elseif(!preg_match("/[0-9]+[a-z]|[0-9]*|[0-9]+[ ][a-z]|[0-9]+[A-Z]|[0-9]+[ ][A-Z]$/", $housenumber_parent1)) {
      $msg = 'Bitte geben Sie bei dem ersten angegebenen Elternteil eine gültige Hausnummer ein.';
      $error = true;
    } elseif(!empty($firstname_parent2) && !preg_match("/[a-zA-ZÁÀȦÂÄǞǍĂĀÃÅǺǼǢĆĊĈČĎḌḐḒÉÈĖÊËĚĔĒẼE̊ẸǴĠĜǦĞG̃ĢĤḤáàȧâäǟǎăāãåǻǽǣćċĉčďḍḑḓéèėêëěĕēẽe̊ẹǵġĝǧğg̃ģĥḥÍÌİÎÏǏĬĪĨỊĴĶǨĹĻĽĿḼM̂M̄ʼNŃN̂ṄN̈ŇN̄ÑŅṊÓÒȮȰÔÖȪǑŎŌÕȬŐỌǾƠíìiîïǐĭīĩịĵķǩĺļľŀḽm̂m̄ŉńn̂ṅn̈ňn̄ñņṋóòôȯȱöȫǒŏōõȭőọǿơP̄ŔŘŖŚŜṠŠȘṢŤȚṬṰÚÙÛÜǓŬŪŨŰŮỤẂẀŴẄÝỲŶŸȲỸŹŻŽẒǮp̄ŕřŗśŝṡšşṣťțṭṱúùûüǔŭūũűůụẃẁŵẅýỳŷÿȳỹźżžẓǯßœŒçÇ \-]$/", $firstname_parent2)) {
      $msg = 'Bitte halten Sie sich bei dem Vornamen des zweiten angegebenen Elternteils an die Vorgaben.';
      $error = true;
    } elseif(!empty($lastname_parent2) && !preg_match("/[a-zA-ZÁÀȦÂÄǞǍĂĀÃÅǺǼǢĆĊĈČĎḌḐḒÉÈĖÊËĚĔĒẼE̊ẸǴĠĜǦĞG̃ĢĤḤáàȧâäǟǎăāãåǻǽǣćċĉčďḍḑḓéèėêëěĕēẽe̊ẹǵġĝǧğg̃ģĥḥÍÌİÎÏǏĬĪĨỊĴĶǨĹĻĽĿḼM̂M̄ʼNŃN̂ṄN̈ŇN̄ÑŅṊÓÒȮȰÔÖȪǑŎŌÕȬŐỌǾƠíìiîïǐĭīĩịĵķǩĺļľŀḽm̂m̄ŉńn̂ṅn̈ňn̄ñņṋóòôȯȱöȫǒŏōõȭőọǿơP̄ŔŘŖŚŜṠŠȘṢŤȚṬṰÚÙÛÜǓŬŪŨŰŮỤẂẀŴẄÝỲŶŸȲỸŹŻŽẒǮp̄ŕřŗśŝṡšşṣťțṭṱúùûüǔŭūũűůụẃẁŵẅýỳŷÿȳỹźżžẓǯßœŒçÇ \-]$/", $lastname_parent2)) {
      $msg = 'Bitte halten Sie sich bei dem Nachnamen des zweiten angegebenen Elternteils an die Vorgaben.';
      $error = true;
    } elseif(!empty($lastname_parent2) && !filter_var($email_parent2, FILTER_VALIDATE_EMAIL)) {
      $msg = 'Es scheint so, als wäre die E-Mail-Adresse des zweiten angegebenen Elternteils nicht gültig.';
      $error = true;
    } elseif(!empty($mobilenumber_parent2) && ($mobilenumber_parent2[0] != "0" || !is_numeric(str_replace('/', '', str_replace('-', '', str_replace(' ', '', $mobilenumber_parent2)))))) {
      $msg = 'Bitte geben Sie bei dem zweiten angegebenen Elternteil eine gültige Handynummer ein.';
      $error = true;
    } elseif(!empty($phonenumber_parent2) && ($phonenumber_parent2[0] != "0" || !is_numeric(str_replace('/', '', str_replace('-', '', str_replace(' ', '', $phonenumber_parent2)))))) {
      $msg = 'Bitte geben Sie bei dem zweiten angegebenen Elternteil eine gültige Telefonnummer (Festznetz) ein.';
      $error = true;
    } elseif(!empty($plz_parent2) && !preg_match("/[0-9]$/", $plz_parent2)) {
      $msg = 'Bitte geben Sie bei dem zweiten angegebenen Elternteil eine gültige Postleitzahl ein.';
      $error = true;
    } elseif(!empty($town_parent2) && !preg_match("/[a-zA-ZÁÀȦÂÄǞǍĂĀÃÅǺǼǢĆĊĈČĎḌḐḒÉÈĖÊËĚĔĒẼE̊ẸǴĠĜǦĞG̃ĢĤḤáàȧâäǟǎăāãåǻǽǣćċĉčďḍḑḓéèėêëěĕēẽe̊ẹǵġĝǧğg̃ģĥḥÍÌİÎÏǏĬĪĨỊĴĶǨĹĻĽĿḼM̂M̄ʼNŃN̂ṄN̈ŇN̄ÑŅṊÓÒȮȰÔÖȪǑŎŌÕȬŐỌǾƠíìiîïǐĭīĩịĵķǩĺļľŀḽm̂m̄ŉńn̂ṅn̈ňn̄ñņṋóòôȯȱöȫǒŏōõȭőọǿơP̄ŔŘŖŚŜṠŠȘṢŤȚṬṰÚÙÛÜǓŬŪŨŰŮỤẂẀŴẄÝỲŶŸȲỸŹŻŽẒǮp̄ŕřŗśŝṡšşṣťțṭṱúùûüǔŭūũűůụẃẁŵẅýỳŷÿȳỹźżžẓǯßœŒçÇ \-.]$/", $town_parent2)) {
      $msg = 'Bitte geben Sie bei dem zweiten angegebenen Elternteil einen gültigen Ortsnamen ein.';
      $error = true;
    } elseif(!empty($street_parent2) && !preg_match("/[a-zA-ZÁÀȦÂÄǞǍĂĀÃÅǺǼǢĆĊĈČĎḌḐḒÉÈĖÊËĚĔĒẼE̊ẸǴĠĜǦĞG̃ĢĤḤáàȧâäǟǎăāãåǻǽǣćċĉčďḍḑḓéèėêëěĕēẽe̊ẹǵġĝǧğg̃ģĥḥÍÌİÎÏǏĬĪĨỊĴĶǨĹĻĽĿḼM̂M̄ʼNŃN̂ṄN̈ŇN̄ÑŅṊÓÒȮȰÔÖȪǑŎŌÕȬŐỌǾƠíìiîïǐĭīĩịĵķǩĺļľŀḽm̂m̄ŉńn̂ṅn̈ňn̄ñņṋóòôȯȱöȫǒŏōõȭőọǿơP̄ŔŘŖŚŜṠŠȘṢŤȚṬṰÚÙÛÜǓŬŪŨŰŮỤẂẀŴẄÝỲŶŸȲỸŹŻŽẒǮp̄ŕřŗśŝṡšşṣťțṭṱúùûüǔŭūũűůụẃẁŵẅýỳŷÿȳỹźżžẓǯßœŒçÇ \-.]$/", $street_parent2)) {
      $msg = 'Bitte geben Sie bei dem zweiten angegebenen Elternteil einen gültigen Straßennamen ein.';
      $error = true;
    } elseif(!empty($housenumber_parent2) && !preg_match("/[0-9]+[a-z]|[0-9]*|[0-9]+[ ][a-z]|[0-9]+[A-Z]|[0-9]+[ ][A-Z]$/", $housenumber_parent2)) {
      $msg = 'Bitte geben Sie bei dem zweiten angegebenen Elternteil eine gültige Hausnummer ein.';
      $error = true;
    } elseif($disclaimer != "1") {
      $msg = 'Etwas scheint mit dem Auswahlfeld, des Haftungsausschlusses, nicht geklappt zu haben.';
      $error = true;
    } elseif($correctinformation != "1") {
      $msg = 'Etwas scheint mit dem Auswahlfeld, dass Sie bestätigt haben, dass alle Angaben richtig sind, nicht geklappt zu haben.';
      $error = true;
    } elseif($coronasymptoms != "1") {
      $msg = 'Etwas scheint mit dem Auswahlfeld, der Corona-Informationen, nicht geklappt zu haben.';
      $error = true;
    } elseif(!empty($whatsapp) && $whatsapp != "1") {
      $msg = 'Etwas scheint mit dem Auswahlfeld, dass Sie bestätigen in die WhatsApp-Gruppe hinzugefügt zu werden, nicht geklappt zu haben.';
      $error = true;
    } elseif(!empty($publishphotos) && $publishphotos != "1") {
      $msg = 'Etwas scheint mit dem Auswahlfeld, dass Sie bestätigen, dass wir Bilder von Ihrem Kind hochladen dürfen, nicht geklappt zu haben.';
      $error = true;
    }
    $stmt = $pdo->prepare("SELECT * FROM registrations WHERE name_child=?");
    $stmt->execute([htmlspecialchars($name_child)]);
    if($error == true || $stmt->fetch()) {
      $msg = "Es wurde bereits ein Kind mit diesem Namen angemeldet.";
      $error = true;
    } else {
      $name_child = htmlspecialchars($name_child);
      $birthdate = htmlspecialchars($birthdate);
      $allergy = htmlspecialchars($allergy);
      $medication = htmlspecialchars($medication);
      $swimmingbadge = intval($swimmingbadge);
      $sailingexperience = intval($sailingexperience);
      $clothingsize = intval($clothingsize);
      if($lifejacket == "1") {
        $lifejacket = 1;
      } else {
        $lifejacket = 0;
      }
      $firstname_parent1 = htmlspecialchars($firstname_parent1);
      $lastname_parent1 = htmlspecialchars($lastname_parent1);
      $email_parent1 = htmlspecialchars($email_parent1);
      $mobilenumber_parent1 = htmlspecialchars(str_replace('/', '', str_replace('-', '', str_replace(' ', '', $mobilenumber_parent1))));
      $phonenumber_parent1 = htmlspecialchars(str_replace('/', '', str_replace('-', '', str_replace(' ', '', $phonenumber_parent1))));
      $plz_parent1 = htmlspecialchars($plz_parent1);
      $town_parent1 = htmlspecialchars($town_parent1);
      $street_parent1 = htmlspecialchars($street_parent1);
      $housenumber_parent1 = htmlspecialchars(str_replace(' ', '', $housenumber_parent1));
      $firstname_parent2 = htmlspecialchars($firstname_parent2);
      $lastname_parent2 = htmlspecialchars($lastname_parent2);
      $email_parent2 = htmlspecialchars($email_parent2);
      $mobilenumber_parent2 = htmlspecialchars(str_replace('/', '', str_replace('-', '', str_replace(' ', '', $mobilenumber_parent2))));
      $phonenumber_parent2 = htmlspecialchars(str_replace('/', '', str_replace('-', '', str_replace(' ', '', $phonenumber_parent2))));
      $plz_parent2 = htmlspecialchars($plz_parent2);
      $town_parent2 = htmlspecialchars($town_parent2);
      $street_parent2 = htmlspecialchars($street_parent2);
      $housenumber_parent2 = htmlspecialchars(str_replace(' ', '', $housenumber_parent2));
      $other = htmlspecialchars($other);
      if($correctinformation == "1") {
        $correctinformation = 1;
      } else {
        $correctinformation = 0;
      }
      if($disclaimer == "1") {
        $disclaimer = 1;
      } else {
        $disclaimer = 0;
      }
      if($coronasymptoms == "1") {
        $coronasymptoms = 1;
      } else {
        $coronasymptoms = 0;
      }
      if($whatsapp == "1") {
        $whatsapp = 1;
      } else {
        $whatsapp = 0;
      }
      if($publishphotos == "1") {
        $publishphotos = 1;
      } else {
        $publishphotos = 0;
      }
      $user_ip = htmlspecialchars(trim($_SERVER['REMOTE_ADDR']));
      $user_useragent = htmlspecialchars(trim($_SERVER['HTTP_USER_AGENT']));
      $betreff_bestaetigung = "Bestätigung zur Anmeldung von ".$name_child." für das Sommercamp 2021 der SLS";

      if(!empty($firstname_parent2)) {
        if(!empty($housenumber_parent2)) {
          if($housenumber_parent1 != $housenumber_parent2) {
            $adress_parent2_for_mail = $plz_parent2." ".$town_parent2." ".$street_parent2." ".$housenumber_parent2;
          } else {
            $adress_parent2_for_mail = $plz_parent1." ".$town_parent1." ".$street_parent1." ".$housenumber_parent1;
          }
        }
        if(!empty($lastname_parent2)) {
          $lastname_parent2_for_mail = $lastname_parent2;
        } else {
          $lastname_parent2_for_mail = $lastname_parent1;
        }
        if(!empty($phonenumber_parent2)) {
          $phonenumber_parent2_for_mail = $phonenumber_parent2;
        } else {
          $phonenumber_parent2_for_mail = $phonenumber_parent1;
        }

        $data_from_parent2_for_mail = $firstname_parent2." ".$lastname_parent2_for_mail." <br>
        Adresse: ".$adress_parent2_for_mail." <br>
        E-Mail-Adresse: ".$email_parent2."<br>
        Handynummer: ".$mobilenumber_parent2."<br>
        Telefonnummer (Festznetz): ".$phonenumber_parent2_for_mail."<br>";
      } else {
        $data_from_parent2_for_mail = "";
      }

      if($swimmingbadge == 1) {
        $swimmingbadge_for_mail = "Seepferdchen";
      } elseif($swimmingbadge == 2) {
        $swimmingbadge_for_mail = "Bronze";
      } elseif($swimmingbadge == 3) {
        $swimmingbadge_for_mail = "Silber";
      } elseif($swimmingbadge == 4) {
        $swimmingbadge_for_mail = "Gold";
      }

      if($sailingexperience == 1) {
        $sailingexperience_for_mail = "Keine";
      } elseif($sailingexperience == 2) {
        $sailingexperience_for_mail = "Auf Boot mitgefahren";
      } elseif($sailingexperience == 3) {
        $sailingexperience_for_mail = "Schonmal selbst gesegelt";
      } elseif($sailingexperience == 4) {
        $sailingexperience_for_mail = "Kann alleine segeln";
      } elseif($sailingexperience == 5) {
        $sailingexperience_for_mail = "Kann gut alleine segeln";
      } elseif($sailingexperience == 6) {
        $sailingexperience_for_mail = "Fortgeschritten";
      }

      if($clothingsize == 1) {
        $clothingsize_for_mail = "122";
      } elseif($clothingsize == 2) {
        $clothingsize_for_mail = "128";
      } elseif($clothingsize == 3) {
        $clothingsize_for_mail = "134";
      } elseif($clothingsize == 4) {
        $clothingsize_for_mail = "140";
      } elseif($clothingsize == 5) {
        $clothingsize_for_mail = "152";
      } elseif($clothingsize == 6) {
        $clothingsize_for_mail = "158";
      } elseif($clothingsize == 7) {
       $clothingsize_for_mail = "164";
     } elseif($clothingsize == 8) {
       $clothingsize_for_mail = "170";
     }

     if($lifejacket == 1) {
       $lifejacket_for_mail = "Ihr Kind besitzt eine eigene Schwimmwese, welche am Anfang der Woche mitgebracht wird und dann die Woche über am Verein bleibt.";
     } else {
       $lifejacket_for_mail = "Ihr Kind besitzt keine eigene Schwimmweste. Diese wird vom Verein für die Woche zur Verfügung gestellt.";
     }

     if($whatsapp == 1) {
       $whatsapp_for_mail = "Sie sind damit einverstanden, dass die oben angegebenen Telefonnummern und vollen Namen in eine WhatsApp-Gruppe hinzugefügt werden und die Kommunikation, auch über personenbezogene Daten, per WhatsApp stattfinden darf. Sie erklären sich damit einverstanden die geteilten personenbezogenen Daten der anderen nicht weiterzugeben. Die WhatsApp-Gruppe nutzen wir um alle Eltern und Erziehungsberechtigten auf dem Laufenden zu halten. Da die Einwilligung freiwillig ist, können Sie diese jederzeit widerrufen, indem Sie die WhatsApp-Gruppe verlassen.";
     } else {
       $whatsapp_for_mail = "Sie sind nicht damit einverstanden in die WhatsApp-Gruppe hinzugefügt zu werden. Wir werden Sie nur per E-Mail kontaktieren. Die anderen teilnehmenden Eltern werden lediglich den Namen Ihres Kindes als personenbezogene Daten mitgeteilt bekommen. Sollten Sie doch zur WhatsApp-Gruppe hinzugefügt werden wollen, schreiben Sie uns dies gerne, dass Sie den Datanschutzbedingungen zustimmen.";
     }

     if($publishphotos == 1) {
       $publishphotos_for_mail = "Sie sind damit einverstanden, dass Fotografien und der Name Ihres Kindes, im Zusammenhang des Segelcamps in der WhatsApp Gruppe mit allen teilnehmenden Eltern, auf der Homepage (und Subhomepages) (<a href='https://lohheider-see.de'>lohheider-see.de</a>) und auf Instagram (<a href='https://www.instagram.com/sls_jugend'>@sls_jugend</a>) veröffentlicht werden dürfen. <i>Diese Einwilligung ist freiwillig und kann jederzeit widerrufen werden. Schreiben Sie dazu eine E-Mail an <a href='mailto:info@lohheider-see.de'>info@lohheider-see.de</a>.</i>";
     } else {
       $publishphotos_for_mail = "Es werden keine Fotografien, auf denen Ihr Kind erkennbar ist und keine weiteren personenbezogenen Daten Ihres Kindes veröffentlicht. Als Ausnahme gilt, der Name in der WhatsApp-Gruppe. Dies ist aus organisatorischen Gründen leider nicht anders möglich.";
     }

      $text_bestaetigung1 = "Hallo ".$firstname_parent1." ".$lastname_parent1.", <br>Es freut uns, dass Ihr Kind ".$name_child." für das Sommercamp bei der Seglergemeinschaft Lohheider See e. V. (47199 Duisburg, Orsoyer Allee 121) angemeldet wurde. Dies ist die Bestätigungs-E-Mail für die Anmeldung. Bitte kontrollieren Sie ob die von Ihnen angegebenen Daten richtig sind:<br>
      <strong>Eltern: </strong><br>
      ".$firstname_parent1." ".$lastname_parent1." <br>
      Adresse: ".$plz_parent1." ".$town_parent1." ".$street_parent1." ".$housenumber_parent1."<br>
      E-Mail-Adresse: ".$email_parent1."<br>
      Handynummer: ".$mobilenumber_parent1."<br>
      Telefonnummer (Festznetz): ".$phonenumber_parent1."<br>
      <br>
      ".$data_from_parent2_for_mail."<br>
      Kind: <br>
      ".$name_child."<br>
      Geburtsdatum: ".$birthdate."<br>
      Allergien / Unverträglichkeiten: ".$allergy."<br>
      Vorerkrankungen / Medikamente: ".$medication."<br>
      Schwimmabzeichen: ".$swimmingbadge_for_mail."<br>
      Segelerfahrung: ".$sailingexperience_for_mail."<br>
      T-Shirt Größe: ".$clothingsize_for_mail."<br>
      ".$lifejacket_for_mail."<br>
      <br>
      Sonstiges: ".$other."<br>
      Sie, oder das andere Elternteil hat den Haftungsausschlusses bestätigt:<br>
      <blockquote>Eine Haftung des Veranstalters, gleich aus welchem Rechtsgrund, für Sach- und Vermögensschäden jeder Art und deren Folgen, die dem Teilnehmer während oder im Zusammenhang mit der Teilnahme an der Veranstaltung durch ein Verhalten des Veranstalters, seiner Vertreter, Erfüllungsgehilfen oder Beauftragten entstehen, ist bei der Verletzung von Pflichten, die nicht Haupt-/bzw. vertragswesentliche Pflichten (Kardinalpflichten) sind, beschränkt auf Schäden, die vorsätzlich oder grob fahrlässig verursacht wurden. Bei der Verletzung von Kardinalpflichten ist die Haftung des Veranstalters in Fällen einfacher Fahrlässigkeit beschränkt auf vorhersehbare, typischerweise eintretende Schäden. Soweit die Schadenersatzhaftung des Veranstalters ausgeschlossen oder eingeschränkt ist, befreit der Teilnehmer von der persönlichen Schadenersatzhaftung auch alle anderen Personen, denen im Zusammenhang mit der Durchführung der Veranstaltung ein Auftrag erteilt worden ist.</blockquote><br>
      Sie oder das andere Elternteil hat bestätigt, dass alle Angaben richtig sind, dem Kind erklärt, dass am, auf und im Wasser Schwimmwestenpflicht besteht und dem Kind die besonderen Coronaschutz Verhaltensregeln erklärt. Diese finden Sie unter <a href='https://www.land.nrw/corona'>land.nrw/corona</a>. Sollten Sie festgestellt haben, dass die Angaben doch nicht richtig sind, teilen Sie uns dies bitte mit, dann können wir diese für Sie anpassen. Dazu können Sie ganz einfach auf diese E-Mail antworten.<br>
      Sie oder das andere Elternteil hat bestätigt, dass wenn Ihr Kind innerhalb 14 Tage vor und/oder während dem Segelcamp Corona-Symptome (Husten, Fieber (37,9+ °C), Schnupfen, Störung des Geruchs- und/oder Geschmackssinns) hat, es nur mit einem negativen <abbr title='Polymerase Chain Reaction Test; deutsch: Polymerasekettenreaktion-Test. Die Richtigkeit liegt bei 99 %.'>PCR-Test</abbr> an dem Camp teilnehmen kann. Gegebenenfalls reicht Situationsbedingt auch ein <abbr title='Point-of-Care-Antigen-Test auf SARS-CoV-2 (Schnelltest; Testergebnis nach weniger als 30 Minuten, jedoch mit einer höheren Falsch-Positiv-Rate)'>PoC-Test</abbr>. Sollte kein PCR-Test/PoC-Test vorliegen oder dieser positiv sein, kann das Geld von unserer Seite leider nicht erstattet werden. Wenn das Segelcamp aufgrund der <abbr title='Coronaschutzverordnung: Verordnung zum Schutz vor Neuinfizierungen mit dem Coronavirus SARS-CoV-2'>CoronaSchVO</abbr> ausfallen muss, wird das Geld erstattet.<br>
      ".$whatsapp_for_mail."<br>
      ".$publishphotos_for_mail."<br>
      <hr>
      Bitte überweisen Sie, nachdem Sie die Anmeldung von uns akzeptiert wurde, <strong>120 €</strong> an:<br>
      Kontoinhaber: SLS Jugendabteilung<br>
      IBAN: DE26 35461106 1200 7900 29<br>
      BIC: GENODED1NRH
      Verwendungszweck: Segelcamp ".$name_child."<br>
      Betrag: 120 €<br>
      <br>
      Das Segelcamp findet vom <strong>26.07.2021 bis zum 30.07.2021, jeweils von 10:00 bis 18:00 Uhr</strong>, statt.
      Leider können wir, aufgrund der Coronaschutz-Situation nur eine begrenzte Anzahl an Teilnehmern annehmen. Aus diesem Grund kann es sein, dass wir die Anmeldung leider nicht annehmen können. Sollte die Anmeldung von ".$name_child." angenommen werden, werden wir Sie umgehend per E-Mail oder WhatsApp kontaktieren.<br>
      Die Kinder sollten, falls vorhanden, Segelsachen, Schwimmsachen, Wechselkleidung und Wetterabhängige Kleidung mitbringen. Sonnencreme, eine Kopfbedeckung und eine Sonnenbrille sind auch empfehlenswert.<br>
      <br>
      Wir freuen uns auf euch,<br>
      Eure Jugend der Seglergemeinschaft Lohheider See e. V.";

      $text_bestaetigung2 = "Hallo ".$firstname_parent1." ".$lastname_parent2_for_mail.", <br>Es freut uns, dass Ihr Kind ".$name_child." für das Sommercamp bei der Seglergemeinschaft Lohheider See e. V. (47199 Duisburg, Orsoyer Allee 121) angemeldet wurde. Dies ist die Bestätigungs-E-Mail für die Anmeldung. Bitte kontrollieren Sie ob die von Ihnen angegebenen Daten richtig sind:<br>
      <strong>Eltern: </strong><br>
      ".$firstname_parent1." ".$lastname_parent1." <br>
      Adresse: ".$plz_parent1." ".$town_parent1." ".$street_parent1." ".$housenumber_parent1."<br>
      E-Mail-Adresse: ".$email_parent1."<br>
      Handynummer: ".$mobilenumber_parent1."<br>
      Telefonnummer (Festznetz): ".$phonenumber_parent1."<br>
      <br>
      ".$data_from_parent2_for_mail."<br>
      Kind: <br>
      ".$name_child."<br>
      Geburtsdatum: ".$birthdate."<br>
      Allergien / Unverträglichkeiten: ".$allergy."<br>
      Vorerkrankungen / Medikamente: ".$medication."<br>
      Schwimmabzeichen: ".$swimmingbadge_for_mail."<br>
      Segelerfahrung: ".$sailingexperience_for_mail."<br>
      T-Shirt Größe: ".$clothingsize_for_mail."<br>
      ".$lifejacket_for_mail."<br>
      <br>
      Sonstiges: ".$other."<br>
      Sie, oder das andere Elternteil hat den Haftungsausschlusses bestätigt:<br>
      <blockquote>Eine Haftung des Veranstalters, gleich aus welchem Rechtsgrund, für Sach- und Vermögensschäden jeder Art und deren Folgen, die dem Teilnehmer während oder im Zusammenhang mit der Teilnahme an der Veranstaltung durch ein Verhalten des Veranstalters, seiner Vertreter, Erfüllungsgehilfen oder Beauftragten entstehen, ist bei der Verletzung von Pflichten, die nicht Haupt-/bzw. vertragswesentliche Pflichten (Kardinalpflichten) sind, beschränkt auf Schäden, die vorsätzlich oder grob fahrlässig verursacht wurden. Bei der Verletzung von Kardinalpflichten ist die Haftung des Veranstalters in Fällen einfacher Fahrlässigkeit beschränkt auf vorhersehbare, typischerweise eintretende Schäden. Soweit die Schadenersatzhaftung des Veranstalters ausgeschlossen oder eingeschränkt ist, befreit der Teilnehmer von der persönlichen Schadenersatzhaftung auch alle anderen Personen, denen im Zusammenhang mit der Durchführung der Veranstaltung ein Auftrag erteilt worden ist.</blockquote><br>
      Sie oder das andere Elternteil hat bestätigt, dass alle Angaben richtig sind, dem Kind erklärt, dass am, auf und im Wasser Schwimmwestenpflicht besteht und dem Kind die besonderen Coronaschutz Verhaltensregeln erklärt. Diese finden Sie unter <a href='https://www.land.nrw/corona'>land.nrw/corona</a>. Sollten Sie festgestellt haben, dass die Angaben doch nicht richtig sind, teilen Sie uns dies bitte mit, dann können wir diese für Sie anpassen. Dazu können Sie ganz einfach auf diese E-Mail antworten.<br>
      Sie oder das andere Elternteil hat bestätigt, dass wenn Ihr Kind innerhalb 14 Tage vor und/oder während dem Segelcamp Corona-Symptome (Husten, Fieber (37,9+ °C), Schnupfen, Störung des Geruchs- und/oder Geschmackssinns) hat, es nur mit einem negativen <abbr title='Polymerase Chain Reaction Test; deutsch: Polymerasekettenreaktion-Test. Die Richtigkeit liegt bei 99 %.'>PCR-Test</abbr> an dem Camp teilnehmen kann. Gegebenenfalls reicht Situationsbedingt auch ein <abbr title='Point-of-Care-Antigen-Test auf SARS-CoV-2 (Schnelltest; Testergebnis nach weniger als 30 Minuten, jedoch mit einer höheren Falsch-Positiv-Rate)'>PoC-Test</abbr>. Sollte kein PCR-Test/PoC-Test vorliegen oder dieser positiv sein, kann das Geld von unserer Seite leider nicht erstattet werden. Wenn das Segelcamp aufgrund der <abbr title='Coronaschutzverordnung: Verordnung zum Schutz vor Neuinfizierungen mit dem Coronavirus SARS-CoV-2'>CoronaSchVO</abbr> ausfallen muss, wird das Geld erstattet.<br>
      ".$whatsapp_for_mail."<br>
      ".$publishphotos_for_mail."<br>
      <hr>
      Bitte überweisen Sie, nachdem Sie die Anmeldung von uns akzeptiert wurde, <strong>120 €</strong> an:<br>
      Kontoinhaber: SLS Jugendabteilung<br>
      IBAN: DE26 35461106 1200 7900 29<br>
      BIC: GENODED1NRH
      Verwendungszweck: Segelcamp ".$name_child."<br>
      Betrag: 120 €<br>
      <br>
      Das Segelcamp findet vom <strong>26.07.2021 bis zum 30.07.2021, jeweils von 10:00 bis 18:00 Uhr</strong>, statt.
      Leider können wir, aufgrund der Coronaschutz-Situation nur eine begrenzte Anzahl an Teilnehmern annehmen. Aus diesem Grund kann es sein, dass wir die Anmeldung leider nicht annehmen können. Sollte die Anmeldung von ".$name_child." angenommen werden, werden wir Sie umgehend per E-Mail oder WhatsApp kontaktieren.<br>
      Die Kinder sollten, falls vorhanden, Segelsachen, Schwimmsachen, Wechselkleidung und Wetterabhängige Kleidung mitbringen. Sonnencreme, eine Kopfbedeckung und eine Sonnenbrille sind auch empfehlenswert.<br>
      <br>
      Wir freuen uns auf euch,<br>
      Eure Jugend der Seglergemeinschaft Lohheider See e. V.";

      $mail1 = send_mail($email_parent1, $betreff_bestaetigung, $text_bestaetigung1);
      if(!empty($email_parent2)) {
        $mail2 = send_mail($email_parent1, $betreff_bestaetigung, $text_bestaetigung2);
      }
      $msg = 'Ihr Kind wurde erfolgreich zum Segelcamp angemeldet. Wir melden und umgehend bei Ihnen.';
      $registered = true;

      $statement = $pdo->prepare("INSERT INTO registrations (
        name_child,
        birthdate,
        allergy,
        medication,
        swimmingbadge,
        sailingexperience,
        clothingsize,
        lifejacket,
        firstname_parent1,
        lastname_parent1,
        email_parent1,
        mobilenumber_parent1,
        phonenumber_parent1,
        plz_parent1,
        town_parent1,
        street_parent1,
        housenumber_parent1,
        firstname_parent2,
        lastname_parent2,
        email_parent2,
        mobilenumber_parent2,
        phonenumber_parent2,
        plz_parent2,
        town_parent2,
        street_parent2,
        housenumber_parent2,
        other,
        correctinformation,
        disclaimer,
        coronasymptoms,
        whatsapp,
        publishphotos,
        user_ip,
        user_useragent
      ) VALUES (
        :name_child,
        :birthdate,
        :allergy,
        :medication,
        :swimmingbadge,
        :sailingexperience,
        :clothingsize,
        :lifejacket,
        :firstname_parent1,
        :lastname_parent1,
        :email_parent1,
        :mobilenumber_parent1,
        :phonenumber_parent1,
        :plz_parent1,
        :town_parent1,
        :street_parent1,
        :housenumber_parent1,
        :firstname_parent2,
        :lastname_parent2,
        :email_parent2,
        :mobilenumber_parent2,
        :phonenumber_parent2,
        :plz_parent2,
        :town_parent2,
        :street_parent2,
        :housenumber_parent2,
        :other,
        :correctinformation,
        :disclaimer,
        :coronasymptoms,
        :whatsapp,
        :publishphotos,
        :user_ip,
        :user_useragent
      )");
	$result = $statement->execute(array(
        'name_child' => $name_child,
        'birthdate' => $birthdate,
        'allergy' => $allergy,
        'medication' => $medication,
        'swimmingbadge' => $swimmingbadge,
        'sailingexperience' => $sailingexperience,
        'clothingsize' => $clothingsize,
        'lifejacket' => $lifejacket,
        'firstname_parent1' => $firstname_parent1,
        'lastname_parent1' => $lastname_parent1,
        'email_parent1' => $email_parent1,
        'mobilenumber_parent1' => $mobilenumber_parent1,
        'phonenumber_parent1' => $phonenumber_parent1,
        'plz_parent1' => $plz_parent1,
        'town_parent1' => $town_parent1,
        'street_parent1' => $street_parent1,
        'housenumber_parent1' => $housenumber_parent1,
        'firstname_parent2' => $firstname_parent2,
        'lastname_parent2' => $lastname_parent2,
        'email_parent2' => $email_parent2,
        'mobilenumber_parent2' => $mobilenumber_parent2,
        'phonenumber_parent2' => $phonenumber_parent2,
        'plz_parent2' => $plz_parent2,
        'town_parent2' => $town_parent2,
        'street_parent2' => $street_parent2,
        'housenumber_parent2' => $housenumber_parent2,
        'other' => $other,
        'correctinformation' => $correctinformation,
        'disclaimer' => $disclaimer,
        'coronasymptoms' => $coronasymptoms,
        'whatsapp' => $whatsapp,
        'publishphotos' => $publishphotos,
        'user_ip' => $user_ip,
        'user_useragent' => $user_useragent
      ));
    }
  }
  if($error == true && !empty($msg)) {
    setcookie('msg', $msg, time() + 60);
    header('Location: /');
  }

  // Admin-Bereich
  if($_COOKIE['token'] == $admin_cookie_hash) {
    echo '<strong>Hallo</strong>';
    if(isset($_POST['update_user'])) {
      echo '<strong>Hallo 2</strong>';
      $statement = $pdo->prepare("UPDATE registrations SET
          name_child = :name_child,
          birthdate = :birthdate,
          allergy = :allergy,
          medication = :medication,
          swimmingbadge = :swimmingbadge,
          sailingexperience = :sailingexperience,
          clothingsize = :clothingsize,
          lifejacket = :lifejacket,
          firstname_parent1 = :firstname_parent1,
          lastname_parent1 = :lastname_parent1,
          email_parent1 = :email_parent1,
          mobilenumber_parent1 = :mobilenumber_parent1,
          phonenumber_parent1 = :phonenumber_parent1,
          plz_parent1 = :plz_parent1,
          town_parent1 = :town_parent1,
          street_parent1 = :street_parent1,
          housenumber_parent1 = :housenumber_parent1,
          firstname_parent2 = :firstname_parent2,
          lastname_parent2 = :lastname_parent2,
          email_parent2 = :email_parent2,
          mobilenumber_parent2 = :mobilenumber_parent2,
          phonenumber_parent2 = :phonenumber_parent2,
          plz_parent2 = :plz_parent2,
          town_parent2 = :town_parent2,
          street_parent2 = :street_parent2,
          housenumber_parent2 = :housenumber_parent2,
          other = :other,
          accepted = :accepted,
          amount_payed = :amount_payed,
          boat_name = :boat_name,
          changed_by_admin = :changed_by_admin
          WHERE id = :id
          ");
        $result = $statement->execute(array(
              'name_child' => htmlspecialchars($_POST['name_child']),
              'birthdate' => htmlspecialchars($_POST['birthdate']),
              'allergy' => htmlspecialchars($_POST['allergy']),
              'medication' => htmlspecialchars($_POST['medication']),
              'swimmingbadge' => intval($_POST['swimmingbadge']),
              'sailingexperience' => intval($_POST['sailingexperience']),
              'clothingsize' => intval($_POST['clothingsize']),
              'lifejacket' => intval($_POST['lifejacket']),
              'firstname_parent1' => htmlspecialchars($_POST['firstname_parent1']),
              'lastname_parent1' => htmlspecialchars($_POST['lastname_parent1']),
              'email_parent1' => htmlspecialchars($_POST['email_parent1']),
              'mobilenumber_parent1' => htmlspecialchars($_POST['mobilenumber_parent1']),
              'phonenumber_parent1' => htmlspecialchars($_POST['phonenumber_parent1']),
              'plz_parent1' => htmlspecialchars($_POST['plz_parent1']),
              'town_parent1' => htmlspecialchars($_POST['town_parent1']),
              'street_parent1' => htmlspecialchars($_POST['street_parent1']),
              'housenumber_parent1' => htmlspecialchars($_POST['housenumber_parent1']),
              'firstname_parent2' => htmlspecialchars($_POST['firstname_parent2']),
              'lastname_parent2' => htmlspecialchars($_POST['lastname_parent2']),
              'email_parent2' => htmlspecialchars($_POST['email_parent2']),
              'mobilenumber_parent2' => htmlspecialchars($_POST['mobilenumber_parent2']),
              'phonenumber_parent2' => htmlspecialchars($_POST['phonenumber_parent2']),
              'plz_parent2' => htmlspecialchars($_POST['plz_parent2']),
              'town_parent2' => htmlspecialchars($_POST['town_parent2']),
              'street_parent2' => htmlspecialchars($_POST['street_parent2']),
              'housenumber_parent2' => htmlspecialchars($_POST['housenumber_parent2']),
              'other' => htmlspecialchars($_POST['other']),
              'accepted' => intval($_POST['accepted']),
              'amount_payed' => htmlspecialchars($_POST['amount_payed']),
              'boat_name' => htmlspecialchars($_POST['boat_name']),
              'changed_by_admin' => htmlspecialchars($_POST['changed_by_admin']),
              'id' => intval($_POST['update_user'])
            ));
            echo '<strong>Hallo_Ende</strong>';
    }
  }



  // Nachricht die in Cookie an die nächste Seite übermittelt wurde in $msg abspeichern
  if(!empty($_COOKIE['msg'])) {
    $msg = trim($_COOKIE['msg']);
    setcookie('msg', '', time() + 60);
  }
if(!isset($registered)) {
  if(!empty($_COOKIE['name_child'])) {
    $name_child = trim($_COOKIE['name_child']);
    setcookie('name_child', '', time() - 3600);
  }
  if(!empty($_COOKIE['birthdate'])) {
    $birthdate = trim($_COOKIE['birthdate']);
    setcookie('birthdate', '', time() - 3600);
  }
  if(!empty($_COOKIE['allergy'])) {
    $allergy = trim($_COOKIE['allergy']);
    setcookie('allergy', '', time() - 3600);
  }
  if(!empty($_COOKIE['medication'])) {
    $medication = trim($_COOKIE['medication']);
    setcookie('medication', '', time() - 3600);
  }
  if(!empty($_COOKIE['swimmingbadge'])) {
    $swimmingbadge = trim($_COOKIE['swimmingbadge']);
    setcookie('swimmingbadge', '', time() - 3600);
  }
  if(!empty($_COOKIE['sailingexperience'])) {
    $sailingexperience = trim($_COOKIE['sailingexperience']);
    setcookie('sailingexperience', '', time() - 3600);
  }
  if(!empty($_COOKIE['clothingsize'])) {
    $clothingsize = trim($_COOKIE['clothingsize']);
    setcookie('clothingsize', '', time() - 3600);
  }
  if(!empty($_COOKIE['lifejacket'])) {
    $lifejacket = trim($_COOKIE['lifejacket']);
    setcookie('lifejacket', '', time() - 3600);
  }
  if(!empty($_COOKIE['firstname_parent1'])) {
    $firstname_parent1 = trim($_COOKIE['firstname_parent1']);
    setcookie('firstname_parent1', '', time() - 3600);
  }
  if(!empty($_COOKIE['lastname_parent1'])) {
    $lastname_parent1 = trim($_COOKIE['lastname_parent1']);
    setcookie('lastname_parent1', '', time() - 3600);
  }
  if(!empty($_COOKIE['email_parent1'])) {
    $email_parent1 = trim($_COOKIE['email_parent1']);
    setcookie('email_parent1', '', time() - 3600);
  }
  if(!empty($_COOKIE['mobilenumber_parent1'])) {
    $mobilenumber_parent1 = trim($_COOKIE['mobilenumber_parent1']);
    setcookie('mobilenumber_parent1', '', time() - 3600);
  }
  if(!empty($_COOKIE['phonenumber_parent1'])) {
    $phonenumber_parent1 = trim($_COOKIE['phonenumber_parent1']);
    setcookie('phonenumber_parent1', '', time() - 3600);
  }
  if(!empty($_COOKIE['plz_parent1'])) {
    $plz_parent1 = trim($_COOKIE['plz_parent1']);
    setcookie('plz_parent1', '', time() - 3600);
  }
  if(!empty($_COOKIE['town_parent1'])) {
    $town_parent1 = trim($_COOKIE['town_parent1']);
    setcookie('town_parent1', '', time() - 3600);
  }
  if(!empty($_COOKIE['street_parent1'])) {
    $street_parent1 = trim($_COOKIE['street_parent1']);
    setcookie('street_parent1', '', time() - 3600);
  }
  if(!empty($_COOKIE['housenumber_parent1'])) {
    $housenumber_parent1 = trim($_COOKIE['housenumber_parent1']);
    setcookie('housenumber_parent1', '', time() - 3600);
  }
  if(!empty($_COOKIE['firstname_parent2'])) {
    $firstname_parent2 = trim($_COOKIE['firstname_parent2']);
    setcookie('firstname_parent2', '', time() - 3600);
  }
  if(!empty($_COOKIE['lastname_parent2'])) {
    $lastname_parent2 = trim($_COOKIE['lastname_parent2']);
    setcookie('lastname_parent2', '', time() - 3600);
  }
  if(!empty($_COOKIE['email_parent2'])) {
    $email_parent2 = trim($_COOKIE['email_parent2']);
    setcookie('email_parent2', '', time() - 3600);
  }
  if(!empty($_COOKIE['mobilenumber_parent2'])) {
    $mobilenumber_parent2 = trim($_COOKIE['mobilenumber_parent2']);
    setcookie('mobilenumber_parent2', '', time() - 3600);
  }
  if(!empty($_COOKIE['phonenumber_parent2'])) {
    $phonenumber_parent2 = trim($_COOKIE['phonenumber_parent2']);
    setcookie('phonenumber_parent2', '', time() - 3600);
  }
  if(!empty($_COOKIE['plz_parent2'])) {
    $plz_parent2 = trim($_COOKIE['plz_parent2']);
    setcookie('plz_parent2', '', time() - 3600);
  }
  if(!empty($_COOKIE['town_parent2'])) {
    $town_parent2 = trim($_COOKIE['town_parent2']);
    setcookie('town_parent2', '', time() - 3600);
  }
  if(!empty($_COOKIE['street_parent2'])) {
    $street_parent2 = trim($_COOKIE['street_parent2']);
    setcookie('street_parent2', '', time() - 3600);
  }
  if(!empty($_COOKIE['housenumber_parent2'])) {
    $housenumber_parent2 = trim($_COOKIE['housenumber_parent2']);
    setcookie('housenumber_parent2', '', time() - 3600);
  }
  if(!empty($_COOKIE['other'])) {
    $other = trim($_COOKIE['other']);
    setcookie('other', '', time() - 3600);
  }
  if(!empty($_COOKIE['disclaimer'])) {
    $disclaimer = trim($_COOKIE['disclaimer']);
    setcookie('disclaimer', '', time() - 3600);
  }
  if(!empty($_COOKIE['coronasymptoms'])) {
    $coronasymptoms = trim($_COOKIE['coronasymptoms']);
    setcookie('coronasymptoms', '', time() - 3600);
  }
  if(!empty($_COOKIE['whatsapp'])) {
    $whatsapp = trim($_COOKIE['whatsapp']);
    setcookie('whatsapp', '', time() - 3600);
  }
  if(!empty($_COOKIE['correctinformation'])) {
    $correctinformation = trim($_COOKIE['correctinformation']);
    setcookie('correctinformation', '', time() - 3600);
  }
  if(!empty($_COOKIE['publishphotos'])) {
    $publishphotos = trim($_COOKIE['publishphotos']);
    setcookie('publishphotos', '', time() - 3600);
  }
}

  if(isset($msg)) {
    $msg_field = '<div class="message"><span onclick="this.parentElement.style.display=\'none\';" style="float: right; cursor: pointer;">×</span> '.trim($msg).'&nbsp;&nbsp;&nbsp;</div>';
  }
?>
