<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qlbanhang";
// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $pdold = $_POST['pass-old'];
        $pdnew = $_POST['pass-new'];
        $pdenter = $_POST['pass-new1'];

        $id = $_SESSION['id'];
        $sql = "select password from customers where id = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $mk = $row['password'];
            if(md5($pdold) != $mk){
                echo "Mật khẩu cũ không khớp";
                header('Refresh: 3;url=sua_mk.php');
            }else{
                if($pdnew != $pdenter){
                    echo "Mật khẩu mới không khớp";
                    header('Refresh: 3;url=sua_mk.php');
                }else {
                    if($pdnew == $pdold){
                        echo "Mật khẩu mới không được trùng mật khẩu cũ";
                        header('Refresh: 3;url=sua_mk.php');
                    }else{
                        $luu = md5($pdnew);
                        $update = "update customers set password = '$luu' where id = '$id'";
                        if($conn->query($update) == true){
                            echo "Mật khẩu đã được thay đổi";
                            header('Refresh: 3;url=Homepage.php');
                        }
                    }
                } 
            }
        }
    }
?>