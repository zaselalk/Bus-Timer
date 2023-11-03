<style>
         ul.navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li.navitem {
            float: left;
        }

        li.navitem a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li.navitem a:hover {
            background-color: #888;
        }
    </style>

<ul class="navbar">
        <li class="navitem"><a href="#home">Home</a></li>
        <li class="navitem"><a href="#about">About</a></li>
        <li class="navitem"><a href="#services">Services</a></li>
        <li class="navitem"><a href="#contact">Contact</a></li>
    </ul>

    <P>--------------------------------------------------------------</P>
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
            $bus_id=$_POST['r_no'];
            $bus_no=$_POST['r_station'];
             
           
        }
    }
?>


