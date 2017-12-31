<?php
//Основная точка входа на сайт. К ней подключенны два главных класса.
//The main entry point to the site. There are two main classes connected to it.
//ACore - класс для вывода содержимого сайта. 
//ACore - a class for displaying the content of the site.
//ACore_Admin - класс административной панели для редактирования содержимого. 
//ACore_Admin is the administrative panel class for editing content.
	session_start();
	header("Content-type: text/html; charset=utf-8");

	//Подключаем файл конфигурации и основные классы
	//Connect the configuration file and the main classes
	require_once("config.php");
	require_once("classes/Action.php");
	require_once("classes/Adminer.php");

	//Делаем механизм приема GET запросов для всех классов
	//We make the mechanism for receiving GET requests for all classes
	if($_GET['options']){
		$class = trim(strip_tags($_GET['options']));//Фильтруем данные
	} else {//Если не введены GET параметры, то мы перенаправляем на главную
		$class = 'main';
	};

	//Проверяем класс на существование в паке classes
	//We check the class for existence in the package classes
	if(file_exists("classes/".$class.".php")){
		include("classes/".$class.".php");
		//Проверяем на существование класса
		//We check for the existence of a class
		if(class_exists($class)){
			//Создаем объект того класса, который запрошенн через GET options
			//Create an object of the class that was requested via GET options
			$obj = new $class;
			//Создаем метод который будет выводить весь контент
			//Create a method that will output all the content
			$obj->get_Body();
		} else {
			exit("<p>Не существует класс !!!</p>");
		}
	} else {
		exit("<p>Не правильный адрес !!!</p>");
	};






?>