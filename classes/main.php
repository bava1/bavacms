<?php
//Класс для вывода списка статей на сайт
//Class for displaying a list of articles on the site
class main extends Action {
	//Переопределяем метод из класса родителя модифицируя его
	//We override the method from the parent class by modifying it
	public function get_Content() {
		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<div class='cat2' style='padding: 13px 2%'><p style='font-size: 30px; padding='1% 1% 0'>
		New publications on our website :</p></div>";
		$query = "SELECT id, title, img_src, description, date FROM stati ORDER BY date DESC";//Формируем запрос
		$result = mysqli_query($this->db,$query);
		if (!$result) {
			exit('Could not retrieve articles');
		}
		$row = array();
		//Циклом выводим статьи в виде небольших блоков с названием датой и кратким описанием
		//The cycle displays articles in the form of small blocks with the name of the date and a 
		//brief description
		for ($i=0; $i < mysqli_num_rows($result); $i++) {
			$row = $result->fetch_array(MYSQLI_ASSOC);
			printf("<div class='cat2'><p style='font-size: 24px'>%s</p><br>
				<p style='font-size: 18px'>%s</p><br>
				<img src='%s' style='width: 150px; height: 107px; float: left; margin-right: 20px; 
				margin-bottom: 10px'>
				<p style='font-size: 18px'>%s</p><br>
				<p style='font-size: 18px'><a style='color: #000' href='?options=view&id_text=%s'>
				Read more.....</a></p>
				</div>", $row['title'], $row['date'], $row['img_src'], $row['description'], $row['id']);
		}
		echo "</div>";	
		echo "</div>";
	}

}



?>