import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import  Cookies from 'js-cookie'
// import axios from 'axios'


export default createStore({

  state: {
  
    user: null,
    authIsReady: false,
    failed: false,
  },
  plugins: [
    createPersistedState({
      storage: {
        getItem: (key) => Cookies.get(key),
        setItem: (key, value) =>
          Cookies.set(key, value, { expires: 3, secure: true }),
        removeItem: (key) => Cookies.remove(key),
      },
    }),
  ],
  getters: {
    authIsReady: state => state.authIsReady,
    user: state => state.user,
  },
  mutations: {
    setUser(state, user) {
      state.user = user
      console.log('user state changed:', state.user)
    },
    setAuthIsReady(state, authIsReady) {
      state.authIsReady = authIsReady
      console.log('authIsReady state changed:', state.authIsReady)
    },
    setFailed(state, failed) {
      state.failed = failed
      console.log('failed state changed:', state.failed)
    },
  
  },
  actions: {
   async createUser(context, user) {

      const reponse = await fetch("http://localhost/Doctor/Patients/create/", {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(user)
      })
      if (reponse.status === 200) {
        const data = await reponse.json()
        console.log(data)
        context.commit('setUser',  Cookies.set('user', data[1]))
        context.commit('setAuthIsReady', true)
        context.commit('setFailed', false)
       
        // save user to local storage using cookies plugin
        Cookies.set('user', data[1])
        Cookies.set('authIsReady', true)
     
        // localStorage.setItem('user',data[1]) // save user to local storage

        // stoker user in local storage
      }else {
        context.commit('setFailed', true)
      }
     
    
    
    },
    async logout(context) {
      context.commit('setUser', null)
      context.commit('setAuthIsReady', false)
   
      // remove key from cookies
      Cookies.remove
      Cookies.remove('authIsReady')
      // remove cookies from

    

      

      // Cookies.remove(key)
    },
    async loginUser(context, Reference) {
      fetch("http://localhost/Doctor/Patients/login/"+Reference, {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({Reference})
      })
        .then(response => response.json())
        .then(data => {
          console.log(data);
          if (data[0] === 200) {

            context.commit('setUser', data[1])
            context.commit('setAuthIsReady', true)
         
            // save user to local storage using cookies plugin
            Cookies.set('user', data[1])
            Cookies.set('authIsReady', true)

          }
        }
      ).catch(error => {
        console.log(error);
        context.commit('setFailed', true)
        this.$router.push('/login')
      });
    },

      
      
  },
  modules: {
  }
})