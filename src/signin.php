<?php

    include('config/database.php');

    $email = $_POST['e_mail'];
    $passw = $_POST['p_assw'];

    //&$hashed_password = password_hash($passw, PASSWORD_DEFAULT);
    $hashed_password = $passw;
    
    $sql = "
        SELECT
            u.id,
            COUNT(u.id) as total
        FROM
            users u
        WHERE
            email = '$email' and
            password = '$hashed_password'
        group by
	        id
    ";

    $res = pg_query($conn, $sql);
    if($res){
        $row = pg_fetch_assoc($res);
        if($row['total'] > 0){
            header('Refresh:0; URL=http://localhost/pet-store/src/home.php');
        }else{
            echo "Login failed !!!!";
        }
    }


?>