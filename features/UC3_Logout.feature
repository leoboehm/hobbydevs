Feature: User Logout
  As a logged-in user
  I want to log out of the platform
  So that I can end my session securely

  Scenario: Successful logout
    Given the user is logged in
    When the user clicks the "Logout" button
    Then the user is successfully logged out
    And the system redirects them to the homepage

  Scenario: Logout confirmation (optional)
    Given the user clicks "Logout"
    When the confirmation message is shown
    And the user confirms logout
    Then the user is logged out
    And redirected to the login page
