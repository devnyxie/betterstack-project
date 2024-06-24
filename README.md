# PHP Test Project

The project is hosted [here](https://php-app-714486958b28.herokuapp.com/) 👋

## Description
This is a very simple one-page application consisting of a single table and a form for creating new rows. To make it a little more complicated, we have written a 'framework' you have to use. Below is a set of simple tasks to perform. Please write a production-ready code.

## Installation ⚙️
### Database
2. Create a new MySQL database:
```sql
CREATE DATABASE `php_test_project`;
```
3. Import `database/schema.sql` into your database:
```bash
$ mysql -u root -p php_test_project < database/schema.sql
```
### Application
1. Clone the repository
2. Run `composer install` to install dependencies
3. Database credentials: Copy `.env.example` to `.env` and update the database credentials `OR` set the environment variables manually and source them.
4. Run `php -S localhost:8000` to start the built-in PHP Development Server.

## Tasks to perform
1. Style the page using [Bootstrap](http://getbootstrap.com/) or [Tailwind](http://tailwind.com/) 
  * Every other table row should be highlighted. <strong>[done]</strong>
  * Use Bootstrap’s form-horizontal or equivalent to style the form. <strong>[done]</strong>
  * Please make any other styling changes based on your preferences to make the interface look presentable. 
2. Add a validation of new records. <strong>[done]</strong>
3. Create a JS functionality to filter rows by city. <strong>[done]</strong>
4. Implement submission of the form using AJAX. <strong>[done]</strong>
5. Add a phone number column to the table. <strong>[done]</strong>
6. Please deploy the project to any freehosting and send us the production link. <strong>[done]</strong>

## Other Changes Made 
Apart from all the tasks mentioned in the instructions, I have also:
- Removed the short open tags from the code in views/index.php because they are not recommended according to the PHP documentation and require manual enabling in PHP 8.3.8.
- Switched to using Environment Variables for security reasons and easier deployment, as you requested for production-ready code.
- Previous import paths caused issues in the Docker container. I've updated them for a smoother experience.

Thank you for the opportunity to work on this project. I hope you like it! 🚀
