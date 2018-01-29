<?php
//Создаем класс для изменения готовых статей на сайте
//Create a class for editing finished articles on the site
class update_stati extends Adminer{

	//метод obr() отвечающий за обработку формы и записи данных в базу. 
	protected function obr() {
		$id = $_POST['id'];
		$title = strip_tags(mysqli_real_escape_string($this->db, $_POST['title']));
		$date = date('Y-n-d', time());
		$description = strip_tags(mysqli_real_escape_string($this->db, $_POST['description']));
		$text = strip_tags(mysqli_real_escape_string($this->db, $_POST['text']));
		$cat = $_POST['cat'];
		//Проверяем форму на корректность
		//Check the form for correctness
		if (empty($title) || empty($description) || empty($text)) {
				echo "<div class='content'>
					<div class='main'>
					<div class='cat3'>You did not complete the form until the end !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=admin'>Return to editing 
					articles.</a></div>
					</div></div>";
				exit;
		}
		$query = "UPDATE stati SET title='$title', date ='$date', description='$description', text='$text', 
		cat='$cat' WHERE id='$id'";
		if (!mysqli_query($this->db, $query)) {
			exit('Could not load the article!');
		} else {
				echo "<div class='content'>
					<div class='main'>
					<img src='images/logo1.png' style='max-width: 320px; box-shadow: none; margin-top: -60px'>
					<div class='cat3'>The article was successfully changed !!!</div>
					<div class='cat3'><a style='color: #000' href='?options=edit_stati'>Return to editing 
					other articles.</a></div>
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
			$id_text = (int)$_GET['id_text'];
		} else {
			exit('Incorrect data for this page !!!');
		}
		//Получаем данные по статье для вывода  теле формы при редактировании
		//We get data on the article for outputting the body form when editing
		$text = $this->get_text_stati($id_text);

		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<div style='font-size: 24px; margin: 20px'>The form for editing this article :</div>";
		
		$cat = $this->get_Categories();
		print <<<HEREDOC
			<form enctype="multipart/form-data" action="" method="POST" style="margin-left: 20px">
				<p>Article title :<br><br>
					<input type="text" name="title" class="form" value="$text[title]">
					<input type="hidden" name="id" class="form" value="$text[id]">
				</p><br>	
				<p>Short description :<br><br>
					<textarea name="description" colls="50" rows="6" class="form">$text[description]</textarea>
				</p><br>	
				<p>The text of the article :<br><br>
					<textarea name="text" colls="50" rows="15" class="form">$text[text]</textarea>
				</p><br>
				<select name="cat">
HEREDOC;
		//Вывод категории, к которой пренадлежит статья
		//Conclusion of the category to which the article belongs
		foreach ($cat as $item) {
			if ($text['cat'] == $item['id_category']) {
				echo "<option selected style='width: 106px' value='".$item['id_category']."'>".$item['name_category']."</option>";				
			} else {
				echo "<option style='width: 106px' value='".$item['id_category']."'>".$item['name_category']."</option>";					
			}

		}

		echo "</select><br><br><p><input type='submit' name='button' value='Save article'></p></form>";
		echo "</div>";	
		echo "</div>";
	}
}

?>