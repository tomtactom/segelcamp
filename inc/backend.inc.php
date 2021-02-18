<?php
/*  if(isset($_POST['sendform'])) {
    if(empty($_POST['name_child']) || empty($_POST['birthdate']) || empty($_POST['swimmingbadge']) || empty($_POST['sailingexperience']) || empty($_POST['clothingsize']) || empty($_POST['firstname_parent1']) || empty($_POST['lastname_parent1']) || empty($_POST['email_parent1']) || empty($_POST['mobilenumber_parent1']) || empty($_POST['town_parent1']) || empty($_POST['street_parent1']) || empty($_POST['housenumber_parent1']) || empty($_POST['disclaimer']) || empty($_POST['correctinformation']) || empty($_POST['coronasymptoms'])) {
      $msg = "Bitte achten Sie darauf alle Pflichtfelder, welche mit einem * gekennzeichnet sind auszuwählen und auszufüllen.";
      $error = true;
    } elseif(strlen($_POST['name_child']) > 32 || strlen($_POST['birthdate']) > 10 || (!empty($_POST['allergy']) && strlen($_POST['allergy']) > 255) || (!empty($_POST['medication']) && strlen($_POST['medication']) > 255) || strlen($_POST['firstname_parent1']) > 32 || strlen($_POST['lastname_parent1']) > 32 || strlen($_POST['email_parent1']) > 64 || strlen($_POST['mobilenumber_parent1']) > 17 || strlen($_POST['phonenumber_parent1']) > 17 || strlen($_POST['plz_parent1']) > 5 || strlen($_POST['town_parent1']) > 32 || strlen($_POST['street_parent1']) > 39 || strlen($_POST['housenumber_parent1']) > 6 || strlen($_POST['']) >  || strlen($_POST['']) >  || strlen($_POST['']) >  || strlen($_POST['']) >  || strlen($_POST['']) >  || strlen($_POST['']) >  || strlen($_POST['']) > ) {

    } else {
      // Daten zur Datenbank hinzufügen
    }
  }
  if($error == true && !empty($msg)) {
    setcookie('msg', $msg, time() + 60);
    header('Location: /');
  }
  // Nachricht die in Cookie an die nächste Seite übermittelt wurde in $msg abspeichern
  if(!empty($_COOKIE['msg'])) {
    $msg = trim($_COOKIE['msg']);
    setcookie('msg', '', time() - 3600);
  }
  if(isset($msg)) {
    $msg_field = '<div class="message"><span onclick="this.parentElement.style.display=\'none\';" style="float: right; cursor: pointer;">×</span> '.trim($msg).'&nbsp;&nbsp;&nbsp;</div>';
  }
?>
