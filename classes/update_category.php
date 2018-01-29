<?php
//Создаем класс для изменения готовых категорий на сайте
//Create a class for changing the finished categories on the site
class update_category extends Adminer {

	//метод obr() отвечающий за обработку формы и записи данных в базу.
	//The method obr () is responsible for processing the form and writing data to the database. 
	protected function obr() {
		$id = $_POST['id'];
		$title = strip_tags(mysqli_real_escape_string($this->db, $_POST['title']));
		//Проверяем форму на корректность
		//Check the form for correctness
		if(empty($title)){
			exit('You did not complete the form until the end !!!');
		}
		$query = "UPDATE category SET name_category='$title' WHERE id_category='$id'";//Формируем запрос к базе
		if (!mysqli_query($this->db, $query)) {//Проверка на загрузку
			exit('Failed to load the changes into the category!');//Если ошибка
		} else {
				echo "<div class='content'>
					<div class='main'>
					<img src='images/logo1.png' style='max-width: 320px; box-shadow: none; margin-top: -60px'>
					<div class='cat3'>Category has been successfully changed !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_category'>Go back to 
					editing other categories.</a></div>
					<div class='cat3'><a style='color: #000' href='?options=admin'>Return to the 
					administrative panel.</a></div>
					</div></div>";
				exit;
		}
	}

	//Переопределяем метод из класса родителя модифицируя его
	//We override the method from the parent class by modifying it
	public function get_Content() {
		//Проверяем прием id статьи которую будем редактировать 
		//We check the receipt of the id of the article to be edited
		if ($_GET['id_text']) {
			$id_menu = (int)$_GET['id_text'];
		} else {
			exit('Incorrect data for this page !!!');
		}
		//Получаем данные по статье для вывода  теле формы при редактировании
		//We get data on the article for outputting the body form when editing
		$menu = $this->get_text_category($id_menu);//Метод описанн в главном классе 
		//The method is described in the main class

		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<div style='font-size: 24px; margin: 20px'>Form for changing the category name:</div>";
		
		print <<<HEREDOC
			<form action="" method="POST" style="margin-left: 20px;"><p>
			<input type="hidden" name="id" class="form" value="$menu[id_category]"></p><br>	
			<p>Name of category :<br><br>
			<textarea name="title" colls="50" rows="2" class="form">$menu[name_category]</textarea><br><br>
			<input type='submit' name='button' style='height: 30px' value='Save Category'></p></form>
			<div style='font-size: 24px; margin: 20px; color: red'>Important! ID categories should go in 
			order of increasing!</div>
			</div></div>
HEREDOC;
	}
}

?>