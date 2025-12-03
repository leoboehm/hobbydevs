# HobbyDevs – Refactoring & Quality Improvement

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

This repository is part of a **scientific case study** conducted within the scope of a DHBW Mosbach Computer Science thesis.  
The focus is on improving the **maintainability** and **reliability** of the *HobbyDevs* web application, originally developed as a student project.

Key challenges in the existing codebase:
- High technical debt due to inconsistent coding standards  
- Incomplete and unstable features (session handling, database interactions)  
- Low and fragmented automated test coverage (Cypress non-functional, PHPUnit incomplete)  

The work in this repository does not only aim to repair the application, but to serve as a **systematic strategy for quality improvement**, documented with measurable software quality metrics.

---

## Objectives

1. **Baseline Analysis**  
   - Collect software quality metrics (Maintainability Index, Cyclomatic Complexity, Test Coverage, Bug Count).  
   - Document current weaknesses in architecture and implementation.  

2. **Refactoring for Maintainability**  
   - Apply systematic refactoring and introduce coding standards.  
   - Reduce complexity and technical debt.  

3. **Reliability Improvements**  
   - Repair broken features.  
   - Ensure robust session and database handling.  

4. **Testing & QA**  
   - Restore and extend Cypress frontend tests.  
   - Improve PHPUnit coverage for backend logic.  
   - Introduce automated CI/CD quality checks.  

5. **Evaluation**  
   - Compare quality metrics before and after improvements.  
   - Document findings in the context of software engineering literature.  

---

## Tech Stack

- **Backend:** Laravel (PHP)  
- **Frontend:** Vue.js  
- **Database:** MySQL  
- **Testing:** PHPUnit, Cypress, Cucumber  
- **Code Quality:** SonarCloud, ESLint, PHPStan  

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

## Testing
### Backend (PHPUnit)
```bash
php artisan test
```

### Frontend (Cypress)
```bash
npm run cypress:open
```

---

## Contribution Notes
This repository is not an open contribution project.
It is maintained for academic purposes to document systematic refactoring, testing, and evaluation.

## License
This repository is considered closed-source for academic use.
