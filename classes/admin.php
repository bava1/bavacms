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
		echo "<div class='cat2'style='font-size: 30px'>Добро пожаловать в административную панель bava.cms 
		вашего сайта.</div>";
		echo "<div class='cat2' style='font-size: 24px'>Отсюда мы можете управлять содержимым сайта и 
		настраивать его на ваш вкус.<br>
		С помощью меню, в правой части панели вы можете добавлять, редактировать и удалаять статьи, категории и 
		пункты меню. А так же изменить внешний вид вашего сайта, логи и пароль к административной панели в
		Настройки сайта.</div>";
		echo "<div class='cat2' style='font-size: 24px; color: #000'><a style='color: #000'href='?options=faq'>
		FAQ по bava.cms :<br>1. Добавление контента<br>2. Редактирование контента<br>3. Удаление контента
		<br>4. Основные настройки вашего сайта<br>5. Подключение сайта<br>6. Работа с базой данных</a></div>";
		echo "<div class='cat2' style='font-size: 24px'>bava.cms разработана в студии bava.<br>Данная 
		система управления контентом является абсолютно бесплатной.</div>";
		echo "</div>";	
		echo "</div>";
	}
}

?>