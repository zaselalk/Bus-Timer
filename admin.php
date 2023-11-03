<?php
   $servername = "localhost";
   $username = "root";
   $password = "root1234";
   $dbname = "bus_routes";

   $conn = mysqli_connect($servername, $username, $password, $dbname,3306);

   if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
   }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <form action="admin.php" method="post">

    <p><b>Add  Bus Details</b></p>
        <label for="">bus_id</label><br>
        <input type="text" id="b_id" name="b_id"><br>

        <label for="">bus_no</label><br>
        <input type="text" id="b_no" name="b_no"><br>

        <label for="">bus_name</label><br>
        <input type="text" id="b_name" name="b_name"><br>

        <label for="">bus_driver</label><br>
        <input type="text" id="b_driver" name="b_driver"><br>

        <input type="submit" value="add" name="submit">  

    </form>
</body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['b_id'])) {
        $bus_id=$_POST['b_id'];
        $bus_no=$_POST['b_no'];
        $b_name=$_POST['b_name'];
        $bus_driver=$_POST['b_driver'];
    }

    $conn= new mysqli("localhost","root","root1234","bus_routes",3306);
    if($conn->connect_error){
        die('connection Failed');
    }else{
        $data=$conn->prepare("insert into buses(id ,bus_no, bus_name, bus_driver)
        values(?, ?, ?, ?) ");

        $data->bind_param("isss",$bus_id ,$bus_no, $b_name, $bus_driver);
        $data->execute();
        echo "registration successfully";
        

    }
}
?>
</html>
