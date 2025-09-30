const { Given, When, Then, Before } = require('@cucumber/cucumber');
const assert = require('assert');

const projectPublishing = {
    isLoggedIn: false,
    projectData: null,
    published: false,
    notificationReceived: false,
    errorMessage: null,

    login() {
        this.isLoggedIn = true;
    },

    clickPublishNewProject() {
        if (!this.isLoggedIn) throw new Error("User is not logged in");
    },

    fillProjectForm(data) {
        if (!data || data.title === "" || data.description === "") {
            this.errorMessage = "Invalid project data";  
        } else {
            this.projectData = data;
            this.errorMessage = null;
        }
    },

    clickNext() {
        if (this.errorMessage) {
            throw new Error(this.errorMessage);
        }
    },

    checkDetailPage() {},

    clickPublish() {
        if (this.projectData) {
            this.published = true;
            this.notificationReceived = true;
        } else {
            throw new Error("Project not ready for publishing");
        }
    },

    cancelPublishing() {
        this.published = false;
    },

    getErrorMessage() {
        return this.errorMessage;
    }
};

Before(function () {
    projectPublishing.isLoggedIn = false;
    projectPublishing.projectData = null;
    projectPublishing.published = false;
    projectPublishing.notificationReceived = false;
    projectPublishing.errorMessage = null;
});

Given('the Project Owner is logged in', function () {
    projectPublishing.login();
});

When('the Project Owner clicks on the "Publish new project" button', function () {
    projectPublishing.clickPublishNewProject();
});

When('the Project Owner fills up the project creation form with valid data', function () {
    projectPublishing.fillProjectForm({ title: "New Project", description: "This is a valid project description" });
});

When('the Project Owner fills up the project creation form with missing or invalid data', function () {
    projectPublishing.fillProjectForm({ title: "", description: "" });
});

When('the Project Owner clicks on the "Next" button', function () {
    try {
        projectPublishing.clickNext();
    } catch (error) {
        this.lastError = error.message;
    }
});

Then('the system displays an error message', function () {
    assert.strictEqual(this.lastError, "Invalid project data", "Expected error message was not found.");
});

Then('the Project Owner is prompted to correct the information', function () {
    assert.ok(this.lastError, "The Project Owner was not prompted to correct the information.");
});

When('the Project Owner checks the detailed information page', function () {
    projectPublishing.checkDetailPage();
});

When('the Project Owner clicks the "Publish" button', function () {
    projectPublishing.clickPublish();
});

Then('the project is successfully published', function () {
    assert.strictEqual(projectPublishing.published, true, "Project was not published");
});

Then('the Project Owner receives a notification of the new application', function () {
    assert.strictEqual(projectPublishing.notificationReceived, true, "Notification was not received");
});

When('the Project Owner decides not to continue the process', function () {
    projectPublishing.cancelPublishing();
});

Then('the Project Owner can cancel the operation', function () {
    assert.strictEqual(projectPublishing.published, false, "The project was published despite cancellation.");
});

Then('no project is published', function () {
    assert.strictEqual(projectPublishing.published, false, "Project was published despite cancellation.");
});
