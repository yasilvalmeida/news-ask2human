<?php
    require("../mysql.php");
    require("../../classes/country.php");
    $table = $_POST["table"];
    $mysql = new MySQL();
    $connection = $mysql->connect();
    $query = "
            select *
            from tcountry
            order by name;
    ";
    $result = $mysql->query($connection, $query); 
    $num = mysqli_num_rows($result);
    if($num > 0)
    {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $country = new Country($row);
            echo "<tr>";
            echo "<td><input id='id".$i."' type='hidden' value='".$country->getId()."' />".$country->getCode()."</td>";
            echo "<td>".$country->getName()."</td>";
            echo "<td>".($country->getState() == 1 ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>')."</td>";
            echo "<td><a href='javascript:update(".json_encode($country).")' class='btn btn-warning' title='Update'><i class='far fa-edit'></i></a></td>";
            echo "</tr>";
        }
    }
    else
        echo "No records";
?>