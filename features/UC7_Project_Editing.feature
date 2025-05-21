Feature: Editing a Project
  As a project owner
  I want to edit the details of a project I posted
  So that I can update information like title, category, skills, salary, and duration

  Background:
    Given the user is logged in as a project owner
    And the user has posted a project

  Scenario Outline: Successful project edit
    Given the project owner clicks the "Edit" button
    And updates the "<field>" with "<newValue>"
    When the project owner clicks the "Save" button
    Then the project is updated with the new information
    And a success message is displayed

    Examples:
      | field        | newValue               |
      | Title        | Hobby Devs Updated     |
      | Description  | A new description here |
      | Category     | Web Development        |
      | Skills       | Vue, Laravel, Docker   |
      | Salary Range | Not Paid               |
      | Duration     |               3 Months |

  Scenario: Required field missing
    Given the project owner clicks the "Edit" button
    And clears the "Title" field
    When the project owner clicks the "Save" button
    Then an error message is displayed indicating the title is required
    And the changes are not saved

  Scenario: Invalid form input
    Given the project owner enters an empty skill list
    When the project owner clicks the "Save" button
    Then an error message is shown
    And the project data remains unchanged
