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
					<div class='cat3'>Пункт меню успешно удаленн !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_menu'>Вернуться в 
					к редактированию пунктов меню.</a></div>
					<div class='cat3'><a style='color: #000' href='?options=admin'>Вернуться в 
					административную панель.</a></div>
					</div></div>";
				exit();
			} else {
				exit('Не могу удалить пункт меню !!!');
			}
		} else {
			exit('Нет данных для удаления пункта меню !!!');
		}
	}
}

?>