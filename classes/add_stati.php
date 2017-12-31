<?php
//Создаем новый класс для загрузки статей на сайт
class add_stati extends Adminer{

	//метод obr() отвечающий за обработку формы и записи данных в базу. 
	//The method obr () is responsible for processing the form and writing data to the database.
	protected function obr(){

		//Делаем загрузку изображений да сайт
		//We do the downloading of images yes site
		if (!empty($_FILES['img_src']['tmp_name'])) {
			if (!move_uploaded_file($_FILES['img_src']['tmp_name'], "images/".$_FILES['img_src']['name'])) {
				exit('Не удалось загрузить изображение для статьи !');//Если ошибка
			}
			$img_src = "images/".$_FILES['img_src']['name'];
		} else {
				echo "<div class='content'>
					<div class='main'>
					<img src='images/logo1.png' style='max-width: 320px; box-shadow: none; margin-top: -60px'>
					<div class='cat3'>Необходимо указать изображение !!!</div>
					</div></div>";		
		}

		$title = strip_tags(mysqli_real_escape_string($this->db, $_POST['title']));
		$date = date('Y-n-d', time());
		$description = strip_tags(mysqli_real_escape_string($this->db, $_POST['description']));
		$text = strip_tags(mysqli_real_escape_string($this->db, $_POST['text']));
		$cat = $_POST['cat'];

		//Проверяем форму на корректность
		//Check the form for correctness
		if (empty($title) || empty($description) || empty($text) || empty($_FILES['img_src']['tmp_name'])) {
				echo "<div class='content'>
					<div class='main'>
					<div class='cat3'>Вы не до конца заполнили форму !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_stati'>Вернуться в 
					к редактированию статей.</a></div>
					</div></div>";
				exit;
		}

		$query = "INSERT INTO stati (title, date, description, text, img_src, cat) VALUES ('$title', '$date', 
		'$description', '$text', '$img_src', '$cat')";
		if (!mysqli_query($this->db, $query)) {
			exit('Не удалось загрузить статью !');
		} else {
				echo "<div class='content'>
					<div class='main'>
					<img src='images/logo1.png' style='max-width: 320px; box-shadow: none; margin-top: -60px'>
					<div class='cat3'>Статья успешно добавленна на сайт !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_stati'>Вернуться в 
					к редактированию других статей.</a></div>
					<div class='cat3'><a style='color: #000' href='?options=admin'>Вернуться в 
					административную панель.</a></div>
					</div></div>";
				exit;
		}
	}

	//Переопределяем метод из класса родителя модифицируя его
	//We override the method from the parent class by modifying it
	public function get_Content(){
		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<div style='font-size: 24px; margin: 20px'>Форма для добавления новой статьи на сайт:</div>";
		$cat = $this->get_Categories();
		print <<<HEREDOC
			<form enctype="multipart/form-data" action="" method="POST" style="margin-left: 20px;">
				<p>Заголовок статьи :<br><br>
					<input type="text" name="title" class="form">
				</p><br>	
				<p>Краткое описание :<br><br>
					<textarea name="description" colls="50" rows="4" class="form"></textarea>
				</p><br>	
				<p>Текст статьи :<br><br>
					<textarea name="text" colls="50" rows="20" class="form"></textarea>
				</p><br>
				<p>Изображение для статьи:<br><br>
					<input type="file" name="img_src" class="form">
				</p><br>
				<select name="cat">
HEREDOC;
		foreach ($cat as $item) {
		echo "<option style='width: 106px' value='".$item['id_category']."'>".$item['name_category']."</option>";
		}

		echo "</select><br><br><p><input type='submit' name='button' style='height: 30px' 
		value='Сохранить статью'></p></form>";

		echo "</div>";	
		echo "</div>";
	}
}

?>