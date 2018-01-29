<?php
//Создаем класс для добавления пунктов меню на сайт
//Create class for adding menu items to the site
class add_menu extends Adminer {

	//метод obr() отвечающий за обработку формы и записи данных в базу. 
	//The method obr () is responsible for processing the form and writing data to the database.
	protected function obr() {

		//Делаем загрузку изображений да сайт
		if (!empty($_FILES['img_src']['tmp_name'])) {
			if (!move_uploaded_file($_FILES['img_src']['tmp_name'], "images/".$_FILES['img_src']['name'])) {
				exit('Could not load image for article!');//Если ошибка
			}
			$img_src = "images/".$_FILES['img_src']['name'];
		} else {
				echo "<div class='content'>
					<div class='main'>
					<img src='images/logo1.png' style='max-width: 320px; box-shadow: none; margin-top: -60px'>
					<div class='cat3'>You must specify an image !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_menu'>Return to editing 
					menu items.</a></div>
					</div></div>";
				exit;		
		}

		$title = strip_tags(mysqli_real_escape_string($this->db, $_POST['title']));
		$text = strip_tags(mysqli_real_escape_string($this->db, $_POST['text']));

		//Проверяем форму на корректность
		//Check the form for correctness
		if (empty($title) || empty($text) || empty($_FILES['img_src']['tmp_name'])) {
				echo "<div class='content'>
					<div class='main'>
					<div class='cat3'>You did not complete the form until the end !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_menu'>Return to editing 
					menu items.</a></div>
					</div></div>";
				exit;
		}
		$query = "INSERT INTO menu (name_menu, text_menu, img_src) VALUES ('$title', '$text', '$img_src')";
		if (!mysqli_query($this->db, $query)) {
			exit('Could not load menu item !!!');
		} else {
				echo "<div class='content'>
					<div class='main'>
					<img src='images/logo1.png' style='max-width: 320px; box-shadow: none; margin-top: -60px'>
					<div class='cat3'>The menu item was successfully added !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_menu'>Return to editing 
					menu items.</a></div>
					<div class='cat3'><a style='color: #000' href='?options=admin'>Return to the 
					administrative panel.</a></div>
					</div></div>";
				exit;
		}
	}

	//Переопределяем метод из класса родителя модифицируя его
	//We override the method from the parent class by modifying it
	public function get_Content() {
		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<div style='font-size: 24px; margin: 20px'>Form for adding a new menu item to the site:</div>";

		print <<<HEREDOC
			<form enctype="multipart/form-data" action="" method="POST" style="margin-left: 20px;">
				<p>Menu title:<br><br>
					<input type="text" name="title" class="form">
				</p><br>		
				<p>Menu text:<br><br>
					<textarea name="text" colls="5" rows="20" class="form"></textarea>
				</p><br>
				<p>Image for menu text:<br><br>
					<input type="file" name="img_src" class="form">
				</p><br>
				<p><input type='submit' name='button' style="height: 30px" value='Save menu item'></p>
			</form></div></div>
HEREDOC;


	}
}

?>