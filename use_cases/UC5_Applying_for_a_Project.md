# Use-Case Specification: Applying for a Project

# 1. Applying for a Project

## 1.1 Brief Description
This use case allows hobby developers to apply for a project by filling out an application form. The form should include relevant information to help project owners evaluate candidates. If a developer wants to apply for a project, they need to fill in the following fields:

- Developer Name (Full name)
- Skills (relevant technical skills)
- Availability (start date, hours per week)
- Past Experience (brief description of relevant projects)
- Motivation (reason for applying)
- Contact Information (email or phone)


## 1.2 Mockup 
![Mockup Applying for a Project](../mockups/uc5_applying_for_a_project_mockup.png)

## 1.3 Screenshots
### Submit Action
![Submit Action](../screenshots/uc5_validation.jpg)

### Input Missing
![Input Missing](../screenshots/uc5_input_missing.png)

### Form Validation Error
![Form Validation Error](../screenshots/uc5_error.jpg)

# 2. Flow of Events

## 2.1 Basic Flow
- The developer clicks on the "Apply for Project" button.
- The "Application Form" template pops up.
- The developer fills in the template.
- The developer clicks on the "Submit" button.
- The application is sent to the project owner.

### Activity Diagram
![Activity Diagram](../activity_diagrams/UC5_activity_diagram_applying_for_a_project.png)

### .feature File
[.feature File Applying for a Project](../features/uc5_applying_for_a_project)
```Cucumber
Feature: Use Case 2 Applying for a Project
  As a DEVELOPER
  I want to open the project details page and apply for a project
  Therefore I want the fields: name, skills, availability, experience, and motivation to be available for input

  Background:
    Given The developer is logged in
    And Project Details page is open

  @apply-project-feature
  Scenario Outline: Submit an application for a project
    When The developer types the name <name> and the input is correct
    And The developer types the skills <skills>
    And The developer selects the availability <availability>
    And The developer types the past experience <experience>
    And The developer types the motivation <motivation>
    And The developer presses the submit button
    Then The application is sent
    And A confirmation message is shown

    Examples: Applications
      | name       | skills              | availability  | experience                | motivation            |
      | Jane Smith | Java, Flutter       | Immediate     | Built an app for a client | Interested in app dev  |
      | John Doe   | Python, Django      | In two weeks  | Led backend dev projects  | Love the project idea  |

  @apply-project-feature
  Scenario: Leaving the Application Form without submitting
    When The developer presses the Back button
    Then No request is sent
    And The application form is closed

```

## 2.2 Alternative Flows
- The developer cancels the application before submitting.
- The developer submits incomplete or incorrect data.

# 3. Special Requirements
- Form validation for mandatory fields (e.g., name, contact information).
- Data privacy considerations (sensitive info like contact details).

# 4. Preconditions
- The developer is logged in to the platform.
- The developer has clicked on the "Apply for Project" button.

# 5. Postconditions
- The application is sent to the project owner.
- The project owner receives a notification of a new application.

# 6. Function Points
n/a

# 7. CRUD Operation
This Use Case represents the "Create" operation in the CRUD (Create, Read, Update, Delete) model, as it involves the creation of an application by the developer.
