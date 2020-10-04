<?php
    require("../mysql.php");
    require("../../classes/category.php");
    $table = $_POST["table"];
    $mysql = new MySQL();
    $connection = $mysql->connect();
    $query = "
            select *
            from tcategory
            order by code;
    ";
    $result = $mysql->query($connection, $query); 
    $num = mysqli_num_rows($result);
    if($num > 0)
    {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $category = new Category($row);
            echo "<tr>";
            echo "<td><input id='id".$i."' type='hidden' value='".$category->getId()."' />".$category->getCode()."</td>";
            echo "<td>".$category->getName()."</td>";
            echo "<td>".($category->getState() == 1 ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>')."</td>";
            echo "<td><a href='javascript:update(".json_encode($category).")' class='btn btn-warning' title='Update'><i class='far fa-edit'></i></a></td>";
            echo "</tr>";
        }
    }
    else
        echo "No records";
?>