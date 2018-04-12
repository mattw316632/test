<?php

/*
 * Copyright 2015 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

// [START index_php]
require_once __DIR__ . '/../vendor/autoload.php';

$host = "localhost";
$database = "test01";
$username = "root";
$password ="";

$conn = new mysqli($host, $username, $passtword, $database);
$json = file_get_contents('php://input');  
 
$obj = json_decode($json,true);
$email= $obj['email'];
$password = $obj['password'];
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "select * from user where email='$email' and password='$password'";
$result = $conn->query($sql);

if($obj['email']!=null){
    if($result->num_rows==0){
        echo json_encode('Wrong Details');
    }
    else{
        echo json_encode('ok');
    }
}
else{
    echo json_encode('try_again');
}
 
$conn->close();
