Feature: Applying for a Project
  As a hobby developer
  I want to apply for a project by filling out an application form
  So that I can be considered for the project by the project owner

  Background:
    Given the user is logged in as a hobby developer

  Scenario Outline: Successful application submission
    Given the developer fills in "<field>" with "<value>"
    When the developer clicks the "Submit" button
    Then the application is successfully submitted
    And a confirmation message "Application submitted successfully." is shown

  Examples:
    | field               | value                    |
    | Developer Name      | Yasaman Pandand          |
    | Skills              | Java, Python             |
    | Availability        | 20 hours/week            |
    | Past Experience     | Developed mobile apps    |
    | Motivation          | I am passionate about this project |
    | Contact Information | yasaman@gmail.com      |

  Scenario: Missing information error
    Given the developer leaves the "Skills" field empty
    When the developer clicks the "Submit" button
    Then the form is not submitted
    And an error message "Skills is required." is displayed

  Scenario: Form validation error
    Given the developer fills in "Skills" with "JS"
    And the developer enters an invalid email in the "Contact Information" field
    When the developer clicks the "Submit" button
    Then the form is not submitted
    And an error message "Invalid email address." is displayed
    