<?php
require_once('config/connect.php');
$customerid = $_GET['id'];
$data="";

$sql ="SELECT * FROM vasarlok WHERE id = $customerid";
$result = $connect->query($sql);

if($result->num_rows == 1){
    $row = $result->fetch_array();
    $data .='<div class="container text-light">';
    $data .='<div class="row">';
    $data .='<div class="col-sm-3 text-center">';
    $data .='<img class="img-fluid rounded" src="images/default-profile-picture1.jpg">';
    $data .='<h2 class="text-center">'.$row[1].'</h2>';
    $data .='</div>';
    $data .='<div class="col-sm-3 text-center">';
    $data .='<h4>Személyes adatok:</h4>';
    $data .='<p style="font-style: italic;"><u>E-mail címe:</u></p>';
    $data .='<p>'.$row[3].'</p>';
    $data .='<p style="font-style: italic;"><u>Jelszava:</u></p>';
    $data .='<p>titkositott</p>';
    $data .='</div>';
    $data .='<div class="col-sm-3 text-center">';
    $data .='<h4>Szállítási adatai: </h4>';
    $data .='<p style="font-style: italic;"><u>Alapértelemezett Szállítási cím:</u></p>';
    $data .='<p>'.$row[4].'</p>';
    $data .='<p style="font-style: italic;"><u>Másodlagos szállítási cím:</u></p>';
    $data .= ($row[5] == "")?'<p>Nincs</p>': '<p>'.$row[5].'</p>';
    $data .='</div>';
    $data .='<div class="col-sm-3 text-center">';
    $data .='<h4>Számlázási adatai: </h4>';
    $data .='<p style="font-style: italic;"><u>Alapértelemezett Számlázási cím:</u></p>';
    $data .='<p>'.$row[6].'</p>';
    $data .='<p style="font-style: italic;"><u>Másodlagos szállítási cím:</u></p>';
    $data .= ($row[7] =="")? '<p>Nincs</p>' : '<p>'.$row[7].'</p>';
    $data .='<p style="font-style: italic;"><u>Adószám:</u></p>';
    $data .= ($row[8] =="")? '<p>Nincs</p>' : '<p>'.$row[8].'</p>';
    $data .='</div>';
    $data .='</div>';
    $data .='</div>';
    $data .='<div class="d-flex justify-content-center">';
    $data .='<a href="customerlist.php" class="btn btn-success">Vissza a vásárlók listájához</a>';
    $data .='</div>';
    

}
echo file_get_contents('html/header.html');
echo file_get_contents('html/menu.html');
echo $data;
echo file_get_contents('html/footer.html');