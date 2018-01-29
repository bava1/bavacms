<?php
session_start();
//Создаем основной класс для админ панели
//Create the main class for the admin panel
abstract class Adminer {
	//Вывод верхней части административной панели
	//Output of the top part of the administrative panel
	protected function get_Header() {
		include ('templ/admin/header.admin.php');
	}
	//Вывод нижней части административной панели
	//Output of the lower part of the administrative panel
	protected function get_Footer() {
		include ('templ/admin/footer.admin.php');
	}

	//Непосредственно отвечает за вывод контента административной панели. 
	//Directly responsible for displaying the content of the administrative panel.
	abstract function get_Content();

	//Подключение к базе данных и создание объекта
	//Connecting to a database and creating an object
	protected $db;
	public function __construct() {			
		if (!$_SESSION['user']) {
			header("Location: ?options=login");
		}	
		$this->db = mysqli_connect(HOST, USER, PASSWORD, BASE) or die ('No CONNECT !!!!');
		if (!$this->db) {
			exit('No connection to the database!');
		}
		mysqli_query($this->db, "SET NAMES 'UTF8'");
	}

	//Вывод левого меню административной панели.
	//Displays the left menu of the administrative panel.
	protected function get_Right() {
		echo "<div class='header-main'>";
		echo "<div class='logo'></div>";		
		echo "<a href='?options=exites'><div class='exit'></div></a>";
		echo "</div>";
		echo "<div class='menu-rigth'>";
		echo "<div class='menu-rigth-main'>";
		echo "<div class='cat'><a href='?options=main'>To Home Page</a></div>";
		echo "<div class='cat'><a href='?options=admin'>Admin panel for site management<br>
		<br>Redact :</a></div>";
		echo "<div class='cat'><a href='?options=edit_stati'>Articles</a></div>";
		echo "<div class='cat'><a href='?options=edit_menu'>Menu items</a></div>";
		echo "<div class='cat'><a href='?options=edit_category'>Categories</a></div>";
		echo "<div class='cat'><a href='?options=set'>Basic site settings</a></div>";
		echo "<div class='cat'><a href='?options=faq'>Instructions</a></div>";
		echo "</div>";
		echo "</div>";
	}

	//Основной метод вывода административной панели через index.php
	//TThe main method of displaying the administrative panel via index.php
	public function get_Body() {
		$this->get_Header();//Вывод головы//Head Extraction
		if ($_POST) {
			//Метод обработчик изменений контента сайта
			//Website Content Changes Processor
			$this->obr();
		}
		$this->get_Content();//Вывод оснновного содержимого//Basic content output	
		$this->get_Right();//Вывод меню//Display Menu
		$this->get_Footer();//Вывод нижней части подвала//Output of the bottom	


	}


	//Метод для вывода категорий из списка при загрузке статей.
	//Method for displaying categories from the list when articles are loaded.
	protected function get_Categories() {
		$query = "SELECT id_category, name_category FROM category";
		$result = mysqli_query($this->db, $query);
		if (!$result) {
			exit('Could not retrieve categories');
		}

		$row = array();
		for ($i=0; $i < mysqli_num_rows($result); $i++) {
			$row[] = $result->fetch_array(MYSQLI_ASSOC);

		}
		return $row;
	}

	//Метод для вывода текста статей при их редактировании.
	//A method for displaying the text of articles when editing them.
	protected function get_text_stati($id) {
		$query = "SELECT id, title, description, text, cat FROM stati WHERE id='$id'";
		$result = mysqli_query($this->db, $query);
		if (!$result) {
			exit('Could not get the text of the article for change !!!');
		}
		$row = array();
		$row = $result->fetch_array(MYSQLI_ASSOC);
		return $row;
	}


	//Метод для вывода пунктов меню для редактирования.
	//A method for displaying menu items for editing.
	protected function get_text_menu($id) {
		$query = "SELECT id_menu, name_menu, text_menu FROM menu WHERE id_menu='$id'";
		$result = mysqli_query($this->db, $query);
		if (!$result) {
			exit('Could not get the menu to change !!!');
		}
		$row = array();
		$row = $result->fetch_array(MYSQLI_ASSOC);
		return $row;
	}

	//Метод для вывода категорий для редактирования.
	//A method for outputting categories for editing.
	protected function get_text_category($id) {
		$query = "SELECT id_category, name_category FROM category WHERE id_category='$id'";
		$result = mysqli_query($this->db, $query);
		if (!$result) {//Проверяем его 
			exit('Could not get categories for change !!!');
		}
		$row = array();
		$row = $result->fetch_array(MYSQLI_ASSOC);
		return $row;
	}

}

?>