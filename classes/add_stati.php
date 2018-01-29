<?php
//Создаем новый класс для загрузки статей на сайт
class add_stati extends Adminer{

	//метод obr() отвечающий за обработку формы и записи данных в базу. 
	protected function obr(){

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
					</div></div>";		
		}

		$title = strip_tags(mysqli_real_escape_string($this->db, $_POST['title']));
		$date = date('Y-n-d', time());
		$description = strip_tags(mysqli_real_escape_string($this->db, $_POST['description']));
		$text = strip_tags(mysqli_real_escape_string($this->db, $_POST['text']));
		$cat = $_POST['cat'];
		//Проверяем форму на корректность
		if (empty($title) || empty($description) || empty($text) || empty($_FILES['img_src']['tmp_name'])) {
				echo "<div class='content'>
					<div class='main'>
					<div class='cat3'>You did not complete the form until the end !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_stati'>Return to 
					editing articles.</a></div>
					</div></div>";
				exit;
		}

		$query = "INSERT INTO stati (title, date, description, text, img_src, cat) VALUES ('$title', '$date', 
		'$description', '$text', '$img_src', '$cat')";//Формируем запрос к базе
		if (!mysqli_query($this->db, $query)) {//Проверка на загрузку
			exit('Could not load the article!');//Если ошибка
		} else {
				echo "<div class='content'>
					<div class='main'>
					<img src='images/logo1.png' style='max-width: 320px; box-shadow: none; margin-top: -60px'>
					<div class='cat3'>The article was successfully added to the site !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_stati'>Return to editing 
					other articles.</a></div>
					<div class='cat3'><a style='color: #000' href='?options=admin'>Return to the 
					administrative panel.</a></div>
					</div></div>";
				exit;
		}
	}

	//Переопределяем метод из класса родителя модифицируя его
	public function get_Content(){
		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<div style='font-size: 24px; margin: 20px'>Form for adding a new article to the site:</div>";
		/*
		if($_SESSION['res']){
			echo $_SESSION['res'];//Выводим сообщение из метода obr() о удачной загрузке
			unset ($_SESSION['res']);//И сразу удаляем сессию. Чтобы сообщение выводилось только один раз.
		}
		*/
		$cat = $this->get_Categories();//Получаем категории для вывода в селект
		print <<<HEREDOC
			<form enctype="multipart/form-data" action="" method="POST" style="margin-left: 20px;">
				<p>Article title :<br><br>
					<input type="text" name="title" class="form">
				</p><br>	
				<p>Short description :<br><br>
					<textarea name="description" colls="50" rows="4" class="form"></textarea>
				</p><br>	
				<p>The text of the article :<br><br>
					<textarea name="text" colls="50" rows="20" class="form"></textarea>
				</p><br>
				<p>Article image :<br><br>
					<input type="file" name="img_src" class="form">
				</p><br>
				<select name="cat">
HEREDOC;
		//Вывод категорий в список селект
		foreach ($cat as $item) {
		echo "<option style='width: 106px' value='".$item['id_category']."'>".$item['name_category']."</option>";
		}

		echo "</select><br><br><p><input type='submit' name='button' style='height: 30px' 
		value='Save article'></p></form>";

		echo "</div>";	
		echo "</div>";
	}
}

?>