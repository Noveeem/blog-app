# Blog App

## App Description

This is a Laravel-based blog application that allows users to publish and read blog posts. It provides a user-friendly interface for creating, editing, and managing blog content.

## Technology Stack

- **Laravel:** The project is built on the Laravel PHP framework, which provides a robust foundation for web applications.
- **Filament:** Filament is used for the administration panel, offering a clean and customizable interface for managing the system's backend.
- **Livewire:** Livewire is employed for dynamic, reactive interfaces, enhancing the user experience without writing JavaScript.

## Purpose

I created this blog app for my portfolio. It showcases my web development skills and serves as a practical example of a Laravel-based web application. 

## How to Install/Run

To run this application, follow these steps:

1. Clone the repository to your local machine: 
git clone https://github.com/Noveeem/blog-app.git

2. Navigate to the project directory: `cd blog-app`

3. Install the project dependencies: `composer install`

4. Create a `.env` file by copying the example file: `cp .env.example .env`

5. Generate an application key: `php artisan key:generate`

6. Configure your database settings in the `.env` file.

7. Run database migrations and seeders: `php artisan migrate --seed`

8. Start the development server: `php artisan serve`

9. Access the application in your web browser at `http://localhost:8000`.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.




