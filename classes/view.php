<?php
//Класс для вывода полного текста статей
//Class for displaying the full text of the articles
class view extends Action {
	//Переопределяем метод из класса родителя модифицируя его
	//We override the method from the parent class by modifying it
	public function get_Content() {
		echo "<div class='content'>";	
		echo "<div class='main'>";
		if (!$_GET['id_text']) {
				echo 'Не правильные данные для вывода статьи';
		} else {
			$id_text = (int)$_GET['id_text'];
			if (!$id_text) {
				echo 'Не правельные данные для вывода статьи';
			} else {
				$query = "SELECT title, img_src, text, date FROM stati WHERE id='$id_text'";
				$result = mysqli_query($this->db,$query);
				if (!$result) {
					exit('Не правильные данные для вывода статьи');
				}
				$row = $result->fetch_array(MYSQLI_ASSOC);
				printf("<div class='cat2'><p style='font-size: 30px'>%s</p><br>
						<p style='font-size: 18px'>%s</p><br>
						<img src='%s' style='width: 288px; float: left; margin-right: 20px; margin-bottom: 15px'>
						<p style='font-size: 18px'>%s</p></div>", 
						$row['title'], $row['date'], $row['img_src'], $row['text']);
			}
		};
		echo "</div>";	
		echo "</div>";
	}
}



?>