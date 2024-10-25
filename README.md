# Laravel Docker Project

This project is a Laravel-based web application that utilizes Docker for containerization. The application includes features for managing posts and allows users to create, update, delete, and search for posts. The project is structured with a repository pattern for better organization and maintainability.

## Technologies Used

-   **Laravel**: A PHP framework for building web applications.
-   **Docker**: For containerization and easy deployment.
-   **Node.js**: For managing front-end dependencies and running development scripts.
-   **Composer**: For PHP dependency management.

## Installation Instructions

Follow these steps to set up the project locally:

1. **Clone the repository**:

    ```bash
    git clone https://github.com/Hovhannes111/laravel-docker.git
    cd laravel-docker

    ```

2. Start Docker containers:
   docker compose up --build -d

3. Install Node.js dependencies
   docker compose exec node npm install

4. Access the PHP container
   docker compose exec php-fpm bash

5. Install PHP dependencies
   composer install

6. Copy the environment file
   cp .env.example .env

7. Generate the application key
   php artisan key:generate

8. Run migrations
   php artisan migrate

9. Seed the database
   php artisan db:seed

10. Set storage permissions
    chmod 777 -R storage

11. Exit from the PHP container: After running the above commands, exit the container by typing
    exit

12. Compile front-end assets
    docker compose exec node npm run dev

The application will be running at http://localhost:8080. Open this URL in your browser to access the application.
