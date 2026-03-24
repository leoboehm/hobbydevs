<template>
  <v-container class="py-10 d-flex justify-center">
    <v-card elevation="2" class="pa-6" max-width="1000">
      <v-card-title>
        <span class="text-h5 font-weight-medium">Help Center</span>
      </v-card-title>

      <v-divider class="my-4"></v-divider>

      <v-card-text>
        <p class="mb-6">
          Welcome to <strong>Hobby Devs</strong> – a collaborative platform
          where ideas meet development. Here's how to get started.
        </p>

        <v-expansion-panels multiple>
          <v-expansion-panel>
            <v-expansion-panel-title
              >What is Hobby Devs?</v-expansion-panel-title
            >
            <v-expansion-panel-text>
              Hobby Devs connects idea creators with hobby developers who want
              to build real-world projects. Whether you’re a project owner or a
              developer, we make collaboration simple and rewarding.
            </v-expansion-panel-text>
          </v-expansion-panel>

          <v-expansion-panel>
            <v-expansion-panel-title>Getting Started</v-expansion-panel-title>
            <v-expansion-panel-text>
              <ul class="pl-4">
                <li>
                  <strong>Project Owners:</strong> Post your idea, describe your
                  needs and set a budget and timeline.
                </li>
                <li>
                  <strong>Developers:</strong> Explore projects and apply with
                  your experience and availability.
                </li>
              </ul>
            </v-expansion-panel-text>
          </v-expansion-panel>

          <v-expansion-panel>
            <v-expansion-panel-title
              >Profiles & Applications</v-expansion-panel-title
            >
            <v-expansion-panel-text>
              Developers can create detailed profiles to showcase their skills
              and past work. Project owners submit forms explaining what they're
              looking for and review developer applications accordingly.
            </v-expansion-panel-text>
          </v-expansion-panel>

          <v-expansion-panel>
            <v-expansion-panel-title>Need More Help?</v-expansion-panel-title>
            <v-expansion-panel-text>
              Feel free to contact our team at
              <a href="mailto:teamhobbydev@gmail.com">teamhobbydev@gmail.com</a>
              if you need any help or support.
            </v-expansion-panel-text>
          </v-expansion-panel>
        </v-expansion-panels>
      </v-card-text>
    </v-card>
  </v-container>
</template>