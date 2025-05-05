import { Given, When, Then } from '@badeball/cypress-cucumber-preprocessor';

// Scenario 1: Successful project creation

Given('the Project Owner is logged in', () => {
  cy.visit('http://localhost:8000');
});

When('the Project Owner clicks on the "Publish Project" button', () => {
  // Code to click on the "Publish Project" button
  cy.get('a').contains('Publish Project').click();
});

When('the Project Owner fills up the project creation form with valid project detail data', () => {
  // Fill in the project detail form
  cy.get('#project-title').type('New Web Development Project');
  cy.get('#project-description').type('A project to develop a web application');
  cy.get('#category').select('Web Development');
  cy.get('#skills').select('HTML, CSS, JavaScript');
});

When('the Project Owner clicks on the "Next" button', () => {
  // Click on the "Next" button
  cy.get('button').contains('Next').click();
});

When('the Project Owner fills up the project creation form with valid duration and salary data (Project Salary Range, Project Duration, Start Date, Deadline)', () => {
  // Fill in duration and salary details
  cy.get('#salary-range').type('€5000 - €7000');
  cy.get('#project-duration').type('3 months');
  cy.get('#start-date').type('2025-04-01');
  cy.get('#deadline').type('2025-06-30');
});

When('the Project Owner clicks on the "Next" button', () => {
  // Click on the "Next" button
  cy.get('button').contains('Next').click();
});

When('the Project Owner fills up the project creation form with valid application data (Start Date, End Date)', () => {
  // Fill in application data
  cy.get('#application-start-date').type('2025-04-01');
  cy.get('#application-end-date').type('2025-04-30');
});

When('the Project Owner clicks on the "Submit" button', () => {
  // Click on the "Submit" button
  cy.get('button').contains('Submit').click();
});

Then('the project is successfully published', () => {
  // Check that the project has been published (e.g., a success message or redirection)
  cy.url().should('include', '/project/overview');
  cy.contains('Project successfully published').should('be.visible');
});


// Scenario 2: Project creation with missing or invalid data

When('the Project Owner fills up the project creation form with missing or invalid data', () => {
  // Fill out the form with missing or invalid data
  cy.get('#project-title').type(''); // Empty project title
  cy.get('#project-description').type(''); // Empty description
  cy.get('#category').select(''); // No category selected
  cy.get('#skills').type(''); // No skills provided
});

When('the Project Owner clicks on the "Next" or "Submit" button', () => {
  // Click on the "Next" or "Submit" button, depending on where the form is at
  cy.get('button').contains('Next').click();
});

Then('the system displays an error message', () => {
  // Check for an error message on the page
  cy.contains('Please fill out all required fields').should('be.visible');
});

Then('the Project Owner is prompted to correct the information', () => {
  // Ensure the form fields are still highlighted or a prompt is shown to correct errors
  cy.get('#project-title').should('have.class', 'is-invalid');
  cy.get('#project-description').should('have.class', 'is-invalid');
  cy.get('#category').should('have.class', 'is-invalid');
  cy.get('#skills').should('have.class', 'is-invalid');
});


// Scenario 3: Project Owner decides not to publish the project

When('the Project Owner decides to cancel the process', () => {
  // Code to cancel the project creation process
  cy.get('button').contains('Cancel').click();
});

Then('the Project Owner is able to cancel the operation', () => {
  // Check that the Project Owner has been redirected or the modal is closed
  cy.url().should('not.include', '/project/create');
  cy.contains('Project creation cancelled').should('be.visible');
});

Then('no project is published', () => {
  // Ensure that no project is published or visible
  cy.contains('No projects found').should('be.visible');
});
