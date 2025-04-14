let store;

// Login
Cypress.Commands.add('login', () => {
    cy.window().then((win) => {
        store = win.store;
    });    
      
    cy.wait(500).then(() => {
        store.authStore.actionLogin({
            email: 'test@hobbydevs.com',
            password: 'password'
        });
    })
})

Cypress.Commands.add('checkLoginState', () => {
    cy.window().then((win) => {
        store = win.store;
    });    

    cy.wait(500).then(() => { return store.authStore.getIsAuthenticated; })
})