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

if( !empty($_POST['iduser']) ) // cargar la info de la base de datos
{
    $u_id = $_POST['iduser'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proj";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    // revisar si se van a actualizar los datos

    if( !empty($_POST['update']) ) // modificar la DB
    {
        $u_username = $_POST["username"];
        $u_password = $_POST["password"];
        $u_email = $_POST["email"];
        $u_name = $_POST["name"];
        $u_lastname = $_POST["lastname"];
        $u_birthday = $_POST["birthday"];

        $sql = "UPDATE user " .
            " SET username = '$u_username', ".
            " password = '$u_password', ".
            " email = '$u_email', ".
            " name = '$u_name', ".
            " lastname = '$u_lastname', ".
            " birthday = '$u_birthday' ".
            " WHERE idUser = $u_id;";

        echo $sql;
        $result = $conn->query($sql);

        if ($result === TRUE)
        {

        }
        else
        {
            echo "<h3>Data updated</h3>";
        }
    }

    $sql = "SELECT *, CONCAT(name, ' ' , lastname) as nombrecompleto FROM user;";
    $result = $conn->query($sql);
    // output data of each row
    
    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();

  ?>

<div class="info">
    
<form id="update" action="" method="POST">
    <label for="username">username:</label>
    <input type="text" name="username" id="username" required="required" value="<?php echo $u_username; ?>"/>
    <br /><br />
    <label for="password">password:</label>
    <input type="text" name="password" id="password" required="required" value="<?php echo $u_password; ?>"/>
    <br />
    <label for="email">e-mail:</label>
    <input type="email" name="email" id="email" required="required" value="<?php echo $u_email; ?>"/>
    <br /><br />
    <label for="name">name:</label>
    <input type="text" name="name" id="name" required="required" value="<?php echo $row["name"]; ?>"/>
    <br /><br />
    <label for="lastname">lastname:</label>
    <input type="text" name="lastname" id="lastname" required="required" value="<?php echo $row["lastname"]; ?>"/>
    <br /><br />
    <label for="birthday">birthday:</label>
    <input type="date" name="birthday" id="birthday" required="required" value="<?php echo $row["birthday"]; ?>"/>
    <input type="hidden" name="iduser" value="<?php echo $row["idUser"]; ?>" />
    <input type="hidden" name="update" value="now" />
    <br /><br />
    <input type="submit" name="submit" id="submit" value="Actualiza" />
  </form>
</div><br/>

<?php
  //}
    }
    else
    {
        echo "<h2>No data</h2>";
    }
    $conn->close();
    
}

?>
            <div class="opt">
                <p><button><span><a title="" target="" href="">Reset</a></span></button></p>
                <p><button><span><a title="" target="" href="./">Main Menu</a></span></button></p>
            </div>
        </div>
    </div>

    

</body>

</html>