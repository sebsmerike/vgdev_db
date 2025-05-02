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
        font-weight : bold;
    }

    .info p span{
        font-weight : normal;
        font-style : italic;
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

    #insert{margin-top: 20px;}
    #insert label, input{
      width:40%; display: inline-block;
    }

    
    </style>

    <script>
    function validateForm ()
    {
        if ( document.getElementById('password').value == document.getElementById('password2').value && document.getElementById('password').value != "")
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    </script>
    
</head>

<body>
    <div class="container">
        <div class="content">
            <h1 class="title" title="Laragon">Login</h1>

<?php

if( !empty($_POST['username']) )
{
  $u_user = $_POST['username'];
  $u_pass = $_POST['password'];
  $u_name = $_POST['name'];
  $u_last = $_POST['lastname'];
  $u_mail = $_POST['email'];
  $u_day =  $_POST['birthday'];
  
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

$sql = "Insert into user (username, password, email, name, lastname, birthday) value ('$u_user', '$u_pass', '$u_mail', '$u_name', '$u_last', '$u_day');";
$result = $conn->query($sql);

if ($result === TRUE)
{
  // Sí creo el user
  
?>
    <div class="info">
                <p>Username: <span><?php echo $u_user; ?></span> creado con éxito...</p><br/>
            </div><br/>
<?php
  //}
} else 
{
  echo "Error al crear usuario";
}
$conn->close();
}
else
{
  // mostrar página sin sesión
?>
  <form id="insert" action="" method="POST">
    <label for="username">username:</label>
    <input type="text" name="username" id="username" required="required"/>
    <br /><br />
    <label for="password">password:</label>
    <input type="password" name="password" id="password" required="required"/>
    <br />
    <label for="password2">password:</label>
    <input type="password" name="password2" id="password2" required="required"/>
    <br /><br />
    <label for="email">e-mail:</label>
    <input type="email" name="email" id="email" required="required"/>
    <br /><br />
    <label for="name">name:</label>
    <input type="text" name="name" id="name" required="required"/>
    <br /><br />
    <label for="lastname">lastname:</label>
    <input type="text" name="lastname" id="lastname" required="required"/>
    <br /><br />
    <label for="birthday">birthday:</label>
    <input type="date" name="birthday" id="birthday" required="required"/>
    <br /><br />
    <input type="submit" name="submit" id="submit" value="Regístrate" OnClick="return validateForm()"/>
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