const { Given, When, Then } = require('@cucumber/cucumber');
const assert = require('assert');

let formData = {};
let confirmationMessage = '';
let errorMessage = '';
let isFormSubmitted = false;

// Helper function to validate and submit application
const submitApplication = (data) => {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Check for required fields
    if (!data['Skills'] || !data['Contact Information']) {
        return { success: false, message: 'Please fill all required fields.' };
    }

    // Check for valid email format
    if (data['Contact Information'] && !emailPattern.test(data['Contact Information'])) {
        return { success: false, message: 'Invalid email address.' };
    }

    // If validation passes
    return { success: true, message: 'Application submitted successfully.' };
};

// Scenario: User is logged in as a hobby developer
Given('the user is logged in as a hobby developer', function () {
    this.userRole = 'hobby developer';
    formData = {}; // Reset form data for each scenario
});

// Scenario: Filling the form
Given('the developer fills in {string} with {string}', function (field, value) {
    formData[field] = value;
});

// Scenario: Leaving a field empty
Given('the developer leaves the {string} field empty', function (field) {
    formData[field] = '';
});

// Scenario: Entering an invalid email
Given('the developer enters an invalid email in the {string} field', function (field) {
    formData[field] = 'invalid-email';
});

// Scenario: Form submission
When('the developer clicks the {string} button', function (button) {
    if (button === 'Submit') {
        const response = submitApplication(formData);
        isFormSubmitted = response.success;
        confirmationMessage = response.success ? response.message : '';
        errorMessage = response.success ? '' : response.message;
    }
});

// Scenario: Successful submission check
Then('the application is successfully submitted', function () {
    assert.strictEqual(isFormSubmitted, true);
});

Then('a confirmation message is shown', function () {
    assert.strictEqual(confirmationMessage, 'Application submitted successfully.');
});

// Scenario: Error handling for missing fields or invalid inputs
Then('an error message is displayed', function () {
    assert.ok(errorMessage);
});

Then('the form is not submitted', function () {
    assert.strictEqual(isFormSubmitted, false);
});

Then('an error message is displayed indicating the email is invalid', function () {
    assert.strictEqual(errorMessage, 'Invalid email address.');
});

Then('an error message is displayed indicating that all fields are required', function () {
    assert.strictEqual(errorMessage, 'Please fill all required fields.');
});
