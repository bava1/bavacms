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
					<div class='cat3'>You did not complete the form until the end !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_category'>Go back to 
					editing other categories.</a></div>
					<div class='cat3'><a style='color: #000' href='?options=admin'>Return to the 
					administrative panel.</a></div>
					</div></div>";
				exit;
		}
		$query = "INSERT INTO category (id_category, name_category) VALUES ('$title', '$text')";
		if (!mysqli_query($this->db, $query)) {
			exit('Could not load category !!!');
		} else {
				echo "<div class='content'>
					<div class='main'>
					<img src='images/logo1.png' style='max-width: 320px; box-shadow: none; margin-top: -60px'>
					<div class='cat3'>New category successfully added !!!</div>
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
		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<div style='font-size: 24px; margin: 20px 0'>Form for adding a new category to the site:</div>";

		print <<<HEREDOC
			<form action="" method="POST" class="form">
				<p>Category ID :<br><br>
					<input type="text" name="title" class="form">
				</p><br>		
				<p>Name of category :<br><br>
					<textarea name="text" colls="5" rows="2" class="form"></textarea>
				</p><br>
				<p><input type='submit' name='button' style='height: 30px' value='Save a new category'></p>
			</form><br><br>
			<div style='font-size: 24px; margin: 2px; color: red'>Important! You always need to specify 
			a category. ID categories should go in order of increasing!</div>
			</div></div>
HEREDOC;
	}
}

?>