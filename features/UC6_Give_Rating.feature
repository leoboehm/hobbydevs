Feature: Giving a Rating to a Developer
  As a project owner
  I want to rate a developer after project completion
  So that I can give feedback on their performance

  Background:
    Given the user is logged in as a project owner
    And the project is completed
    And the project owner has access to the developer's profile

  Scenario: Successfully give a rating
    Given the project owner views a developer profile
    And selects a rating of 4 stars
    When the project owner clicks the "Save" button
    Then the rating is submitted
    And a success message is displayed

  Scenario: Try to submit without selecting a rating
    Given the project owner views a developer profile
    And does not select a rating
    When the project owner clicks the "Save" button
    Then an error message is shown
    And the rating is not submitted

  Scenario: Cancel the rating
    Given the project owner starts rating a developer
    When the project owner clicks "Cancel"
    Then the rating input is reset
    And the developer's rating remains unchanged
