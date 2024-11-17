Feature: User Registration
  As a new user
  I want to create an account on the platform
  So that I can access its features and services

  Scenario Outline: Successful Registration
    Given the user enters "<field>" with "<value>"
    When the user clicks the "Submit" button
    Then the account is successfully created
    And the user is redirected to the login page

    Examples:
      | field      | value             |
      | Email      | test@example.com  |
      | Username   | newuser123        |
      | Password   | SecurePass1!      |

  Scenario: Missing Fields
    Given the user leaves one or more required fields empty
    When the user clicks the "Submit" button
    Then an error message is displayed indicating the missing fields
    And the account is not created

  Scenario: Invalid Email Format
    Given the user enters an invalid email address
    When the user clicks the "Submit" button
    Then an error message is displayed indicating the email format is invalid
    And the account is not created

  Scenario: Duplicate Email
    Given the user enters an email that is already registered
    When the user clicks the "Submit" button
    Then an error message is displayed indicating the email is already in use
    And the account is not created
