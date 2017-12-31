<?php
//Класс отвечающий за выход из административной панели
//The class responsible for logging out of the administrative panel
session_start();
class exites extends Adminer {

	public function get_Content() {
		$_SESSION['user'] = FALSE;
		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<div class='cat2'>Вы покинули панель администратора</a></div>";
		echo "<div class='cat2'><a style='color: #000' href='?options=main'>На главную страницу</a></div>";
		echo "<div class='cat2'><a style='color: #000' href='?options=admin'>На страницу авторизации</a></div>";
		echo "</div>";	
		echo "</div>";
	}

	public function get_Right() {}
}

?>