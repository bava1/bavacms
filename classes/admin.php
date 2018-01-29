<?php
//Создаем класс для вывода административной панели
//Create a class to display the administrative panel
class admin extends Adminer {

	//Переопределяем метод из класса родителя 
	//We override the method from the parent class by modifying it
	public function get_Content() {
		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<img src='images/logo1.png' style='max-width: 520px; box-shadow: none'>";
		echo "<div class='cat2'style='font-size: 30px'>Welcome to the administrative panel of bava.cms 
		of your site.</div>";
		echo "<div class='cat2' style='font-size: 24px'>From here you can manage the content of the site 
		and customize it for your taste.<br>
		From here we can manage the content of the site and customize it for your taste.
		With the help of the menu, in the right part of the panel you can add, edit and delete 
		articles, categories and menu items. And also change the appearance of your site, logs and 
		password to the administrative panel in Site Settings.
		</div>";
		echo "<div class='cat2' style='font-size: 24px; color: #000'><a style='color: #000'href='?options=faq'>
		FAQ on bava.cms :<br>1. Adding content<br>2. Editing content<br>3. Deleting content
		<br>4. Basic settings of your site<br>5. Connecting the Site<br>6. Working with the database</a></div>";
		echo "<div class='cat2' style='font-size: 24px'>The bava.cms you use is developed in the bava studio.<br>
		This content management system is absolutely free.
		</div>";
		echo "</div>";	
		echo "</div>";
	}
}

?>