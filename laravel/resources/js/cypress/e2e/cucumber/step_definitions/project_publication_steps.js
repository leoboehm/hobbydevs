import { Given, When, Then, Before } from '@badeball/cypress-cucumber-preprocessor';

Before(() => {
  cy.wrap({
    isLoggedIn: false,
    projectData: {},
    published: false,
    errorMessage: ''
  }).as('projectPublishing');
});

Given('the Project Owner is logged in', () => {
  cy.get('@projectPublishing').then(state => {
    state.isLoggedIn = true;
    cy.wrap(state).as('projectPublishing');
  });
});

When('the Project Owner clicks on the "Publish new project" button', () => {
  cy.get('button').contains('Publish new project').click();
});

When('the Project Owner fills up the project creation form with valid data', () => {
  cy.get('input[name="title"]').type('New Project');
  cy.get('textarea[name="description"]').type('This is a valid project description');
  cy.get('@projectPublishing').then(state => {
    state.projectData = { title: 'New Project', description: 'This is a valid project description' };
    cy.wrap(state).as('projectPublishing');
  });
});

When('the Project Owner fills up the project creation form with missing or invalid data', () => {
  cy.get('input[name="title"]').clear();
  cy.get('textarea[name="description"]').clear();
  cy.get('@projectPublishing').then(state => {
    state.projectData = { title: '', description: '' };
    cy.wrap(state).as('projectPublishing');
  });
});

When('the Project Owner clicks on the "Next" button', () => {
  cy.get('button').contains('Next').click();
  cy.get('@projectPublishing').then(state => {
    if (!state.projectData.title || !state.projectData.description) {
      state.errorMessage = 'Invalid project data';
      cy.wrap(state).as('projectPublishing');
    }
  });
});

Then('the system displays an error message', () => {
  cy.get('@projectPublishing').then(state => {
    expect(state.errorMessage).to.equal('Invalid project data');
  });
  cy.contains('Invalid project data').should('be.visible');
});

Then('the Project Owner is prompted to correct the information', () => {
  cy.get('@projectPublishing').then(state => {
    expect(state.errorMessage).to.not.be.empty;
  });
});

When('the Project Owner checks the detailed information page', () => {
  cy.url().should('include', '/project/details');
  cy.contains('Project Details').should('be.visible');
});

When('the Project Owner clicks the "Publish" button', () => {
  cy.get('button').contains('Publish').click();
  cy.get('@projectPublishing').then(state => {
    state.published = true;
    cy.wrap(state).as('projectPublishing');
  });
});

Then('the project is successfully published', () => {
  cy.get('@projectPublishing').then(state => {
    expect(state.published).to.be.true;
  });
  cy.contains('Project published successfully').should('be.visible');
});

Then('the Project Owner receives a notification of the new application', () => {
  cy.contains('Notification received').should('be.visible');
});

When('the Project Owner decides not to continue the process', () => {
  cy.get('button').contains('Cancel').click();
});

Then('the Project Owner can cancel the operation', () => {
  cy.get('button').contains('Publish').should('exist');
});

Then('no project is published', () => {
  cy.get('@projectPublishing').then(state => {
    expect(state.published).to.be.false;
  });
});
