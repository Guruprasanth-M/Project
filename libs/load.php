<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'includes/database_class.php';
include_once 'includes/userclass_class.php';
include_once 'includes/usersession_class.php';


global $__site__config;
$__site__config = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/../photogramconfig.json');


function get_config($key,$default = null){
  global $__site__config;
  $array = json_decode($__site__config, true);
  if (isset($array[$key])){
    return $array[$key];
  }else{
    return $default;
  }
}


function load_template($name){
 include $_SERVER['DOCUMENT_ROOT']."/project/_templates/$name.php";
}

