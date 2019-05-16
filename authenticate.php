<?php

/* create new user password
$new_user = password_hash("lionel", PASSWORD_DEFAULT);
die($new_user);
*/

session_start();

include 'dbconfig.php';

    try {
        // test connection to db
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $db = new PDO(DSN, USERNAME, PSWD, $options);

        /*
        $db = new PDO("mysql:host=localhost;dbname=nom_de_la_BDD;charset=utf8", "nom_utilisateur_mysql", "mot_de_passe_mysql", $options);
        */

        // echo "Successfuly connected to database";
    } catch (Exception $error) {
        // throw error if connection failed
        die(`Error connecting to database : $error->get_message()`);
    }

    // if (!isset($_POST['username']) && !isset($_POST['password'])) {
    //     die('Please fill in username and password'); 
    // }

    // check if form was submitted
    if( !isset($_POST['username'], $_POST['password'])) {
        die('Please fill in username and password');
    }

    // store query using placeholder
    $query = "SELECT id, password FROM accounts WHERE username=:username";

    // prepare query
    $stmt = $db->prepare($query);
    // bind param
    $params = array('username' => trim(htmlspecialchars($_POST['username'])));
    // execute query
    $stmt->execute($params);

    // store number of rows returned in variable
    $result = $stmt->fetch();

    // if any row returned, check user password
    if ($result) {
        $id = $result['id'];
        $password = $result['password'];

        // password correct ? create session and redirect to home.php
        if(password_verify($_POST['password'], $password)) {
            session_regenerate_id();
            $_SESSION['logged'] = true;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;

            header('Location: home.php');
        
        // password incorrect ? inform user
        } else {
            echo "Incorrect password";
        }

    // no user found ? inform user
    } else {
        echo 'Incorrect username';
    }

    // close connection to db
    $stmt = null;
    $db = null;
