<?php
require 'config/config.php';
// define User name 
$name = $_POST["user-name"];
// define Email 
$email = $_POST["email"];
// define password 
$password = $_POST["password"];
// define repassword 
$repassword = $_POST["repassword"];
// checking password for login 
if ($password === $repassword) {
    $password = sha1($password);
    $query = "insert into tbl_users (name, email, password) values (?,?,?)";
    try {
        $statement = $db->prepare($query);
        // binding 
        $statement->bind_param("sss", $name, $email, $password);
        // executing data 
        $statement->execute();
        // and closing database 
        $statement->close();
        $db->close();
        // routing in done page 
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    header('location: ../Front-End/login-page/index.html');
    // you can use this code for testing 
    // echo 'ok ✅ . your user name and password and email is define on database 👌🏼 .';
} else {
    echo 'passwod not match 🚫 . try agin';
}
