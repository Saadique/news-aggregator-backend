##Getting Started

**How to start application in local environment**

* Clone the project and run the command 'composer install' to install dependencies.


 * Then run the command 'php artisan serve' to initiate the service. Make sure 
the port 8000 is free.
Most probably the application may run in http://127.0.0.1:8000

* Then you can use this domain url to access application APIs

* Please review API docs 

##Database Setup

* Create MySQL database with name 'news-aggregator'.
* create .env file with the content in .env.example
* Then run 'php artisan migrate' command to create the tables in the database
