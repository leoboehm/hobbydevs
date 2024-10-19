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
