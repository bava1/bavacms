<?php 
//Создаем класс для удаления статей с сайта
//Create a class to delete articles from the site
class delete_category extends Adminer {

	//Переопределяем метод из класса родителя модифицируя его
	//We override the method from the parent class by modifying it
	public function get_Content() {
		if ($_GET['id_text']) {
			$id_category = (int)$_GET['id_text'];
			$query = "DELETE FROM category WHERE id_category='$id_category'";
			if (mysqli_query($this->db, $query)) {
				echo "<div class='content'>
					<div class='main'>
					<img src='images/logo1.png' style='max-width: 320px; box-shadow: none; margin-top: -60px'>
					<div class='cat3'>Категория успешно удалена !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_category'>Вернуться в 
					к редактированию других категорий.</a></div>
					<div class='cat3'><a style='color: #000' href='?options=admin'>Вернуться в 
					административную панель.</a></div></div>
					</div></div>";
				exit();
			} else {
				exit('Не могу удалить данную категорию !!!');
			}
		} else {
			exit('Нет данных для удаления категории !!!');
		}
	}
}

?>