// store/user.js
import { defineStore } from 'pinia'

export const useUserStore = defineStore('user', {
  state: () => ({
    isAuthenticated: false
  }),
  actions: {
    setAuthStatus(status) {
      this.isAuthenticated = status;
    }
  }
})

// export const useUserStore = defineStore('user', {
//   state: () => ({
//     roles: ['spectateur'], // les rôles initiaux de l'utilisateur
//   }),
//   getters: {
//     // Ce getter vérifie si l'utilisateur a plusieurs rôles
//     hasMultipleRoles: (state) => state.roles.length > 1,
//   },
//   actions: {
//     // Ajoute un rôle à l'utilisateur s'il ne l'a pas déjà
//     addRole(role) {
//       if (!this.roles.includes(role)) {
//         this.roles.push(role);
//       }
//     },
//     // Retire un rôle de l'utilisateur
//     removeRole(role) {
//       this.roles = this.roles.filter(r => r !== role);
//     },
//   }
// })
