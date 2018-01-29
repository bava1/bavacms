<?php
error_reporting(0);
session_start();
//Класс отвечающий за авторизацию в административной панели
//The class responsible for authorization in the administrative panel
class login extends Adminer {

	//Метод обрабатывающий данные полученные из формы авторизации
	//Method processing data obtained from the authorization form
	protected function obr() {
		//Принимаем данные из формы и обрабатываем их, проверяя на теги и sql инъекции
		//We accept data from the form and process them, checking for tags and sql injections
		$login = strip_tags(mysqli_real_escape_string($this->db, $_POST['login']));
		$password = strip_tags(mysqli_real_escape_string($this->db, $_POST['password']));
		if (!empty($login) AND !empty($password)) {
			$password = md5($password);//Шифруем пароль в md5//We encrypt the password in md5
			$query = "SELECT id FROM user WHERE login='$login' AND password='$password'";
			$result = mysqli_query($this->db, $query);
			if (!$result) {
				exit('Could not connect to the database !!!.');
			}
			if (mysqli_num_rows($result) == 1) {
				$_SESSION['user'] = TRUE;
				echo "<div class='footer' style='margin-top: -70px; height: 900px'>";	
				echo "<div class='footer-main' style='width: 300px'>";
				echo "<div class='cat3'><a href='?options=admin' style='margin: 20px; color: #000'>
				Log in to the admin panel</a></div>";
				echo "</div>";
				echo "</div>";	
				exit();				
			} else {
				echo "<div class='cat3' style='position: absolute; margin: 60px'>There is no such user. 
				Go away!!!</div>";
			}
		} else {
				echo "<div class='cat3' style='position: absolute; margin: 60px'>You did not enter login 
				or password !!!
				</div>";
		}
	}


	//Переопределяем метод родителя, что бы исключить вывод верхней части сайта
	//We override the parent method to exclude the top of the site
	protected function get_Right(){}

	//Выводим форму для авторизации....
	//We display the form for authorization ....
	public function get_Content() {
		echo "<div class='footer' style='margin-top: -70px; height: 900px'>";	
		echo "<div class='footer-main' style='width: 300px'>";
		echo "<div style='font-size: 24px; margin-top: -200px; text-align: center; color: #fff'>
		Authorization of the administrator :</div>";

		print <<<HEREDOC
			<form action="" method="POST" style="margin: 30px">
				<p style="color: #fff; width: 236px; text-align: center; font-size: 18px;">Enter login :<br>
				<br>
					<input type="text" name="login" style="width: 242px; height: 25px; text-align: center">
				</p><br>		
				<p style="color: #fff; width: 236px; text-align: center; font-size: 18px;">Enter password :<br>
				<br>
					<input type="password" name="password" style="width: 242px; height: 25px; text-align: center">
				</p><br>
				<p><input type='submit' style="width: 250px; height: 40px; margin-top: 20px" name='button' 
				value='Login to the administrative panel'></p>
			</form>
HEREDOC;
		echo "</div>";
		echo "</div>";	
	}
	//Переопределяем метод родителя, что бы исключить вывод нижней части сайта
	//We override the parent method to exclude the bottom of the site
	protected function get_Footer(){}
}

?>