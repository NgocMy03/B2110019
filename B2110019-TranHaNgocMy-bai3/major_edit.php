<!DOCTYPE HTML>
<html>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qlsv";
// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $id = $_POST['id'];
    $sql = "select * FROM major WHERE id_major='".$id."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>
<body>
<?php print_r($row)?>
<form action="major_edit_save.php" method="post">
    ID:<input type="text" name="id" value="<?php echo $row['id_major'];?>"><br>
    Name: <input type="text" name="name" value="<?php echo $row['name_major'];?>"><br>
    <input type="submit">
</form>
</body>
</html>