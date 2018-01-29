<?php 
//Создаем класс для удаления статей с сайта
//Create a class to delete articles from the site
class delete_stati extends Adminer {

	//Переопределяем метод из класса родителя модифицируя его
	//We override the method from the parent class by modifying it
	public function get_Content() {
		if ($_GET['id_text']) {
			$id_text = (int)$_GET['id_text'];
			$query = "DELETE FROM stati WHERE id='$id_text'";
			if (mysqli_query($this->db, $query)) {
				echo "<div class='content'>
					<div class='main'>
					<img src='images/logo1.png' style='max-width: 320px; box-shadow: none; margin-top: -60px'>
					<div class='cat3'>The article was successfully deleted !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_stati'>Go back to editing 
					other articles.</a></div>
					<div class='cat3'><a style='color: #000' href='?options=admin'>Return to the 
					administrative panel.</a></div>
					</div></div>";
				exit;
			} else {
				exit('I can not delete the article !!!');
			}
		} else {
			exit('I can not delete the article !!!');
		}
	}
}

?>