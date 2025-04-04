# Use-Case Specification: Publish Project

# 1. Publish Project

## 1.1 Brief Description
Every normal user can create new operations, making him the owner of the newly created project. In this process, the project owner should provide detailed information for users to look at and select the project that they want to participate in. These are the fields that are necessary for any project to be published:

- project name
- project category
- employment type
- required skills
- project description
- salary range(must have)
- duration of the project
- application requirment

By filing up the form as detailed as possible, the project owner can find the most suitable developer to help his project.

## 1.2 Mockup 
![Mockup Publish project](../mockups/UC4_Publsih_project_mockup.png)

# 2. Flow of Events

## 2.1 Basic Flow
1. The project owner clicks on the "Publish new project" button.
2. The project owner fills up the form.
3. The project owner clicks on "Next" button.
4. The project owner checks the detailed form.
5. The project owner clicks the button "Publish" to publish the new project.

### Activity Diagram
![Activity diagram Publish project](../activity_diagrams/UC4_activity_Publish_project.png)

### .feature File
The Gherkin script for this use case is available [here](../features/UC4_Publish_Project.feature)
```Gherkin
Feature: Publish Project

  As a Project Owner
  I want to publish a new project
  So that I can find suitable developers to work on my project

  Scenario: Successful project creation
    Given the Project Owner is logged in
    When the Project Owner clicks on the "Publish new project" button
    And the Project Owner fills up the project creation form with valid data
    And the Project Owner clicks on the "Next" button
    And the Project Owner checks the detailed information page
    And the Project Owner clicks the "Publish" button
    Then the project is successfully published
    And the Project Owner receives a notification of the new application

  Scenario: Project creation with missing or invalid data
    Given the Project Owner is logged in
    When the Project Owner clicks on the "Publish new project" button
    And the Project Owner fills up the project creation form with missing or invalid data
    And the Project Owner clicks on the "Next" button
    Then the system displays an error message
    And the Project Owner is prompted to correct the information

  Scenario: Project Owner decides not to publish the project
    Given the Project Owner is logged in
    When the Project Owner clicks on the "Publish new project" button
    And the Project Owner decides not to continue the process
    Then the Project Owner can cancel the operation
    And no project is published
```
## 2.2 Alternative Flows
- The project owner decided not to publish the project before submitting.
- The project owner submits incomplete or incorrect data.

# 3. Special Requirements
- Form validation for mandatory fields (e.g., project name, salary range).

# 4. Preconditions
- The project owner is logged in.

# 5. Postconditions
- The project owner receives a notification of new applicaton.

# 6. Function Points
n/a

# 7. CRUD Operation
This Use Case represents the "Create" operation in the CRUD (Create, Read, Update, Delete) model, as it involves the creation of a project by a project owner.
