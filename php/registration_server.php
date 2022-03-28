<?php
	/*$db = new mysqli("lab2", "mysql", " ", "formlab2");
	mysqli_select_db($db,"myusers");*/
	$db = mysqli_connect("lab2dmitrash", "mysql", "", "formlab2");
	if(!$db){
		die("error".mysqli_connect_error());
	}

	//проверка на наличие данных
	$name = $_POST['name'];
	if($name==''){
		echo " Ошибка при регистрации - не введено имя. <br>";
		echo "<a href = 'registration.html'> Попробуйте еще раз... </a>";
		exit;
	}

	$surname = $_POST['surname'];
	if($surname==''){
		echo " Ошибка при регистрации - не введена фамилия. <br>";
		echo "<a href = 'registration.html'> Попробуйте еще раз... </a>";
		exit;
	}

	$mail = $_POST['mail'];
	if($mail==''){
		echo " Ошибка при регистрации - не введена почта. <br>";
		echo "<a href = 'registration.html'> Попробуйте еще раз... </a>";
		exit;
	}

	$age = $_POST['age'];
	if($age==''){
		echo " Ошибка при регистрации - не введен возраст. <br>";
		echo "<a href = 'registration.html'> Попробуйте еще раз... </a>";
		exit;
	}

	$sex = $_POST['sex'];
	if($sex==''){
		echo " Ошибка при регистрации - не введен пол. <br>";
		echo "<a href = 'registration.html'> Попробуйте еще раз... </a>";
		exit;
	}

	$date_of_birth = $_POST['date_of_birth'];
	if($date_of_birth==''){
		echo " Ошибка при регистрации - не выбрана дата рождения. <br>";
		echo "<a href = 'registration.html'> Попробуйте еще раз... </a>";
		exit;
	}

	$my_select = $_POST['my_select'];
	
	$nikname = $_POST['nikname'];
	if($nikname==''){
		echo " Ошибка при регистрации - не введен логин. <br>";
		echo "<a href = 'registration.html'> Попробуйте еще раз... </a>";
		exit;
	}

	$people_password = $_POST['password'];
	if($people_password==''){
		echo " Ошибка при регистрации - не введен пароль. <br>";
		echo "<a href = 'registration.html'> Попробуйте еще раз... </a>";
		exit;
	}


	$confirm_password = $_POST['confirm_password'];
	if($confirm_password==''){
		echo " Ошибка при регистрации - не подтвержден пароль. <br>";
		echo "<a href = 'registration.html'> Попробуйте еще раз... </a>";
		exit;
	}

	$comments = $_POST['comments'];

	//проверка на совпадение паролей
	if($people_password != $_POST['confirm_password']){
		echo " Ошибка при регистрации - не совпадают пароли. <br>";
		echo "<a href = 'registration.html'> Попробуйте еще раз... </a>";
		exit;
	}

	//длина пароля, не больше чем
	$pass_len = strlen($_POST["password"]);
	if($pass_len <= 7){
		echo " Ошибка при регистрации - пароль слишком короткий. <br>";
		echo "<a href = 'registration.html'> Попробуйте еще раз... </a>";
		exit;
	}

	//из чего состоит имя
	if(preg_match('/[a-zA-Z]/', $name)){
		echo " Ошибка при регистрации - в имени возможны только русские буквы. <br>";
		echo "<a href = 'registration.html'> Попробуйте еще раз... </a>";
		exit;
	}
	else{
		if(preg_match('/[0-9]/', $name)){
			echo " Ошибка при регистрации - в имени возможны только русские буквы. <br>";
			echo "<a href = 'registration.html'> Попробуйте еще раз... </a>";
			exit;
		}
	}

	//из чего состоит фамилия
	if(preg_match('/[a-zA-Z]/', $surname)){
		echo " Ошибка при регистрации - в фамилии возможны только русские буквы. <br>";
		echo "<a href = 'registration.html'> Попробуйте еще раз... </a>";
		exit;
	}
	else{
		if(preg_match('/[0-9]/', $surname)){
			echo " Ошибка при регистрации - в фамилии возможны только русские буквы. <br>";
			echo "<a href = 'registration.html'> Попробуйте еще раз... </a>";
			exit;
		}
	}

	//проверка пароля, чтоб все было
	if(preg_match('/[А-Я]+/u', $people_password)){//заглавные в русском алфавите
	}
	else{
		if(preg_match('/[A-Z]/', $people_password)){//заглавные в английском
			
		}
		else{
			echo " Ошибка при регистрации - пароль должен содержать заглавные буквы и цифры. <br>";
			echo "<a href = 'registration.html'> Попробуйте еще раз... </a>";
			exit;
		}
	}
	if(preg_match('/[0-9]/', $people_password)){//цифры
			
	}
	else{
		echo " Ошибка при регистрации - пароль должен содержать заглавные буквы и цифры. <br>";
		echo "<a href = 'registration.html'> Попробуйте еще раз... </a>";
		exit;
	}

	//проверка на совпадения логинов doubletwolab2
	$sql = "SELECT nikname from myusers WHERE nikname = '$nikname'";
	$result = mysqli_query($db, $sql);
	if(!$result || mysqli_num_rows($result)==1){
		echo " Такой логин уже существует... <br>";
		echo "<a href = 'registration.html'> Попробуйте еще раз... </a>";
		exit;
	}	

	//
	$people_password = md5($_POST['password']);

	//передача данных на сервер
	$sql = "INSERT INTO myusers (name, surname, mail, age, sex, date_of_birth, my_select, nikname, people_password, comments) VALUES ('$name', '$surname', '$mail', '$age', '$sex', '$date_of_birth', '$my_select', '$nikname', '$people_password', '$comments' )";

	/*$sql = "INSERT INTO doubletwolab2 (name, surname, mail, age, sex, date_of_birth, my_select, nikname, people_password, comments) VALUES ('$name', '$surname', '$mail', '$age', '$sex', '$date_of_birth', '$my_select', '$nikname', '$people_password', '$comments' )";*/


	if(mysqli_query($db, $sql)){
		echo" yes <br>";
	}
	else{
		echo "error".mysqli_error($db);
	}

	//вывод записанных данных на экран
	function name($_Post){
		if(isset($_Post["name"])){
			$text = " Имя : ".htmlspecialchars($_Post["name"]). "<br></b>";
			return $text;
		}
		return "";
	}

	function surname($_Post){
		if(isset($_Post["surname"])){
			$text = " Фамилия : ".htmlspecialchars($_Post["surname"]). "<br></b>";
			return $text;
		}
		return "";
	}

	function age($_Post){
		if(isset($_Post["age"])){
			$text = " Возраст : ".htmlspecialchars($_Post["age"]). "<br></b>";
			return $text;
		}
		return "";
	}

	function sex($_Post){
		if(isset($_Post["sex"])){
			$text = " Пол : ".htmlspecialchars($_Post["sex"]). "<br></b>";
			return $text;
		}
		return "";
	}

	function date_of_birth($_Post){
		if(isset($_Post["date_of_birth"])){
			$text = " Дата рождения : ".htmlspecialchars($_Post["date_of_birth"]). "<br></b>";
			return $text;
		}
		return "";
	}

	function nikname($_Post){
		if(isset($_Post["nikname"])){
			$text = " Логин : ".htmlspecialchars($_Post["nikname"]). "<br></b>";
			return $text;
		}
		return "";
	}
	
	function select($_Post){
		if(isset($_Post["my_select"])){
			$text = " Занятие : ".htmlspecialchars($_Post["my_select"]). "<br></b>";
			return $text;
		}
		return "";
	}

	function comments($_Post){
		if(isset($_Post["comments"])){
			$text = " Комментарий : ".htmlspecialchars($_Post["comments"]). "<br></b>";
			return $text;
		}
		return "";
	}

	echo name($_POST);
	echo surname($_POST);
	echo age($_POST);
	echo sex($_POST);
	echo date_of_birth($_POST);
	echo nikname($_POST);
	echo select($_POST);
	echo comments($_POST);
?>