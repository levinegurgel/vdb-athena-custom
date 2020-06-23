<?php
	
	require 'Egoi/Factory.php';

  $key    = $_POST['key'];
  $list   = $_POST['list'];
  $double = 1;
  $email  = $_POST['email'];
  $name   = isset($_POST['name']) ? $_POST['name'] : '';   
  
  $arguments = array(
    "apikey" => $key,
    "listID" => $list,
    "status" => $double, //0 double opt-in
    "email"  => $email,
    "first_name" => $name
  );
  
  // $api = EgoiApiFactory::getApi(Protocol::Soap);
  // $api = EgoiApiFactory::getApi(Protocol::Rest);
  $api = EgoiApiFactory::getApi(Protocol::XmlRpc);
  $result = $api->addSubscriber($arguments);

  if(array_key_exists('UID', $result)){
    echo 1;
  }else{
    echo 0;
  }

?>