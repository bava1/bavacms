<?php
//Создаем новый класс для изменения готовых пунктов меню на сайте
//Create a new class for changing the ready menu items on the site
class update_menu extends Adminer {

	//метод obr() отвечающий за обработку формы и записи данных в базу. 
	//The method obr () is responsible for processing the form and writing data to the database.
	protected function obr(){
		$id = $_POST['id'];
		$title = strip_tags(mysqli_real_escape_string($this->db, $_POST['title']));
		$text = strip_tags(mysqli_real_escape_string($this->db, $_POST['text']));
		//Проверяем форму на корректность
		//Check the form for correctness
		if (empty($title) || empty($text)) {
				echo "<div class='content'>
					<div class='main'>
					<img src='images/logo1.png' style='max-width: 320px; box-shadow: none; margin-top: -60px'>
					<div class='cat3'>Вы не до конца заполнили форму !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_menu'>Вернуться в 
					к редактированию пунктов меню.</a></div>
					</div></div>";
				exit;
		}
		$query = "UPDATE menu SET name_menu='$title', text_menu='$text' WHERE id_menu='$id'";
		if (!mysqli_query($this->db, $query)) {
			exit('Не удалось загрузить пункт меню !');
		} else {
				echo "<div class='content'>
					<div class='main'>
					<img src='images/logo1.png' style='max-width: 320px; box-shadow: none; margin-top: -60px'>
					<div class='cat3'>Пункт меню успешно измененн !!!</div>
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
	public function get_Content(){
		//Проверяем прием id статьи которую будем редактировать 
		//We check the receipt of the id of the article to be edited
		if ($_GET['id_text']) {
			$id_menu = (int)$_GET['id_text'];
		} else {
			exit('Непрвильные данные для этой страницы 1!!!');
		}
		//Получаем данные по пунктам меню для вывода теле формы при редактировании
		//We get the data on the menu items for the output of the body form when editing
		$menu = $this->get_text_menu($id_menu);

		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<div style='font-size: 24px; margin: 20px'>Форма для редактирования пункта меню:</div>";

		print <<<HEREDOC
			<form action="" method="POST" style="margin-left: 20px;">
				<p>Заголовок меню :<br><br>
					<input type="text" name="title" class="form" value="$menu[name_menu]">
					<input type="hidden" name="id" class="form" value="$menu[id_menu]">
				</p><br>	
				<p>Текст меню:<br><br>
					<textarea name="text" colls="50" rows="20" class="form">$menu[text_menu]</textarea><br><br>
				<input type='submit' name='button' style="height: 30px" value='Сохранить пункт меню'></p>
				</form></div></div>
HEREDOC;
	}
}

?>