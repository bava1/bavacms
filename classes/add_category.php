<?php
//Создаем класс для добавления новых категорий на сайт
//Create a class for adding new categories to the site
class add_category extends Adminer {

	//метод obr() отвечающий за обработку формы и записи данных в базу. 
	//The method obr () is responsible for processing the form and writing data to the database.
	protected function obr() {
		$title = strip_tags(mysqli_real_escape_string($this->db, $_POST['title']));
		$text = strip_tags(mysqli_real_escape_string($this->db, $_POST['text']));
		//Проверяем форму на корректность
		//Check the form for correctness
		if (empty($title) || empty($text)) {
				echo "<div class='content'>
					<div class='main'>
					<img src='images/logo1.png' style='max-width: 320px; box-shadow: none; margin-top: -60px'>
					<div class='cat3'>Вы не до конца заполнили форму !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_category'>Вернуться в 
					к редактированию других категорий.</a></div>
					<div class='cat3'><a style='color: #000' href='?options=admin'>Вернуться в 
					административную панель.</a></div>
					</div></div>";
				exit;
		}
		$query = "INSERT INTO category (id_category, name_category) VALUES ('$title', '$text')";
		if (!mysqli_query($this->db, $query)) {
			exit('Не удалось загрузить категорию !!!');
		} else {
				echo "<div class='content'>
					<div class='main'>
					<img src='images/logo1.png' style='max-width: 320px; box-shadow: none; margin-top: -60px'>
					<div class='cat3'>Новая категория успешно добавленна !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_category'>Вернуться в 
					к редактированию других категорий.</a></div>
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
		echo "<div style='font-size: 24px; margin: 20px 0'>Форма для добавления новой категории на сайт:</div>";

		print <<<HEREDOC
			<form action="" method="POST" class="form">
				<p>ID категории :<br><br>
					<input type="text" name="title" class="form">
				</p><br>		
				<p>Название категории :<br><br>
					<textarea name="text" colls="5" rows="2" class="form"></textarea>
				</p><br>
				<p><input type='submit' name='button' style='height: 30px' value='Сохранить новую категорию'></p>
			</form><br><br>
			<div style='font-size: 24px; margin: 2px; color: red'>Важно! ID категорий должны идти по 
			порядку возрастания !</div>
			</div></div>
HEREDOC;
	}
}

?>