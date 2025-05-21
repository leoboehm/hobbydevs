Feature: Profile Editing
  As a registered user
  I want to edit my profile information
  So that I can keep my details up to date

  Scenario Outline: Successful Profile Update
    Given the user is logged in
    And the user navigates to the profile page
    And the user enters "<field>" with "<new_value>"
    When the user clicks the "Save Changes" button
    Then the profile is successfully updated
    And a confirmation message is displayed

    Examples:
      | field      | new_value         |
      | First Name | John              |
      | Last Name  | Doe               |
      | Username   | johnnydoe         |
      | Email      | john@example.com  |

  Scenario: Invalid Email Format
    Given the user is logged in
    And the user navigates to the profile page
    And the user enters "Email" with "invalid-email"
    When the user clicks the "Save Changes" button
    Then an error message is displayed indicating the email format is invalid
    And the profile is not updated

  Scenario: Cancel Editing
    Given the user is logged in
    And the user navigates to the profile page
    When the user clicks the "Cancel" button
    Then the user is returned to the profile page without saving changes

  Scenario: Missing Required Fields
    Given the user is logged in
    And the user navigates to the profile page
    And the user clears a required field
    When the user clicks the "Save Changes" button
    Then an error message is displayed indicating the required field is missing
    And the profile is not updated
