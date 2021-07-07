<?php
require_once('config/connect.php');
$error="";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $connect -> real_escape_string($_POST['name']);
    $pwd = $connect -> real_escape_string($_POST['pass']);
    $pwdc = $connect -> real_escape_string($_POST['passm']);
    $email = $connect -> real_escape_string($_POST['email']);
    $address = $connect -> real_escape_string($_POST['address']);
    $address2 = $connect -> real_escape_string($_POST['address2']);
    $district = $connect -> real_escape_string($_POST['district']);
    $baddress = $connect -> real_escape_string($_POST['baddress']);
    $baddress2 = $connect -> real_escape_string($_POST['baddress2']);
    $district2 = $connect -> real_escape_string($_POST['district2']);
    $taxnumber = $connect -> real_escape_string($_POST['taxnumber']);
    
    $fulladdress1 = $district;
    $fulladdress1 .= " ";
    $fulladdress1 .= $address;
    
    if($address2 == ""){
        $fulladdress2 = "";
    }
    else{
        $fulladdress2 = $district;
        $fulladdress2 .= " ";
        $fulladdress2 .= $address2;
    }
    
    $fullbaddress1 = $district2;
    $fullbaddress1 .= " ";
    $fullbaddress1 .= $baddress;

    if($baddress2 == ""){
         $fullbaddress2 = "";
    }
    else{
        $fullbaddress2 = $district2;
        $fullbaddress2 .= " ";
        $fullbaddress2 .= $baddress2;
    }
   

  $sql = "INSERT INTO vasarlok (nev, jelszo, email, lakcim1, lakcim2, szcim1, szcim2, adoszam) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

if ($pwd != $pwdc){
    
    $error .= '<h4 class="text-danger text-center">A két jelszó nem egyforma!</h4>';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    
    $error .= ' <h4 class="text-danger text-center">Nem megfelelő formátumú email cím!</h4>';
}
if (!preg_match("/^[a-z-' éáűőúöüóí]*$/i",$name)) {
    $error .= '<h4 class="text-danger text-center">Csak betűk és szókőz használható</h4>';
}
if($taxnumber != ""){
    if (!preg_match("/^(\d{7})(\d)\-([1-5])\-(0[2-9]|[13][0-9]|2[02-9]|4[0-4]|51)$/",$taxnumber)) {
    $error .= '<h4 class="text-danger text-center">Helytelen adószám formátum!</h4>';
} 
} 


if ($error == ""){
    if($stmt = $connect -> prepare($sql)){
        $pwdHash = hash('sha512', $pwd);
        //$pwdHash = password_hash($pwdHash, PASSWORD_DEFAULT);
        $stmt -> bind_param('ssssssss', $name, $pwdHash, $email, $fulladdress1, $fulladdress2, $fullbaddress1, $fullbaddress2, $taxnumber);
        if(!$stmt -> execute()){
            $error = '<h4 class="text-danger text-center">Sikertelen Létrehozás!</h4>';
          } else{
            $error = '<h4 class="text-success text-center">Sikeres Létrehozás!</h4><br><h2 class="text-dark text-center"><a href="customerlist.php">Kattints ide a lista megtekintéséhez!</a></h2>';
    
          }
          $stmt -> close();
    }

}
}
$connect -> close();






echo file_get_contents('html/header.html');
echo file_get_contents('html/menu.html');
echo file_get_contents('html/customeradd.html');
echo $error;
echo file_get_contents('html/footer.html');