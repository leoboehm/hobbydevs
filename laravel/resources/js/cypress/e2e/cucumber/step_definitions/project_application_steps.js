import { Given, When } from '@badeball/cypress-cucumber-preprocessor';

Given('the user is logged in as a hobby developer', () => {
  cy.wrap({ userRole: 'hobby developer' }).as('userData');
  cy.wrap({}).as('formData');
});

Given('the developer fills in {string} with {string}', (field, value) => {
  cy.get('@formData').then(data => {
    data[field] = value;
    cy.wrap(data).as('formData');
  });
});

Given('the developer leaves the {string} field empty', field => {
  cy.get('@formData').then(data => {
    data[field] = '';
    cy.wrap(data).as('formData');
  });
});

Given('the developer enters an invalid email in the {string} field', field => {
  cy.get('@formData').then(data => {
    data[field] = 'invalid-email';
    cy.wrap(data).as('formData');
  });
});

When('the developer clicks the {string} button', button => {
  if (button === 'Submit') {
    cy.get('@formData').then(data => {
      const { submitApplication } = require('./project_application_validate');
      const response = submitApplication(data);
      cy.wrap(response.success).as('isFormSubmitted');
      cy.wrap(response.message).as('resultMessage');
    });
  }
});


Then('the application is successfully submitted', () => {
  cy.get('@isFormSubmitted').should('be.true');
});

Then('the form is not submitted', () => {
  cy.get('@isFormSubmitted').should('be.false');
});

// one regex-parameterized step for *any* confirmation or error text:
Then(/^(?:a confirmation|an error) message "(.+)" is (?:shown|displayed)$/, expectedMsg => {
  cy.get('@resultMessage').should('equal', expectedMsg);
});
