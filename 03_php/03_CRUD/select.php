<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laragon</title>
    <link rel="stylesheet" href="style.css">
    <style>

    </style>

    <script>
    
    </script>
    
</head>

<body>
    <div class="container">
        <div class="content">
            <h1 class="title" title="Laragon">Users</h1>

<?php

$servername = "localhost";
$username = "vgdb";
$password = "password";
$dbname = "proj";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT *, CONCAT(name, ' ' , lastname) as nombrecompleto FROM user";
if (!empty($_POST['search']))
{
    $sql_u = $_POST['search'];
    $sql = $sql . " where username like '%$sql_u%'";
}
else { $sql_u = ""; }
$sql = $sql . ";";

$result = $conn->query($sql);

?>
<div class="info" style="margin-bottom:20px">
    <p style="font-weight : normal;">Puedes realizar una búsqueda por usuario:</p>
    <form action="" method="POST">
        <label for="search">Username</label>
        <input type="input" name="search" placeholder="Buscar username..." />
        <input type="submit" value="Buscar" />
    </form>
</div>
<?php

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
    <div class="info">
                <p>Username: <span><?php echo $row["username"]; ?></span></<br/>
                <p>password: <span><?php echo $row["password"]; ?></span></<br/>
                <p>email:    <span><?php echo $row["email"]; ?></span></<br/>
                <p>name:     <span><?php echo $row["nombrecompleto"]; ?></span></<br/>
                <p>birthday: <span><?php echo $row["birthday"]; ?></span></<br/>
                <form action="delete.php" method="POST" class="btns">
                    <input type="hidden" name="iduser" value="<?php echo $row["idUser"]; ?>" />
                    <input type="submit" value="Borrar" />
                </form>
                <form action="update.php" method="POST" class="btns">
                    <input type="hidden" name="iduser" value="<?php echo $row["idUser"]; ?>" />
                    <input type="submit" value="Actualizar" />
                </form>
            </div><br/><br/>
<?php
  }
} else {
?>
<div class="info">
    <p>No se encontraron Usuarios con ese nombre</p>
</div>
<?php
}
$conn->close();

?>
            <div class="opt">
                <p><button><span><a title="" target="" href="">Reset</a></span></button></p>
                <p><button><span><a title="" target="" href="./">Main Menu</a></span></button></p>
            </div>
        </div>
    </div>

    

</body>

</html>