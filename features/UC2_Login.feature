Feature: User Login
  As a registered user
  I want to log into the platform
  So that I can access my personal dashboard

  Scenario Outline: Successful login
    Given the user enters "<field>" with "<value>"
    When the user clicks the "Submit" button
    Then the user is successfully logged in
    And they are redirected to their dashboard

  Examples:
    | field          | value       |
    | Username       | johndoe     |
    | Password       | correctpass |

  Scenario: Incorrect password
    Given the user enters a valid username but incorrect password
    When the user clicks the "Submit" button
    Then an error message is displayed
    And the user is not logged in

  Scenario: Missing credentials
    Given the user leaves the "Password" field empty
    When the user clicks the "Submit" button
    Then an error message is displayed indicating the missing information
    And the user is not logged in
