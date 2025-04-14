# Test Plan for HobbyDevs

## Table of Contents
- [1. Introduction](#1-introduction)
  - [1.1 Purpose](#11-purpose)
  - [1.2 Scope](#12-scope)
  - [1.3 Intended Audience](#13-intended-audience)
  - [1.4 Document Terminology and Acronyms](#14-document-terminology-and-acronyms)
  - [1.5 References](#15-references)
  - [1.6 Document Structure](#16-document-structure)
- [2. Evaluation Mission and Test Motivation](#2-evaluation-mission-and-test-motivation)
  - [2.1 Background](#21-background)
  - [2.2 Evaluation Mission](#22-evaluation-mission)
  - [2.3 Test Motivators](#23-test-motivators)
- [3. Target Test Items](#3-target-test-items)
- [4. Outline of Planned Tests](#4-outline-of-planned-tests)
  - [4.1 Outline of Test Inclusions](#41-outline-of-test-inclusions)
  - [4.2 Outline of Other Candidates for Potential Inclusion](#42-outline-of-other-candidates-for-potential-inclusion)
  - [4.3 Outline of Test Exclusions](#43-outline-of-test-exclusions)
- [5. Test Approach](#5-test-approach)
  - [5.1 Initial Test-Idea Catalogs and Reference Sources](#51-initial-test-idea-catalogs-and-reference-sources)
  - [5.2 Testing Techniques and Types](#52-testing-techniques-and-types)
- [6. Entry and Exit Criteria](#6-entry-and-exit-criteria)
  - [6.1 Test Plan Entry Criteria](#61-test-plan-entry-criteria)
  - [6.2 Test Plan Exit Criteria](#62-test-plan-exit-criteria)
- [7. Deliverables](#7-deliverables)
- [8. Testing Workflow](#8-testing-workflow)
- [9. Environmental Needs](#9-environmental-needs)
  - [9.1 Hardware](#91-hardware)
  - [9.2 Software](#92-software)
- [10. Responsibilities](#10-responsibilities)
- [11. Iteration Milestones](#11-iteration-milestones)
- [12. Risks, Dependencies](#12-risks-dependencies)
- [13. Management Processes](#13-management-processes)

---

## 1. Introduction

### 1.1 Purpose
The purpose of this Test Plan is to define the strategy and approach for testing the HobbyDevs platform. The platform connects developers and project owners, enabling them to collaborate on creative ideas.

### 1.2 Scope
This test plan covers functional, UI, API, and integration testing for the HobbyDevs web platform. It includes:
- User authentication
- Profile editing
- Project management
- Application submission

It excludes testing of third-party services or packages.

### 1.3 Intended Audience
- Developers
- QA Testers
- Project Managers
- Professors and Graders (for academic review)

### 1.4 Document Terminology and Acronyms

| Abbreviation | Meaning                                |
|--------------|----------------------------------------|
| API          | Application Programming Interface      |
| CI           | Continuous Integration                 |
| UI           | User Interface                         |
| TDD          | Test Driven Development                |
| DB           | Database                               |
| IDE          | Integrated Development Environment     |

### 1.5 References

| Title                            | Date     | Organization           |
|----------------------------------|----------|------------------------|
| HobbyDevs GitHub Repository      | 2025-04  | DHBW Student Project   |
| Software Requirements Spec (SRS) | 2025-03  | Student team           |

### 1.6 Document Structure
This document follows the recommended RUP structure, including motivation, testing types, tools, responsibilities, and deliverables.

---

## 2. Evaluation Mission and Test Motivation

### 2.1 Background
HobbyDevs is a dual-user role platform (Developer and Project Owner) where developers can apply to open projects. Core features include:
- Clear profile view
- Editable user information
- Secure login
- Clear project listing and detail view

### 2.2 Evaluation Mission
To validate that core features of the HobbyDevs platform function as expected and deliver a consistent, secure, and smooth user experience.

### 2.3 Test Motivators
- Recent implementation of editable user profiles
- User role logic (e.g., only developers should be able to apply)
- Form validation (sign up, profile, project posting)
- Routing and Vue/Vuetify rendering

---

## 3. Target Test Items
- Vue.js Views (e.g., ProfileView, ProjectsView)
- Laravel API endpoints (e.g., /user, /projects, /applications)
- Axios integration
- Pinia store modules (authStore, projectStore)

---

## 4. Outline of Planned Tests

### 4.1 Outline of Test Inclusions
**Frontend:**
- Form validation and input handling
- Profile edit logic
- Component rendering and navigation

**Backend:**
- Laravel API tests (using PHPUnit)
- Authentication tests with Sanctum

### 4.2 Outline of Other Candidates for Potential Inclusion
- Accessibility checks
- Performance and load tests for submitting applications

### 4.3 Outline of Test Exclusions
- Vue component styling (unless it affects usability)
- Third-party package testing (e.g., Vuetify internals)

---

## 5. Test Approach

### 5.1 Initial Test-Idea Catalogs and Reference Sources
- Use case documents
- Vue component structure
- Laravel API route and controller files

### 5.2 Testing Techniques and Types
Refer to RUP table templates for Functional, UI, Stress, Security, and other testing types.

---

## 6. Entry and Exit Criteria

### 6.1 Test Plan Entry Criteria
- Profile editing and API endpoint `/user` are implemented.
- Routes are set up and protected correctly.

### 6.2 Test Plan Exit Criteria
- 100% of critical tests pass.
- No blocker issues in Profile, Auth, and Project flows.

---

## 7. Deliverables

- **Test Evaluation Summaries:**
  - Cypress test reports (frontend)
  - PHPUnit reports (backend)
- **Test Coverage Reporting:**
  - Reports via Cypress and Laravel test coverage plugins
- **Incident Logs:**
  - Development log entries in commits
- **Smoke Test Scripts:**
  - Loading homepage, login, and profile edit as a base test

---

## 8. Testing Workflow
- Use GitHub Actions for automated testing.
- Run Cypress and Laravel tests locally during development.
- Commit screenshots of test runs in IDE.

---

## 9. Environmental Needs

### 9.1 Hardware
- Developer machine
- Local Laravel development server

### 9.2 Software
- Node.js, Vue 3, Laravel 10
- Cypress + Cucumber plugin (frontend)
- PHPUnit (backend)

---

## 10. Responsibilities

| Role               | Name            | Responsibility                       |
|--------------------|-----------------|--------------------------------------|
| Developer          | Yasi            | Implement test cases, run frontend   |
| Backend Developer  | Leonie          | Write PHPUnit tests for API          |
| QA Reviewer        | (Professor)     | Review test plan, validate coverage  |

---

## 11. Iteration Milestones
- **Project Creation Tests:** ✅ Done  
- **Application Flow Tests:** ⏳ In progress  
- **Prfile Editing Tests:** 🔜 Next  

---

## 12. Risks, Dependencies

| Risk                         | Mitigation Plan                               |
|------------------------------|-----------------------------------------------|
| tba         |                 |

---

## 13. Management Processes
- Managed via YouTrack project board and issues.
