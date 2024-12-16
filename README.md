## Echo.tj

Run your own music streaming service with Echo.tj. 
This is a  starter project for anyone who wants to build a music streaming service.

#music-engine #music-streaming #music-player #music-library

## Installation

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js
- MySQL

*You can use XAMPP to handle MySQL and php on Windows*

### Steps
- Clone the repository
- Install the dependencies

    ```bash
    composer install
    ```
- Create a `.env` file
    - Copy the contents of `.env.example` to `.env`
    - Fill the DB credentials in the `.env` file
    - Generate an application key
        ```bash
        php artisan key:generate
        ```

- Run the migrations
    ```bash
      php artisan migrate
    ```

- Install npm dependencies
    ```bash
    npm install
    ```
- Start the server
    ```bash
    php artisan serve
    ```

- Build the assets in watch mode
    ```bash
    npm run dev
    ```

- Visit the site at `http://localhost:8000`
