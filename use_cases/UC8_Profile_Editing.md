# Use Case Specification: Profile Editing

## 1. Profile Editing

### 1.1 Brief Description  
This use case describes how a user can edit their profile information within the system. The user can update personal details such as their first name, last name, username and email address. The user can also see their applications.

### 1.2 Mockup  
*Include a mockup of the profile editing page here.*  
📌 *[Insert image or link to mockup]*

### 1.3 Screenshots  
*Include actual screenshots of the implemented interface (if available).*  
📌 *[Insert screenshots]*

## 2. Flow of Events

### 2.1 Basic Flow  
1. The user navigates to their profile page.  
2. The system displays the current profile information.  
3. The user selects the "Edit Profile" option.  
4. The system presents editable fields for the user to update.  
5. The user modifies the desired fields.  
6. The user submits the changes.  
7. The system validates the input and updates the profile.  
8. A confirmation message is displayed to the user.

#### Activity Diagram  
![Activity Diagram](../activity_diagrams/uc8_profile_editing.png)

### 2.2 Alternative Flows  
- **Invalid Input:**  
  - If the user submits incomplete or invalid data (e.g., invalid email format), the system highlights the errors and requests correction.  
- **Cancel Editing:**  
  - The user may choose to cancel the editing process, returning to the profile view without saving changes.

## 3. Special Requirements  
- The system must validate all fields before saving changes.  
- Email addresses must follow proper formatting rules.  
- Profile updates must be confirmed before submission.

## 4. Preconditions  
- The user must be logged into their account.  
- The user must have an existing profile.

## 5. Postconditions  
- The user’s profile is successfully updated and saved in the system.  
- The system reflects the changes immediately or upon the next login.

## 6. Function Points  
- User Interface for editing profile fields  
- Input validation  
- Viewing user’s application history  
- Confirmation and error handling

## 7. CRUD Operation  
This Use Case represents an "Update" operation in the CRUD model, as it involves modifying the user's existing profile information.

