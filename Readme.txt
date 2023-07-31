For set up database:
you can import my database (sql file) in your system mysql.
or
first of all create a new database 'assignment' named. where username="root" and password="".
then create table "contact_form" with some column as:
id(int,primary,auto incriment)
name(text,50)
phone(varchar,20)
email(varchar,100)
subject(varchar,100)
message(varchar,200)
ip_address(varchar,50)
created_at(timestamp)

for run this application:

first of all start your xampp serve then go to your browser address bar and type "localhost/task2_assignment" and press enter.

In this assignment, i created a index.php file for contact form and all the logics and database quires are also written in it.

Note: for sending email you should attached your own email and verified app password.