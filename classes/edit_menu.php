<?php
//Создаем класс для всех вывода пунктов меню доступных к редактированию
//Create a class for all the output of menu items available for editing
class edit_menu extends Adminer {

	//Переопределяем метод из класса родителя 
	//We override the method from the parent class by modifying it
	public function get_Content() {
		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<div class='cat2' style='font-size: 24px'><a style='color: green' href='?options=add_menu'>
		Добавить новый пункт меню:</a></div>";
		echo "<div class='cat2' style='font-size: 24px'>Список пунктов меню доступных для изменения:</div>";
		$query = "SELECT id_menu, name_menu FROM menu";
		$result = mysqli_query($this->db, $query);
		if (!$result) {
			exit('Не удалось получить в админ статьи');
		}
		//Получаем список пунктов меню для редактирования
		//Get a list of menu items for editing
		$row = array();
		for ($i=0; $i < mysqli_num_rows($result); $i++) {
			$row = $result->fetch_array(MYSQLI_ASSOC);
			printf("<div class='cat2'><p style='font-size: 18px;'><a style='color: green' 
				href='?options=update_menu&id_text=%s'>%s</a>
				<a class='cat4' href='?options=delete_menu&id_text=%s'>| Удалить пункт меню</a>
				</p></div>", $row['id_menu'], $row['name_menu'], $row['id_menu']);
		}
		echo "</div>";	
		echo "</div>";
	}
}

?>