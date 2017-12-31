<?php
//Создаем класс для вывода всех статей доступных для редактирования
//Create a class for displaying all the articles available for editing
class edit_stati extends Adminer {

	//Переопределяем метод из класса родителя
	//We override the method from the parent class by modifying it 
	public function get_Content() {
		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<div class='cat2'><a style='color: green; font-size: 24px' href='?options=add_stati'>
		Добавить новую статью:</a></div>";
		echo "<div class='cat2' style='font-size: 24px'>Список статей доступных для изменения:</div>";
		$query = "SELECT id, title FROM stati";
		$result = mysqli_query($this->db, $query);
		if (!$result) {
			exit('Не удалось получить в админ статьи');
		}
		//Получаем список статей для редактирования
		//Get the list of articles for editing
		$row = array();
		for ($i=0; $i < mysqli_num_rows($result); $i++) {
			$row = $result->fetch_array(MYSQLI_ASSOC);
			printf("<div class='cat2'><p style='font-size: 18px'><a style='color: green' 
				href='?options=update_stati&id_text=%s'>%s</a> 
				<a class='cat4' href='?options=delete_stati&id_text=%s'> | Удалить</a>
				</p></div>", $row['id'], $row['title'], $row['id']);
		}
		echo "</div>";	
		echo "</div>";
	}
}

?>