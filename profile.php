<?php
    // start session
    session_start();

    // import db config
    include 'dbconfig.php';

    // check if user is logged in
    if(!isset($_SESSION['logged'])) {
        header('Location: index.html');
        exit();
    }

    // test connection to database
    try {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $db = new PDO(DSN, USERNAME, PSWD, $options);

        // echo "Successfuly connected to database";
    } catch (Exception $error) {
        // throw error if connection failed
        die(`Error connecting to database : $error->get_message()`);
    }
    
    // store query in variable
    $query = "SELECT * FROM accounts WHERE id=:id";
    
    // prepare query
    $stmt = $db->prepare($query);

    // execute query with params
    $params = array('id' => $_SESSION['id']);
    $stmt->execute($params);

    // store result in variable
    $result = $stmt->fetch();

    // store user account details
    $id = $_SESSION['id'];
    $username = $_SESSION['name'];
    $password = $result['password'];
    $email = $result['email'];

    // close connection to db
    $stmt = null;
    $db = null;

?>

    <!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Website Title</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$username?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>

