<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include 'db.php';




if(isset($_GET['del_id'])){

    $d=$_GET['del_id'];

    $delsql="DELETE FROM tes where id='$d'";
    $delresult=mysqli_query($conn,$delsql);

    if($delresult)
    {
        $delmes="data deleted";
    }


     
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];

    $desc = $_POST['desc'];

    $image = $_FILES['image']['name'];

    $tmp = $_FILES['image']['tmp_name'];
    $target = "media/" . basename($image);

    if (move_uploaded_file($tmp, $target)) {
        $sql = "INSERT INTO tes (name,descc,image) values('$name','$desc','$image')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('location:index.php?insert=1');
            exit();
        }
    }
}



?>



<?php
if (isset($_GET['insert'])) {
    
}
?>

<?php
if (isset($delmes)) {
    echo "deleted";
}
?>


<head>
    <title>Html Forms</title>
</head>

<body>
    <h2>HTML Forms</h2>
    <form method="post" action="index.php" enctype="multipart/form-data">
        <label for="name">name:</label><br>
        <input type="text" id="name" name="name"><br><br>

        <label for="descriptionn">description</label><br>
        <input type="text" id="desc" name="desc"><br><br>

        <label for="descriptionn">iamge</label><br>
        <input type="file" id="desc" name="image"><br><br>

        <input type="submit" value="Submit">
    </form>

    <h2>submitted records</h2>
    <table>
        <tr>
            <th>name</th>
            <th>descrption</th>
            <th>image</th>
            <th>actions</th>

        </tr>



        <?php
        $selectsql = "SELECT * FROM tes";
        $selectresult = mysqli_query($conn, $selectsql);

        $num = mysqli_num_rows($selectresult);
        if ($num > 0) {
            while ($row = mysqli_fetch_assoc($selectresult)) {
                echo "<tr>
            <td>{$row['name']}</td>
            <td>{$row['descc']}</td>
            <td><img src='media/{$row['image']}'height='60'></td>
        
            <td><button> <a href='index.php?del_id={$row['id']}'>delete </button> </td>
            <td><button> <a href='update.php?update_id={$row['id']}'>update </button> </td>

            </tr>";
            }
        }




        ?>






    </table>



</body>