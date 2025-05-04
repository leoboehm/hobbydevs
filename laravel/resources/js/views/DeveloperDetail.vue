<template>
    <v-container class="pa-4">
      <v-card>
        <v-card-title>
          <span class="headline">Developer Details</span>
        </v-card-title>
        <v-card-text v-if="developer">
          <p><strong>Name:</strong> {{ developer.name }}</p>
          <p><strong>Email:</strong> {{ developer.email }}</p>
          <p><strong>Skill:</strong> {{ developer.skill }}</p>
          <p><strong>Experience:</strong> {{ developer.experience }} years</p>
          <p><strong>Bio:</strong> {{ developer.bio }}</p>
          <p>
          <strong>Resume:</strong>
          <a :href="developer.resume" target="_blank">{{ developer.resume }}</a>
        </p>
        <p><strong>Skills:</strong> {{ developer.skills.join(', ') }}</p>
        <p><strong>Interests:</strong> {{ developer.interests }}</p>
        <p><strong>References:</strong> {{ developer.references.join(', ') }}</p>
        <v-rating
            v-model="developer.rating"
            :max="5"
            color="amber"
            size="24"
            readonly
          />
          <p><strong>Rating:</strong> {{ developer.rating }} / 5</p>  
      </v-card-text>
        <v-card-text v-else>
          <p>Developer not found.</p>
        </v-card-text>
      </v-card>
    </v-container>
  </template>
  
  <script>
export default {
  name: 'DeveloperDetail',
  props: ['id'],
  data() {
    return {
      developer: null,
      developersMock: [
        {
          id: 1,
          name: 'Lisa',
          email: 'lisa@example.com',
          skill: 'Frontend',
          experience: 2,
          bio: 'I love working with Vue and Material Design.',
          rating: 4,
          resume: 'https://example.com/lisa-resume.pdf',
          skills: ['Vue.js', 'HTML', 'CSS', 'JavaScript'],
          interests: 'UI/UX Design, Animations',
          references: ['Marie Curie', 'Ada Lovelace'],
        },
        {
          id: 2,
          name: 'Alex',
          email: 'alex@example.com',
          skill: 'Backend',
          experience: 3,
          bio: 'Specialized in Node.js and REST APIs.',
          rating: 5,
          resume: 'https://example.com/alex-resume.pdf',
          skills: ['HTML', 'JavaScript'],
          interests: 'Animations',
          references: ['Ada Lovelace'],
        },
      ],
    }
  },
  mounted() {
    const devId = parseInt(this.id)
    this.developer = this.developersMock.find((dev) => dev.id === devId)
  },
}
</script>

  