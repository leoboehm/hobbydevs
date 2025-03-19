Feature: Publish Project

  As a Project Owner
  I want to publish a new project
  So that I can find suitable developers to work on my project

  Scenario: Successful project creation
    Given the Project Owner is logged in
    When the Project Owner clicks on the "Publish Project" button
    And the Project Owner fills up the project creation form with valid project detail data
    And the Project Owner clicks on the "Next" button
    And the Project Owner fills up the project creation form with valid duration and salary data (Project Salary Range, Project Duration, Start Date, Deadline)
    And the Project Owner clicks on the "Next" button
    And the Project Owner fills up the project creation form with valid application data (Start Date, End Date)
    And the Project Owner clicks on the "Submit" button
    Then the project is successfully published

  Scenario: Project creation with missing or invalid data
    Given the Project Owner is logged in
    When the Project Owner clicks on the "Publish Project" button
    And the Project Owner fills up the project creation form with missing or invalid data
    And the Project Owner clicks on the "Next" or "Submit" button
    Then the system displays an error message
    And the Project Owner is prompted to correct the information

  Scenario: Project Owner decides not to publish the project
    Given the Project Owner is logged in
    When the Project Owner clicks on the "Publish Project" button
    And the Project Owner decides to cancel the process
    Then the Project Owner is able to cancel the operation
    And no project is published
