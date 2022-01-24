# Job harvest & match Laravel
# Description
This is a tool that allows to harvest and match jobs from a site by a given link.
 
This project can collect data and store in a database.
User can refresh databse table, search for jobs stored in DB and get results filtered by "Full Text Search" and ordered by "SCORE".

# Instalation
1) After uploading project from git, open terminal in project directory and run "composer install"
2) Run "cp .env.example .env" to copy .env example file
3) Run "php artisan key:generate" to generate a unique project key
4) Enter in .env file and connect a new database
5) Run "php artisan migrate"
6) Open project in browser
