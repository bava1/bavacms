Bava.cms
We present you the content management system bava.cms.
This system is based on the PHP7 language and the MySQL database.

Bava.cms is very easy to install and connect. On its basis, you can get at your disposal, 
a fully functional website with a responsive design. Which, equally well will work on 
various devices. To manage the content of your site, there is a user-friendly administrative 
panel. With it, you can customize your site, even from a tablet or smartphone. Change the 
appearance of your site and edit the content.

So, you decided to use bava.cms. Thank you for that. But, for starters, we advise you to 
read the instructions.

***** Step 1 *****

To install, just copy all the contents of bava.cms, to the working folder, to your hosting. 
And, what would your site have started to work, you need to create in the database, necessary 
for your site tables, or import them from the installation folder. After you create and connect 
the database, your site will be fully functional.
Important! Your hosting should support PHP7, otherwise your site will not work.

***** Step 2 *****

Connection to the database.
To connect to the database, you will need to configure the file config.php.
Enter in the field:
define("HOST", " web address of your hosting")// Specifies the hosting itself.
define("USER", " database user name ")// Either create or indicate hosting.
define("PASSWORD", " database password ")// Either create or indicate hosting.
define("DB", " database name ")// Create yourself.
If you create a database called minicms and import tables from the source folder there, 
then you will not have to change anything.

***** Step 3 *****

To access the admin panel, you need to type in your browser's request line / your site /? options = admin. 
After that, you will be taken to the admin login form. Here you will need to enter your log-in and 
password, which you can change in the table under the name of your database. By default, the login 
is set as an admin, and the password is set to admin. After processing your data, you should re-enter. 
Once again, typing / your site /? options = admin.
Login: admin
Password: admin

***** Step 4 *****

All articles on the site are divided into categories. Menu items have separate content. Using the 
administrative panel, you can add, edit or delete articles, categories and menu items on your site. 
In the administrative panel, in the basic settings, you can choose one of the five templates for the 
appearance of your site. And also change the password and administrator login. To exit the administration 
panel, click the Exit button.

That's all. We wish you a comfortable work with your new project. 
For all questions, please contact the creator of bava.cms.





























