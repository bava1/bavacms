<?php
//Класс вывода категорий на сайт
//Class output categories to the site
class category extends Action {
	public function get_Content() {
		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<div class='cat2' style='padding: 13px 2%'><p style='font-size: 30px; margin-left: 10px'>
		All articles from this category:</p></div>";
		if (!$_GET['id_category']) {
			echo "Wrong data for the article's output !!!";
		} else {
			$id_cat = (int)$_GET['id_category'];
			if (!$id_cat) {
				echo "Wrong data for the article's output !!!";
			} else {
				$query = "SELECT id, title, img_src, description, date FROM stati WHERE cat='$id_cat' ORDER 
				BY date DESC";
				$result = mysqli_query($this->db,$query);
				if (!$result) {
					exit('Could not retrieve articles');
				}
				if (mysqli_num_rows($result) > 0) {
					$row = array();		
					//Циклом выводим категории в виде небольших блоков с названием датой и кратким описанием
					//The cycle displays categories in the form of small blocks with the name of the date and 
					//a brief description
					for ($i=0; $i < mysqli_num_rows($result); $i++) {
						$row = $result->fetch_array(MYSQLI_ASSOC);
						printf("<div class='cat2'>
							<p style='font-size: 24px'>%s</p><br>
							<p style='font-size: 18px'>%s</p><br>
							<img src='%s' style='width: 150px; float: left; margin-right: 20px; margin-bottom: 10px'>
							<p style='font-size: 18px'>%s</p><br>
							<p style='font-size: 18px; color: red'><a style='color: 
							#000' href='?options=view&id_text=%s'>Read more.....</a></p>
							</div>", $row['title'], $row['date'], $row['img_src'], $row['description'], 
							$row['id']);
					}
				} else {
					echo 'Unfortunately there are no articles in this section yet';
				}
			}
		}
		echo "</div>";	
		echo "</div>";
	}
}




?>