<?php
include 'db.php';

if (isset($_GET['update_id'])) {
    $id = $_GET['update_id'];

    $sql = "SELECT * FROM tes WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
 else {
  
    echo "Invalid ID";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // $id = $_POST['id']; // hidden input से

    $name = $_POST['name'];
    $desc = $_POST['desc'];

    // फिर से पुराने data लेने की जरूरत नहीं, लेकिन image के लिए लेते हैं
    // $sql = "SELECT * FROM tes WHERE id = $id";
    // $result = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_assoc($result);

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $target = "media/" . basename($image);
        move_uploaded_file($tmp, $target);
    }
     else {
        $image = $row['image'];
    }

    $updateSql = "UPDATE tes SET name='$name', descc='$desc', image='$image' WHERE id=$id";
   $updateresult=mysqli_query($conn,$updateSql);

    if ($updateresult){
        echo "<p style='color: green;'>✅ Updated successfully!</p>";
        // Update $row for showing updated values
     $name=$row['image'];
     $desc=$row['descc'];
    $image=$row['image'];
     
      
    } 
    else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Form</title>
</head>
<body>

<h2>Update Form</h2>

<form method="post" enctype="multipart/form-data">


    <label>Name:</label><br>
    <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>

    <label>Description:</label><br>
    <input type="text" name="desc" value="<?php echo $row['descc']; ?>"><br><br>

    <label>Image:</label><br>
    <input type="file" name="image"><br><br>

    <?php
     if (!empty($row['image'])): ?>
        <img src="media/<?php echo $row['image']; ?>" height="60"><br>
    <?php endif; ?>

    <input type="submit" value="Update">
</form>

</body>
</html>
