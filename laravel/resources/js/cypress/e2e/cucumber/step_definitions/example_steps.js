import { Given, Then } from '@badeball/cypress-cucumber-preprocessor';

Given('I visit the home page', () => {
  cy.visit('http://localhost:8000');
});

Then('I should see the welcome message', () => {
  cy.get('h1').should('contain', 'Welcome to HobbyDevs!');
});
