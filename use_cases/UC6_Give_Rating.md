# Use-Case Specification: Give Rating

# 1. Give Rating

## 1.1 Brief Description
In this feature, a project owner can rate a developer after collaborating on a project. The rating helps provide feedback and build trust within the platform. The rating is given on a scale from 1 to 5 stars and is displayed publicly on the developer’s profile.

## 1.2 Mockup 
![rate](https://github.com/user-attachments/assets/e6d2b3c7-7457-44fa-9a3b-5d831fbf175a)


## 1.3 Screenshots
![Screenshot 2025-05-21 at 20 30 48](https://github.com/user-attachments/assets/5fde2534-765a-467a-a31e-69afbf999f12)
![Screenshot 2025-05-21 at 20 30 31](https://github.com/user-attachments/assets/de722ef8-0ba3-4655-a8df-1d0447e3a254)
![Screenshot 2025-05-21 at 20 30 48](https://github.com/user-attachments/assets/0ba5a66a-e8be-4a9f-8ee9-e2b4b4db620d)


# 2. Flow of Events


## 2.1 Basic Flow
1. Project owner logs into the system.
2. Navigates to a developer's profile (after working on a project).
3. Clicks the "Give Rating" button.
4. Selects a rating from 1 to 5 stars.
5. Clicks "Save".
6. System calculates the new average rating and stores it.
7. Developer’s profile is updated with the new rating.

### Activity Diagram

### .feature File
The Gherkin script for this use case is available [here](../features/UC6_Give_Rating.feature).
```gherkin
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
```

## 2.2 Alternative Flows
If the developer has already been rated by this project owner for the project, a message prevents multiple ratings.

If there is a network or server error while saving, a warning is shown and the action is aborted.

# 3. Special Requirements
1.Only project owners should see the "Give Rating" option.

2.A developer’s average rating should be dynamically recalculated based on all ratings.

# 4. Preconditions
User must be logged in.

User must be a project owner.

There must be a completed project involving the developer.

# 5. Postconditions
The developer's rating is stored in the database.

The developer's profile reflects the new average rating.

# 6. Function Points
n/a

# 7. CRUD Operation
