<?php
echo file_get_contents('html/header.html');
echo file_get_contents('html/menu.html');
echo '<div class="customers"></div>'; 
echo '<p id="error" class="text-danger"></p>';
echo file_get_contents('html/footer.html');