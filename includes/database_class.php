<?php
class Database{
 public static $conn;
 
 public static function getconnection(){
    if (Database::$conn === null){
    $servername = get_config('db_server');
    $username =   get_config('db_username');
    $password =   get_config('db_password');
    $dbname  =    get_config('db_name');

    $connetion = new mysqli($servername, $username, $password, $dbname);
    
    // 🔒 Graceful connection failure
    if ($connetion->connect_error) {
        return "Connection failed: " . $connetion->connect_error;
        print("no");
    }else{
  //      printf("New");
        Database::$conn = $connetion;
        return Database::$conn;
                print("yes");
    }


    }else{
//        printf("exists");
        return Database::$conn;
    }
 }
}
