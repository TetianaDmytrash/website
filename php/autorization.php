<?php
	$nikname = $_POST['nikname'];
	if($nikname==''){
		echo " Ошибка при регистрации - не введен логин. <br>";
		echo "<a href = 'authorization.html'> Попробуйте еще раз... </a>";
		exit;
	}

	$people_password = $_POST['people_password'];
	if($people_password==''){
		echo " Ошибка при регистрации - не введен логин. <br>";
		echo "<a href = 'authorization.html'> Попробуйте еще раз... </a>";
		exit;
	}

	$db = new mysqli("lab2", "mysql", " ", "formlab2");
	mysqli_select_db($db,"myusers");

	$nikname = $_POST['nikname'];
	$password = $_POST['people_password'];

	$sql = "SELECT people_password from myusers WHERE nikname = '$nikname'";
	$result = mysqli_query($db, $sql);

	if(!$result){
		echo " Неправильно введен логин или пароль. <br>";
		exit;
	}
	if(mysqli_num_rows($result)==0){
		echo " Неправильно введен логин или пароль. <br>";
		exit;
	}
	else{
		$res = mysqli_fetch_array($result);
		if($res['password']==$password){
			echo " Авторизация прошла успешно. <br>";
			exit;
		}
		else{
			echo " Неправильно введен логин или пароль. <br>";
		exit;
		}
	}
?>
