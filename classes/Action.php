<?php
//Создаем основной класс для вывода страницы
//Create the main page output class
abstract class Action {
	//Подключение к базе данных
	//Connecting to the database
	protected $db;
	public function __construct() {
		$this->db = mysqli_connect(HOST, USER, PASSWORD, BASE) or die ('No CONNECT !!!!');
		if (!$this->db) {
			exit('Нет подключения к базе!');
		}
		mysqli_query($this->db, "SET NAMES 'UTF8'");
	}


	//Вывод головы сайта исходя из выбранного шаблона
	//Output of the head of the site based on the selected template
	protected function get_Header() {
		$query = "SELECT name_templ FROM templ";
		$result = mysqli_query($this->db, $query);
		if (!$result) {
			exit('Не удалось получить категории');
		}
		$row = $result->fetch_array(MYSQLI_ASSOC);
		include ("templ/".$row['name_templ']."/header.".$row['name_templ'].".php");
	}

	//Определяем метод вывода основного содержимого
	//Define the method for displaying the main content
	abstract function get_Content();

	//Вывод главного меню. Создаем отдельный метод ля формирования содержимого главного меню
	//Displays the main menu. Create a separate method for creating the contents of the main menu
	protected function menu_array() {
		$query = "SELECT id_menu, name_menu FROM menu";
		$result = mysqli_query($this->db, $query);
		if (!$result) {
			exit('Не удалось получить категории');
		}
		//Формируем массив с пунктами меню
		//Form an array with menu items
		$row = array();
		for ($i=0; $i < mysqli_num_rows($result); $i++) {
			$row[] = $result->fetch_array(MYSQLI_ASSOC);
		}
		return $row;
	}

	//Метод вывода главного меню
	//Method for displaying the main menu
	protected function get_Menu() {
		$row = $this->menu_array();
		echo "<div class='header-main'>";
		echo "<div class='header-menu'>";
		echo "<div class='head1'><a href='?options=main'>Главная</a></div>";
		foreach ($row as $item) {
			printf("<div class='head1'>&nbsp<a href='?options=menu&id_menu=%s'>%s</a></div>", 
				$item['id_menu'], $item['name_menu']);
		}
		echo "</div>";
		echo "</div>";
	}


	//Вывод правого меню категорий
	//Print the right category menu
	protected function get_Right() {
		$query = "SELECT id_category, name_category FROM category";
		$result = mysqli_query($this->db, $query);
		if (!$result) {
			exit('Не удалось получить категории');
		}
		$row = array();
		echo "<div class='menu-rigth'>";
		echo "<div class='menu-rigth-main'>";
		echo "<div class='cat' style='color: #000'>Категории статей :</div>";
		for ($i=0; $i < mysqli_num_rows($result); $i++) {
			$row = $result->fetch_array(MYSQLI_ASSOC);
			printf("<div class='cat'><a href='?options=category&id_category=%s' style='color: #000'>
				%s</a></div>", $row['id_category'], $row['name_category']);
		}
		echo "</div>";
		echo "</div>";
	}


	//Основной метод вывода всего контента через index.php
	//The main method for displaying all content via index.php
	public function get_Body() {
		$this->get_Menu();//Вывод главного меню//Main menu output
		$this->get_Header();//Вывод головы//Head Extraction
		$this->get_Content();//Вывод оснновного содержимого//Basic content output	
		$this->get_Right();//Вывод меню категорий//Display Category Menu
		$this->get_Footer();//Вывод нижней части подвала//Output of the bottom	
		if($_POST){
			//Метод обработчик изменений контента сайта
			//Website Content Changes Processor
			$this->obr();
		}
	}
	//Вывод нижней части сайта
	//Displaying the bottom of the site
	protected function get_Footer() {
		$query = "SELECT name_templ FROM templ";
		$result = mysqli_query($this->db, $query);
		if (!$result) {
			exit('Не удалось получить категории');
		}
		$row = $result->fetch_array(MYSQLI_ASSOC);
		include ("templ/".$row['name_templ']."/footer.".$row['name_templ'].".php");
	}

}


?>