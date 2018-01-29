<?php
//Создаем класс для вывода пунктов меню на сайте
//Create a class for displaying menu items on the site
class menu extends Action {
	//Переопределяем метод из класса родителя модифицируя его
	//We override the method from the parent class by modifying it
	public function get_Content() {
		echo "<div class='content'>";	
		echo "<div class='main'>";
		if (!$_GET['id_menu']) {
				echo 'Wrong data for displaying the menu !!!';
		} else {
			$id_menu = (int)$_GET['id_menu'];
			if (!$id_menu) {
				echo 'Wrong data for displaying the menu !!!';
			} else {
				$query = "SELECT id_menu, name_menu, img_src, text_menu FROM menu WHERE id_menu='$id_menu'";
				$result = mysqli_query($this->db, $query);
				if (!$result) {
					exit('Wrong data for displaying the menu !!!');
				}
				$row = $result->fetch_array(MYSQLI_ASSOC);
				printf("<div class='cat2'>
						<p style='font-size: 30px'>%s</p><br>
						<img src='%s' style='width: 288px; float: left; margin-right: 20px; margin-bottom: 9px'>
						<p>%s</p>
						</div>", $row['name_menu'], $row['img_src'], $row['text_menu']);
			}
		}
		echo "</div>";	
		echo "</div>";
	}
}


?>