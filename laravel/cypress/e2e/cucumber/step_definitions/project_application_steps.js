import { Given, When, Then } from '@badeball/cypress-cucumber-preprocessor';

const submitApplication = (data) => {
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!data['Skills'] || !data['Contact Information']) {
    return { success: false, message: 'Please fill all required fields.' };
  }

  if (data['Contact Information'] && !emailPattern.test(data['Contact Information'])) {
    return { success: false, message: 'Invalid email address.' };
  }

  return { success: true, message: 'Application submitted successfully.' };
};

Given('the user is logged in as a hobby developer', () => {
  cy.wrap({ userRole: 'hobby developer' }).as('userData');
  cy.wrap({}).as('formData');
});

Given('the developer fills in {string} with {string}', (field, value) => {
  cy.get('@formData').then((data) => {
    data[field] = value;
    cy.wrap(data).as('formData');
  });
});

Given('the developer leaves the {string} field empty', (field) => {
  cy.get('@formData').then((data) => {
    data[field] = '';
    cy.wrap(data).as('formData');
  });
});

Given('the developer enters an invalid email in the {string} field', (field) => {
  cy.get('@formData').then((data) => {
    data[field] = 'invalid-email';
    cy.wrap(data).as('formData');
  });
});

When('the developer clicks the {string} button', (button) => {
  if (button === 'Submit') {
    cy.get('@formData').then((data) => {
      const response = submitApplication(data);
      cy.wrap(response.success).as('isFormSubmitted');
      cy.wrap(response.success ? response.message : '').as('confirmationMessage');
      cy.wrap(response.success ? '' : response.message).as('errorMessage');
    });
  }
});

Then('the application is successfully submitted', () => {
  cy.get('@isFormSubmitted').should('be.true');
});

Then('a confirmation message is shown', () => {
  cy.get('@confirmationMessage').should('equal', 'Application submitted successfully.');
});

Then('an error message is displayed', () => {
  cy.get('@errorMessage').should('not.be.empty');
});

Then('the form is not submitted', () => {
  cy.get('@isFormSubmitted').should('be.false');
});

Then('an error message is displayed indicating the email is invalid', () => {
  cy.get('@errorMessage').should('equal', 'Invalid email address.');
});

Then('an error message is displayed indicating that all fields are required', () => {
  cy.get('@errorMessage').should('equal', 'Please fill all required fields.');
});
