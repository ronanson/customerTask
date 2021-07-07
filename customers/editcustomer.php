

<?php
echo file_get_contents('html/header.html');
echo file_get_contents('html/menu.html');

?>
<?php
require_once('config/connect.php');
require_once('config/functions.php');
$error="";
$customerid = $_GET['id'];

$data = "";
$sql = "SELECT * FROM vasarlok WHERE id = $customerid";
$result = $connect->query($sql);
if($result->num_rows == 1){
    $row = $result->fetch_array();
    $district1 = substr($row[4], 0, strpos($row[4], ' '));
    $district2 = substr($row[6], 0, strpos($row[6], ' '));
    
    $data .= '<h1 class="text-light text-center" style="font-size: 35px; margin-top: 20px;">Vásárló adatainak szerkesztése</h1>';
    $data .= '<div class="container">';
    $data .= '<form action="#" method="post" class="row text-light">';
    $data .= '<div class="text-light mx-auto col-lg-6 my-3">';
    $data .= '<div class="form-group" style="margin-top: 10px;" >';
    $data .= '<h2 class="text-light text-center" style="font-size: 25px;">Személyes adatok:</h2>';
    $data .= '</div>';
    $data .= '<div class="form-group">';
    $data .= '<label>Teljes név: </label>';
    $data .= '<input type="text" class="form-control " value="'.$row[1].'" name="name" required>';
    $data .= '</div>';
    $data .= '<div class="form-group">';
    $data .= '<label>Email:</label>';
    $data .= '<input type="email" class="form-control " value="'.$row[3].'" name="email" required>';
    $data .= '</div>';
    $data .= '<div class="form-group">';
    $data .= '<div class="form-group" style="margin-top: 10px;" >';
    $data .= '<h2 class="text-light text-center" style="font-size: 25px;">Szállítási adatok:</h2> ';
    $data .= '</div>';
    $data .= '<div class="form-group">';
    $data .= '<label>Kérjük adja meg az alapértelmezett szállítási címet!(Város, utca, házszám)</label>';
    $data .= '<input type="text" class="form-control " value="'.$row[4].'" name="address" required>';
    $data .= '</div>';
    $data .= '<div class="form-group">';
    $data .= '<label>Kérjük adja meg a másodlagos szállítási címet!(nem kötelező)</label>';
    $data .= '<input type="text" class="form-control " value="'.$row[5].'" name="address2" >';
    $data .= '</div>';
    $data .= '<div class="form-group" style="margin-top: 10px;" >';
    $data .= '<h2 class="text-light text-center" style="font-size: 25px;">Számlázási adatok:</h2> ';
    $data .= '</div>';
    $data .= '<div class="form-group">';
    $data .= '<label>Kérjük adja meg az alapértelmezett számlázási címet!</label>';
    $data .= '<input type="text" class="form-control " value="'.$row[6].'" name="baddress" required>';
    $data .= '</div>';
    $data .= '<div class="form-group">';
    $data .= '<label>Kérjük adja meg a másodlagos számlázási címet!(nem kötelező)</label>';
    $data .= '<input type="text" class="form-control " value="'.$row[7].'" name="baddress2">';
    $data .= '</div>';
    $data .= '<div class="form-group">';
    $data .= '<label>Adószám: (nem kötelező)</label>';
    $data .= '<input type="text" class="form-control " value="'.$row[8].'" name="taxnumber">';
    $data .= '</div>';
    $data .= '<div class="d-flex justify-content-center">';
    $data .= '<button type="submit" class="btn btn-primary " style="margin-top: 70px; width: 400px; height: 50px;">Vásárló módosítása</button>';
    $data .= '</div>';
    $data .= '</div>';
    $data .= '</form>';
    $data .= '</div>';
    

}
echo $data;

?>
<?php
require_once('config/connect.php');
$customerid = $_GET['id'];
$error="";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $connect -> real_escape_string($_POST['name']);
    $email = $connect -> real_escape_string($_POST['email']);
    $address = $connect -> real_escape_string($_POST['address']);
    $address2 = $connect -> real_escape_string($_POST['address2']);
    $baddress = $connect -> real_escape_string($_POST['baddress']);
    $baddress2 = $connect -> real_escape_string($_POST['baddress2']);
    $taxnumber = $connect -> real_escape_string($_POST['taxnumber']);

    $sql = "UPDATE vasarlok SET nev = ?, email = ?, lakcim1 = ?, lakcim2 = ?, szcim1 = ?, szcim2 = ?, adoszam = ? WHERE  id= ?";

    
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
        $stmt -> bind_param('sssssssi', $name, $email, $address, $address2, $baddress, $baddress2, $taxnumber, $customerid);
        if(!$stmt -> execute()){
            $error = '<h4 class="text-danger text-center">Sikertelen módosítás</h4>';
          } else{
            $error = '<h4 class="text-success text-center">Sikeres Módositás!</h4><br><h2 class="text-dark text-center"><a href="customerlist.php">Kattints ide a lista megtekintéséhez!</a></h2>';
    
          }
          $stmt -> close();
    }

}
}
$connect -> close();

echo $error;

echo file_get_contents('html/footer.html');