# LARAVEL BACKEND INAGATA INTERNSHIP
Inagata backend internship test

## Requirement
- PHP >= 8.2
- NPM LTS (Node.js)
- Composer

### Database documentation
- https://dbdocs.io/achmadmuzaki14/dbinagata

### API documentation
- https://documenter.getpostman.com/view/18717705/2s93m7VggZ

### Installation
- first clone this repo with command
  ``` bash
  $ git clone https://github.com/achmadmuzaki14/inagata-backend-internship.git
  ```

- then go into repo directory
  ``` bash
  $ cd laravel-keuangan-inagata
  ```

- copy the .env file with command
  ``` bash
  $ cp .env.example .env
  ```

- install dependency, but if you dont have node.js and composer installed on your device please install it first
  ``` bash
  $ composer install
  $ npm install
  ```
- compile the template using command
  ``` bash
  $ npm run dev  
  ```

- generate application key using command
  ``` bash
  $ php artisan key:generate
  ```

- migrate the  database
  ``` bash
  $ php artisan migrate
  ```

- then run in your browser`http://localhost:8000`

