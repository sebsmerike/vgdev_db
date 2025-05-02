<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laragon</title>
    <style>
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        font-weight: 100;
        background-color: #f9f9f9;
        color: #333;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        text-align: center;
    }

    .content {
        max-width: 800px;
        padding: 100px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .title {
        font-size: 60px;
        margin: 0;

    }

    .info {
        margin-top: 20px;
        line-height: 0.2;
    }

    .info a {
        color: #007bff;
        text-decoration: none;
    }

    .info a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .info p{
        
    }

    .info p span{
        font-weight : bold;
        
    }

    .opt {
        margin-top: 30px;
    }

    .opt a {
        color: #007bff;
        font-size: 14px;
        text-decoration: none;
    }

    .opt a:hover {
        color: #0056b3;
        text-decoration: underline;
    }


    button {
        display: flex;
        height: 3em;
        width: 200px;
        align-items: center;
        justify-content: center;
        background-color: #eeeeee4b;
        border-radius: 3px;
        letter-spacing: 1px;
        transition: all 0.2s linear;
        cursor: pointer;
        border: none;
        background: #fff;
        box-shadow: 6px 6px 30px #d1d1d1, -6px -6px 30px #ffffff;
        transform: translateY(-1px);
    }

    
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <h1 class="title" title="Laragon">Login</h1>

<?php

if( !empty($_POST['username']) )
{
  $u_user = $_POST['username'];
  $p_user = $_POST['password'];

// Conexión a la DB

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proj";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT *, CONCAT(name, ' ' , lastname) as nombrecompleto FROM user WHERE username = '$u_user' AND password = '$p_user' ;";
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
  // user sí existe
  //while($row = $result->fetch_assoc()) {
  $row = $result->fetch_assoc()
?>
    <div class="info">
                <p>Bienvenid@ <span><?php echo $row["username"]; ?></span></p><br/>
                <p>Nombre completo:<span><?php echo $row["nombrecompleto"]; ?></span></p><br/>
            </div><br/>
<?php
  //}
} else 
{
  echo "Usuario y/o contraseña incorrecta";
}
$conn->close();
}
else
{
  // mostrar página sin sesión
?>
  <form action="" method="POST">
    <label for="username">username:</label>
    <input type="text" name="username" id="username" />
    <br /><br />
    <label for="password">password:</label>
    <input type="password" name="password" id="password" />
    <br /><br />
    <input type="submit" name="submit" id="submit" value="Iniciar Sesión" />
  </form>
<?php
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