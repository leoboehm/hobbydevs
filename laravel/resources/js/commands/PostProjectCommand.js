export default class PostProjectCommand {
    constructor(projectStore, projectData, onSuccess, onError) {
      this.projectStore = projectStore
      this.projectData = projectData
      this.onSuccess = onSuccess
      this.onError = onError
    }
  
    async execute() {
      try {
        await this.projectStore.actionPublishProject(this.projectData)
        this.onSuccess()
      } catch (error) {
        console.error('PostProjectCommand failed:', error)
        this.onError(error)
      }
    }
  }
  