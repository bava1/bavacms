<?php
//Создаем класс для вывода всех категорий доступных к редактированию
//Create a class for displaying the categories available to edit
class edit_category extends Adminer {


	//Переопределяем метод из класса родителя 
	//We override the method from the parent class by modifying it
	public function get_Content() {
		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<div div class='cat2' style='font-size: 24px'><a style='color: green' href='?options=add_category'>
		Добавить новую категорию:</a></div>";
		echo "<div div class='cat2' style='font-size: 24px'>Список категорий доступных для изменения:</div>";
		$query = "SELECT id_category, name_category FROM category";
		$result = mysqli_query($this->db, $query);
		if (!$result) {
			exit('Не удалось получить в админ статьи');
		}
		//Получаем список статей для редактирования и удаления
		//Get the list of articles for editing and deleting
		$row = array();
		for ($i=0; $i < mysqli_num_rows($result); $i++) {
			$row = $result->fetch_array(MYSQLI_ASSOC);
			printf("<div class='cat2'><p style='font-size: 18px'>ID категории: "."$row[id_category]".
				"<a style='margin-left: 20px; color: green' href='?options=update_category&id_text=%s'>%s</a> 
				<a class='cat4' href='?options=delete_category&id_text=%s'>| Удалить категорию</a>
				</p></div>", $row['id_category'], $row['name_category'], $row['id_category']);
		}

		echo "</div>";	
		echo "</div>";
	}
}

?>