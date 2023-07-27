# Project Installation Guide
Follow these steps to install and set up the project after cloning:

## Prerequisites
Make sure you have the following installed on your system:

> -PHP (minimum version 7.4)
> -Composer
> -MySQL (or any other compatible database)

# Installation
1. Clone the project repository to your local machine:
> git clone https://github.com/your-username/project-name.git

2. Change into the project directory:
> cd project-name

3. Install project dependencies using Composer:
> composer install

4. Install project dependencies using npm:
> npm install

5. Create a copy of the .env.example file and rename it to .env. Update the database connection details in the .env file to match your local environment:
> cp .env.example .env

6. Generate the application key:
> php artisan key:generate



## Database Migration
1. Run the database migration to create the necessary tables:
> php artisan migrate


## Database Seeding
1. To add some dummy data for better presentation, run the following command to seed the database:
> php artisan db:seed

## Serve the Application
1. Finally, serve the application using the built-in development server:
> php artisan serve

2. And run this for vite:
> npm run dev


You should now be able to access the project at http://localhost:8000 in your web browser.
