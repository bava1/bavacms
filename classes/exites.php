<?php
//Класс отвечающий за выход из административной панели
//The class responsible for logging out of the administrative panel
session_start();
class exites extends Adminer {

	public function get_Content() {
		$_SESSION['user'] = FALSE;
		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<div class='cat2'>You left the admin panel</a></div>";
		echo "<div class='cat2'><a style='color: #000' href='?options=main'>To Home Page</a></div>";
		echo "<div class='cat2'><a style='color: #000' href='?options=admin'>To the authorization page</a></div>";
		echo "</div>";	
		echo "</div>";
	}

	public function get_Right() {}
}

?>