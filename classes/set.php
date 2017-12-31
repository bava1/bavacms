<?php
//Создаем класс для основных настроек в административной панели 
//Create a class for the main settings in the administrative panel
class set extends Adminer {

	//метод obr() отвечающий за обработку формы и записи данных в базу. 
	//The method obr () is responsible for processing the form and writing data to the database.
	protected function obr(){
		
		$templ = $_POST['tem'];
		$res = "<div class='content'>
				<div class='main'>
				<img src='images/logo1.png' style='max-width: 320px; box-shadow: none; margin-top: -60px'>
				<div class='cat3'>Новый шаблон установленн !!!</div>
				<div class='cat3'><a style='color: #000' href='?options=set'>Вернуться в 
				к настройкам сайта.</a></div>
				<div class='cat3'><a style='color: #000' href='?options=admin'>Вернуться в 
				административную панель.</a></div>
				</div></div>";

		if ($templ == 'cyber') {
			mysqli_query($this->db, "UPDATE templ SET name_templ='cyber'");	
			echo $res;
			exit;

		}
		if ($templ == 'space') {
			mysqli_query($this->db, "UPDATE templ SET name_templ='space'");	
			echo $res;
			exit;
		}
		if ($templ == 'ofice') {
			mysqli_query($this->db, "UPDATE templ SET name_templ='ofice'");	
			echo $res;
			exit;
		}
		if ($templ == 'flora') {
			mysqli_query($this->db, "UPDATE templ SET name_templ='flora'");	
			echo $res;
			exit;
		}
		if ($templ == 'medik') {
			mysqli_query($this->db, "UPDATE templ SET name_templ='medik'");	
			echo $res;
			exit;
		} 

		$login = strip_tags(mysqli_real_escape_string($this->db, $_POST['login']));
		$password = strip_tags(mysqli_real_escape_string($this->db, $_POST['password']));

		if (!empty($login) AND !empty($password)) {
			$password = md5($password);
			$query = "UPDATE user SET login='$login', password='$password' WHERE id='1'";
			mysqli_query($this->db, $query);
				echo "<div class='content'>
					<div class='main'>
					<div class='cat3'>Ваши данные успешно обновленны !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=set'>Вернуться в 
					к настройкам сайта.</a></div>
					<div class='cat3'><a style='color: #000' href='?options=admin'>Вернуться в 
					административную панель.</a></div>
					</div></div>";
				exit;			
		} else {
				echo "<div class='content'>
					<div class='main'>
					<div class='cat3'>Вы не до конца заполнили форму!!!</div>
					<div class='cat3'><a style='color: #000' href='?options=set'>Вернуться в 
					к настройкам сайта.</a></div>
					<div class='cat3'><a style='color: #000' href='?options=admin'>Вернуться в 
					административную панель.</a></div>
					</div></div>";
				exit;
		}
		
	}


	public function get_Content(){
		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<div class='cat2' style='font-size: 30px'>Список функций сайта доступных для изменения:</div>";
		echo "<div class='cat2' style='font-size: 24px'>1. Выбор шаблона для сайта:</div>";
		print <<<HEREDOC
		<form action="" method="POST">
		<label><img src="images/templ1.jpg" style="width: 220px; margin: 5px">
		<input type="radio" name="tem" value="cyber" style="position: absolute; margin-left: -25px; 
		margin-top: 25px"></label>
		<label><img src="images/templ2.jpg" style="width: 220px; margin: 5px">
		<input type="radio" name="tem" value="space" style="position: absolute; margin-left: -25px; 
		margin-top: 25px"></label>
		<label><img src="images/templ3.jpg" style="width: 220px; margin: 5px">
		<input type="radio" name="tem" value="ofice" style="position: absolute; margin-left: -25px; 
		margin-top: 25px"></label>
		<label><img src="images/templ4.jpg" style="width: 220px; margin: 5px">
		<input type="radio" name="tem" value="flora" style="position: absolute; margin-left: -25px; 
		margin-top: 25px"></label>
		<label><img src="images/templ5.jpg" style="width: 220px; margin: 5px">
		<input type="radio" name="tem" value="medik" style="position: absolute; margin-left: -25px; 
		margin-top: 25px"></label><br>
		<input type="submit" name="button" value="Установить шаблон" style="width: 224px; 
		height: 30px; margin-left: 5px; margin-top: 15px">
		</form>
HEREDOC;
		echo "<div class='cat2' style='font-size: 24px'>2. Изменить логин и пароль для входа в 
		административную панель:</div>";
		print <<<HEREDOC
		<form action="" method="POST">
		<p style="margin-left: 45px; font-size: 24px">Новый логин:</p>
		<input type="text" name="login" style="width: 218px; margin: 6px"><br>
		<p style="margin-left: 45px; font-size: 24px">Новый пароль:</p>
		<input type="text" name="password" style="width: 218px; margin: 6px"><br>
		<input type="submit" name="button" value="Сохранить изменения" style="margin-left: 5px; 
		width: 224px;height: 34px; margin-top: 10px">
		</form>
HEREDOC;
		echo "<div class='cat2' style='font-size: 24px'>Остальные возможности настройки сайта, пока находятся в разработке, и появятся в следующей версии. </div>";
		echo "</div>";
		echo "</div>";

	}


}

?>