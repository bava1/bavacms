<?php
//Создаем класс для вывода административной панели
//Create a class to display the administrative panel
class faq extends Adminer {

	//Переопределяем метод из класса родителя 
	//We override the method from the parent class by modifying it
	public function get_Content() {
		echo "<div class='content'>";	
		echo "<div class='main'>";
		echo "<img src='images/logo1.png' style='max-width: 520px; box-shadow: none'>";
		echo "<div class='cat2'style='font-size: 30px'>Instructions for the administrator</div>";
		echo "<div class='cat2' style='font-size: 24px'>1. Download and edit articles, menus and categories :<br>
		<br>To download a new article, click Add new article. Fill out the form, indicating the title of the 
		article, its short description, text and image for it, and click the Save article button.<br>
		To delete the required article, click on the right of the title, the red link Delete article.<br>
		To edit an already downloaded article, click on its title, then edit the data inside the form, and 
		click the Save Changes button. Do the same for the menu and categories ....<br>
		Articles and content of menu items are installed, only with images!<br>
		When installing categories, you must specify the ID for them, in ascending order!</div>";


		echo "<div class='cat2' style='font-size: 24px'>2. Appearance of your site : <br><br>
		To change the appearance of the site, click on the template image, and then click the Install 
		Template button. <br>
		Change the appearance of the template itself, you can only go to the folder with its name on 
		your hosting.</div>";

		echo "<div class='cat2' style='font-size: 24px'>3. Change the login and password of the 
		administrative panel :<br><br>In the site settings, you need to fill in both the form fields, login 
		and password !<br> The values themselves are in the user table, your database, called login and 
		password. To exit the admin panel, use the exit button. Do not leave it open. </div>";

		echo "<div class='cat2' style='font-size: 24px'>4. Deeper changes in the appearance of your 
		site :<br><br> To make images on the left side of the site, or links in its basement active, you 
		need to prescribe them yourself, in the header and footer files, of your template. After specifying 
		the address you need, the Internet resource in href, instead of the value #. The images themselves 
		are in the images folder of your template. You will be able to replace them, but to similar, in size. 
		Or, you can safely remove the extra images from the header file. This does not affect the operation 
		of your site. In addition, in the same way, you can replace on your site, the top and bottom 
		background images. </div>";
		echo "</div>";	
		echo "</div>";
	}
}

?>