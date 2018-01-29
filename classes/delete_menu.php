<?php 
//Создаем класс для удаления пунктов меню с сайта
//Create a class to remove menu items from the site
class delete_menu extends Adminer {

	//Переопределяем метод из класса родителя модифицируя его
	//We override the method from the parent class by modifying it
	public function get_Content() {
		if ($_GET['id_text']) {
			$id_menu = (int)$_GET['id_text'];
			$query = "DELETE FROM menu WHERE id_menu='$id_menu'";
			if (mysqli_query($this->db, $query)) {
				echo "<div class='content'>
					<div class='main'>
					<img src='images/logo1.png' style='max-width: 320px; box-shadow: none; margin-top: -60px'>
					<div class='cat3'>Menu item was successfully deleted !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_menu'>Return to editing 
					menu items.</a></div>
					<div class='cat3'><a style='color: #000' href='?options=admin'>Return to the 
					administrative panel.</a></div>
					</div></div>";
				exit();
			} else {
				exit('Can not delete the menu item !!!');
			}
		} else {
			exit('Can not delete the menu item !!!');
		}
	}
}

?>