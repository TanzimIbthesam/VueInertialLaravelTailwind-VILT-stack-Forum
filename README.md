1. First go to the project directory and in CLI run compose install
2. Then in cli run cp .env .env.example
3.Then run php artisan key:generate
4.Create a database and write similar name of database in .env file
5. Run php artisan migrate
6. Run php artisan db:seed --class=RoleSeeder
7. Then npm install and npm run watch 
8. You can open cli and php artisan tinker and then run User::factory(10)->create()
or if you want to register set up mailtrap and configure it from .env  file
