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

<p><b>Add Route</b></p>
    <form action="" method="post">

        <label for="">route_id</label><br>
        <input type="text" id="r_id" name="r_id"><br>

        <label for="">bus_no</label><br>
        <input type="text" id="r_no" name="r_no"><br>

        <label for="">bus_station</label><br>
        <input type="text" id="r_station" name="r_station"><br>

        <label for="">time</label><br>
        <input type="text" id="r_time" name="r_time"><br>

        <input type="submit" value="click" name="submit">   
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['r_id'])) {
            $r_id=$_POST['r_id'];
            $r_no=$_POST['r_no'];
            $r_station=$_POST['r_station'];
            $r_time=$_POST['r_time'];
        }

            $conn= new mysqli("localhost","root","root1234","bus_routes",3306);
            if($conn->connect_error){
                die('connection Failed');
            }else{
                $data=$conn->prepare("insert into bus_route(id ,bus_no, bus_station, time)
                values(?, ?, ?, ?) ");

            $data->bind_param("isss",$r_id ,$r_no, $r_station, $r_time);
            $data->execute();
            echo "registration successfully";
                
           
        }
    }
?>