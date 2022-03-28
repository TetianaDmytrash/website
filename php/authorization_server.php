<?php
	/*$db = new mysqli("lab2", "mysql", " ", "formlab2");
	mysqli_select_db($db,"myusers");*/
	$db = mysqli_connect("lab2dmitrash", "mysql", "", "formlab2");
	if(!$db){
		die("error".mysqli_connect_error());
	}

	$nikname = $_POST['nikname'];
	if($nikname==''){
		echo " Ошибка при регистрации - не введен логин. <br>";
		echo "<a href = 'authorization.html'> Попробуйте еще раз... </a>";
		exit;
	}

	$password = $_POST['password'];
	if($password==''){
		echo " Ошибка при регистрации - не введен логин. <br>";
		echo "<a href = 'authorization.html'> Попробуйте еще раз... </a>";
		exit;
	}

	$nikname = $_POST['nikname'];
	$password = $_POST['password'];

	//doubletwolab2
	$sql = "SELECT people_password from myusers WHERE nikname = '$nikname'";
	$result = mysqli_query($db, $sql);

	if(!$result){
		echo " Неправильно введен логин или пароль1. <br>";
		exit;
	}
	if(mysqli_num_rows($result)==0){
		echo " Неправильно введен логин или пароль2. <br>";
		exit;
	}
	else{
		$res = mysqli_fetch_array($result);
		$password = md5($_POST['password']);
		if($res['people_password']==$password){
			echo " Авторизация прошла успешно. <br>";
			exit;
		}
		else{
			echo " Неправильно введен логин или пароль3. <br>";
		exit;
		}
	}
?>