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
					<div class='cat3'>You did not complete the form until the end !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_menu'>Return to editing 
					menu items.</a></div>
					</div></div>";
				exit;
		}
		$query = "UPDATE menu SET name_menu='$title', text_menu='$text' WHERE id_menu='$id'";
		if (!mysqli_query($this->db, $query)) {
			exit('Could not load the menu item!');
		} else {
				echo "<div class='content'>
					<div class='main'>
					<img src='images/logo1.png' style='max-width: 320px; box-shadow: none; margin-top: -60px'>
					<div class='cat3'>The menu item has been successfully changed !!!</div>
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
	public function get_Content(){
		//Проверяем прием id статьи которую будем редактировать 
		//We check the receipt of the id of the article to be edited
		if ($_GET['id_text']) {
			$id_menu = (int)$_GET['id_text'];
		} else {
			exit('Incorrect data for this page !!!');
		}
		//Получаем данные по пунктам меню для вывода теле формы при редактировании
		//We get the data on the menu items for the output of the body form when editing
		$menu = $this->get_text_menu($id_menu);

		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<div style='font-size: 24px; margin: 20px'>The form for editing the menu item :</div>";

		print <<<HEREDOC
			<form action="" method="POST" style="margin-left: 20px;">
				<p>Menu title :<br><br>
					<input type="text" name="title" class="form" value="$menu[name_menu]">
					<input type="hidden" name="id" class="form" value="$menu[id_menu]">
				</p><br>	
				<p>Menu text :<br><br>
					<textarea name="text" colls="50" rows="20" class="form">$menu[text_menu]</textarea><br><br>
				<input type='submit' name='button' style="height: 30px" value='Save menu item'></p>
				</form></div></div>
HEREDOC;
	}
}

?>