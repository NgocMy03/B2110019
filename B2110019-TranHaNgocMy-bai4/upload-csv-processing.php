<?php
    $target_dir = 'uploads/';
    $target_file = $target_dir .basename($_FILES['file']['name']);
    $uploadok = 1;
    $file = strtotime(pathinfo($target_file, PATHINFO_EXTENSION));

    $kieufile = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
    if(isset($_POST["submit"])){
        if(in_array($_FILES["file"]["type"],$kieufile)){
            $uploadok = 1;
        }else{
            $uploadok = 0;
        }
    
    }
    if(file_exists($target_file)){
        echo "File da ton tai ";
        $uploadok = 0;
    }
    if($uploadok == 0){
        echo "Khong the upload file";
    }else{
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)){
            echo "File " .htmlspecialchars(basename($_FILES["file"]["name"])). " upload thanh cong";
            echo "<br>";
            $servername = "localhost";
            $username = "root";
            $pass = "";
            $dbname = "qlbanhang";

            $conn = new mysqli($servername,$username,$pass,$dbname);
            if($conn->connect_error){
                die("Ket noi that bai: " . $conn->connect_error);
            }
            $csv = array();
            $namecsv = $_FILES["file"]["name"];
            $lines = file($namecsv,FILE_IGNORE_NEW_LINES);
            foreach ($lines as $key => $value)
            {
                 $csv[$key] = str_getcsv($value); 
            }
            foreach($csv as $gt){
                $sql = "INSERT INTO customers 
                    VALUES( '".$gt[0]."',  '".$gt[1]."','".$gt[2]."', '".DateTime::createFromFormat('d/m/Y',$gt[3])->format('Y-m-d')."',
                     '".DateTime::createFromFormat('d/m/Y',$gt[4])->format('Y-m-d')."' , '".md5($gt[5])."',  '".$gt[6]."') ";
                $conn->query($sql);
            }
            echo '<pre>';
            print_r($csv);
            echo '</pre>';
        }
    }
?>