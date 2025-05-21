# Use-Case Specification: Project Editing

# 1. Project Editing

## 1.1 Brief Description
This use case allows a **Project Owner** to edit the details of a project they have already created. The purpose is to enable updating the title, description, required skills, or any other relevant fields after the project has been posted.

## 1.2 Mockup 

## 1.3 Screenshots

# 2. Flow of Events

## 2.1 Basic Flow
1. Project Owner navigates to the "My Projects" section.
2. Project Owner selects a project and clicks the "Edit" button.
3. The system loads a form pre-filled with the existing project data.
4. The Project Owner modifies one or more fields (e.g., title, description, skills).
5. The Project Owner clicks the "Save" button.
6. The system validates the input and saves the changes.
7. A success message confirms the update, and the user is redirected to the updated project page or overview list.

### Activity Diagram

## 2.2 Alternative Flows
- **Validation Failure**:  
  - If required fields are left empty or the input format is incorrect (e.g., invalid URL), the system displays validation errors and prevents submission until fixed.

- **Cancel Editing**:  
  - If the user clicks "Cancel", the form is closed or reset, and no data is saved.

# 3. Special Requirements
- All fields must be validated client-side and server-side.
- Only the original creator of the project can access the edit function.
- Rich-text support for the project description field.

# 4. Preconditions
- User must be logged in.
- User must have created the project.


# 5. Postconditions
- The project is updated in the database with the new information.
- The updated data is reflected immediately on the UI.

# 6. Function Points
n/a

# 7. CRUD Operation
- **Update**: The use case performs an update on existing project data in the database.
