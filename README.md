# TA22E-A5-projekt

# Laravel Feature Tests Setup

## Local Environment Setup

1. **Install dependencies**:
   ```bash
   composer install
   npm install
   cp .env.example .env.testing
   ```
2. **Configure testing database in .env.testing**:
   ```bash
   DB_CONNECTION=sqlite
   DB_DATABASE=:memory:
   ```
3. Running Tests
    ```bash
    php artisan test
    ```
