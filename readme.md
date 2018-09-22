FDP KASAPIN

Setup details

- git clone https://github.com/GrameenGhana/FDP_Kasapin.git
 change directory into the project folder

- The cloned code comes with .env.example file in the root of the project.

  You must rename this file to just .env
  
- Execute the command 'composer install' in the command line/terminal

- Execute the command 'npm install' (install node and npm if not installed)

- Create your database on your server and on your .env file update the following lines:
 
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=homestead
  DB_USERNAME=homestead
  DB_PASSWORD=secret
  
  Change these lines to reflect your new database settings.
  
- Execute command 'php artisan key:generate' to generate your APP_KEY

- Execute 'php artisan migrate' to setup admin tables in the database
  NB: if you encounter any errors check database connection settings .env
  
- Seed the database with 'php artisan db:seed' command

- Executed 'npm run dev' command to build stylesheets and javascripts

- Execute the command 'php artisan storage:link'

Finally execute php artisan serve to run the project as access web application in the browser at http://localhost:8000/

Login with credentials
username: admin@admin.com
password: secret

