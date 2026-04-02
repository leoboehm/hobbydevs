# HobbyDevs – Refactoring Project

[![Code Smells](https://sonarcloud.io/api/project_badges/measure?project=leoboehm_hobbydevs&metric=code_smells)](https://sonarcloud.io/summary/new_code?id=leoboehm_hobbydevs)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=leoboehm_hobbydevs&metric=coverage)](https://sonarcloud.io/summary/new_code?id=leoboehm_hobbydevs)
[![Duplicated Lines (%)](https://sonarcloud.io/api/project_badges/measure?project=leoboehm_hobbydevs&metric=duplicated_lines_density)](https://sonarcloud.io/summary/new_code?id=leoboehm_hobbydevs)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=leoboehm_hobbydevs&metric=sqale_rating)](https://sonarcloud.io/summary/new_code?id=leoboehm_hobbydevs)
[![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=leoboehm_hobbydevs&metric=reliability_rating)](https://sonarcloud.io/summary/new_code?id=leoboehm_hobbydevs)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=leoboehm_hobbydevs&metric=security_rating)](https://sonarcloud.io/summary/new_code?id=leoboehm_hobbydevs)
[![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=leoboehm_hobbydevs&metric=sqale_index)](https://sonarcloud.io/summary/new_code?id=leoboehm_hobbydevs)
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=leoboehm_hobbydevs&metric=vulnerabilities)](https://sonarcloud.io/summary/new_code?id=leoboehm_hobbydevs)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=leoboehm_hobbydevs&metric=bugs)](https://sonarcloud.io/summary/new_code?id=leoboehm_hobbydevs)
[![Lines of Code](https://sonarcloud.io/api/project_badges/measure?project=leoboehm_hobbydevs&metric=ncloc)](https://sonarcloud.io/summary/new_code?id=leoboehm_hobbydevs)

---

## About the Project
This repository is part of a scientific case study conducted within the scope of a DHBW Computer Science thesis. The focus is on improving the maintainability and reliability of the *HobbyDevs* web application, originally developed as a student project.<br>
The *Hobbydevs* platform is designed to facilitate small-scale software collaborations outside of a traditional corporate context. Its purpose is to provide a platform that connects so-called Project Owners with Hobby Developers. Project Owners can publish software project ideas and define their requirements (scope, required skills, time frame, budget), while Hobby Developers create profiles outlining their skills and interests and can apply for projects.

---

## Tech Stack

- **Backend:** Laravel (PHP)
- **Frontend:** Vue.js
- **Database:** MySQL
- **Testing:** PHPUnit

---

## Setup & Installation

```bash
# Clone repository
git clone https://github.com/leoboehm/hobbydevs.git
cd hobbydevs

# Install backend dependencies
composer install

# Install frontend dependencies
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database migration
php artisan migrate --seed

# Run development server
php artisan serve
npm run dev
```
You can now access the application at `127.0.0.1:8000`.<br>
**Note**: The backend and frontend are not configured for cross-origin communication. The application will **only** work at `127.0.0.1`, not at `localhost`.<br>
**Note**: If you get database errors, make sure MySQL is installed and running on your machine. You might have to add your MySQL socket location to the `.env` file. Example:
```env
DB_SOCKET=/opt/lampp/var/mysql/mysql.sock
```

## Testing
without coverage:
```bash
# Without coverage
php artisan test

# With test coverage (using clover)
XDEBUG_MODE=coverage php artisan test –coverage-html “reports/clover_html”
```
Open `hobbydevs/reports/clover_html/index.html` to view the clover report.<br>
**Note**: Running tests locally resets the database. Run the following command afterwards, to seed the table again:
```bash
php artisan migrate --fresh --seed
```

---

## Contribution Notes
This repository is not an open contribution project.
It is maintained for academic purposes to document systematic refactoring, testing, and evaluation.

## License
This repository is considered closed-source for academic use.
