<?php
//Создаем класс для добавления пунктов меню на сайт
//Create class for adding menu items to the site
class add_menu extends Adminer {

	//метод obr() отвечающий за обработку формы и записи данных в базу. 
	//The method obr () is responsible for processing the form and writing data to the database.
	protected function obr() {
		
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
					<div class='cat3'><a style='color: #000' href='?options=edit_menu'>Вернуться в 
					к редактированию пунктов меню.</a></div>
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
					<div class='cat3'>Вы не до конца заполнили форму !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_menu'>Вернуться в 
					к редактированию пунктов меню.</a></div>
					</div></div>";
				exit;
		}
		$query = "INSERT INTO menu (name_menu, text_menu, img_src) VALUES ('$title', '$text', '$img_src')";
		if (!mysqli_query($this->db, $query)) {
			exit('Не удалось загрузить пункт меню !!!');
		} else {
				echo "<div class='content'>
					<div class='main'>
					<img src='images/logo1.png' style='max-width: 320px; box-shadow: none; margin-top: -60px'>
					<div class='cat3'>Пункт меню успешно добавленн !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_menu'>Вернуться в 
					к редактированию пунктов меню.</a></div>
					<div class='cat3'><a style='color: #000' href='?options=admin'>Вернуться в 
					административную панель.</a></div>
					</div></div>";
				exit;
		}
	}

	//Переопределяем метод из класса родителя модифицируя его
	//We override the method from the parent class by modifying it
	public function get_Content() {
		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<div style='font-size: 24px; margin: 20px'>Форма для добавления нового пункта меню на сайт:</div>";

		print <<<HEREDOC
			<form enctype="multipart/form-data" action="" method="POST" style="margin-left: 20px;">
				<p>Заголовок меню :<br><br>
					<input type="text" name="title" class="form">
				</p><br>		
				<p>Текст меню :<br><br>
					<textarea name="text" colls="5" rows="20" class="form"></textarea>
				</p><br>
				<p>Изображение для текста меню:<br><br>
					<input type="file" name="img_src" class="form">
				</p><br>
				<p><input type='submit' name='button' style="height: 30px" value='Сохранить пункт меню'></p>
			</form></div></div>
HEREDOC;


	}
}

?>