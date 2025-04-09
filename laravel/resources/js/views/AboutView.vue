<template>
    <div class="help-container">
      <h1>About Us</h1>
      <p class="intro">
        Welcome to <strong>Hobby Devs</strong> – a space where ideas meet development.
        Here's how to navigate and make the most of our platform.
      </p>
  
      <section>
        <h2>What is Hobby Devs?</h2>
        <p>
          Hobby Devs connects idea creators with hobby developers who want to work on exciting, real-world projects.
          Whether you’re a project owner or a developer, our platform is designed for smooth, productive collaboration.
        </p>
      </section>
  
      <section>
        <h2>Getting Started</h2>
        <ul>
          <li><strong>Project Owners:</strong> Submit your idea with a clear description, budget and timeline.</li>
          <li><strong>Developers:</strong> Explore available projects and apply based on your skills and availability.</li>
        </ul>
      </section>
  
      <section>
        <h2>Profiles & Applications</h2>
        <p>
          Developers can create profiles showcasing their skills and experience. Project owners use these to find the best matches.
        </p>
        <p>
          Forms allow project owners to explain what they need and developers can apply with tailored proposals.
        </p>
      </section>
  
      <section>
        <h2>Need More Help?</h2>
        <p>
          Still got questions? Reach out to our team at <a href="mailto:teamhobbydev@gmail.com">teamhobbydev@gmail.com</a>.
        </p>
      </section>
    </div>
  </template>
  
  <script>
  export default {
    name: 'HelpView',
  }
  </script>
  
  <style scoped>
  .help-container {
    max-width: 800px;
    margin: 3rem auto;
    padding: 0 1.5rem;
  }
  
  h1 {
    font-size: 2.5rem;
    color: var(--color-primary);
    margin-bottom: 1.5rem;
    text-align: center;
  }
  
  .intro {
    font-size: 1.1rem;
    margin-bottom: 2rem;
    text-align: center;
  }
  
  section {
    margin-bottom: 2rem;
  }
  
  h2 {
    font-size: 1.5rem;
    margin-bottom: 0.75rem;
    color: var(--color-primary);
  }
  
  p {
    margin-bottom: 1rem;
  }
  
  ul {
    padding-left: 1.2rem;
  }
  
  li {
    margin-bottom: 0.5rem;
  }
  </style>
  