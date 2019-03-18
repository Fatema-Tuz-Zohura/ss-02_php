<?php 

try{
   $con = new PDO('mysql:dbname=ss_php_02; host =127.0.0.1', 'root', '');

$con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  
}catch(Exception $e){

echo $e->getMessage();

}


//var_dump($connection);


 ?>