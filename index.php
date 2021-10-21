<?php include("conexao.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    pagina inicial
    <?php

        if (!$mysqli) {
            die("Connection failed: " . mysqli_connect_error());
        }
        else
                echo "Connected successfully";

                $sql = "INSERT INTO jogadores(nick, pontuacao, senha) VALUES ('Thom', '123', '123')";
                if (mysqli_query($mysqli, $sql)) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
                }
                mysqli_close($mysqli);


    ?>
</body>
</html>