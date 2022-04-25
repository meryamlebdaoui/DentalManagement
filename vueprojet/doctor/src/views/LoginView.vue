<template>
  <div class="singup">
      
    <div class="flex items-center min-h-screen sin">
      <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg ">
    <div v-if="failed" role="alert">
  <div class="bg-red-300 text-white font-bold rounded-t px-4 py-2">
    Danger
  </div>
  <div class="border border-t-0 border-red-200 rounded-b bg-red-100 px-4 py-3 text-red-700">
    <p>Failed to create user!.</p>
  </div>
</div>
        <div class="flex flex-col md:flex-row">
          <div class="h-32 md:h-auto md:w-1/2">
            <img
              class="object-cover w-full h-full"
              src="../assets/imgs/log.png"
              alt="img"
            />
          </div>
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
              <div class="flex justify-center mb-10">
                <div class="relative md:mt-8">
                  <a
                    href="#"
                    class="text-lg relative z-50 font-bold tracking-widest text-gray-900 rounded-lg focus:outline-none focus:shadow-outline"
                    >Dr.Dental</a
                  >
                  <svg
                    class="h-11 z-40 absolute -top-2 -left-3"
                    viewBox="0 0 79 79"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M35.2574 2.24264C37.6005 -0.100501 41.3995 -0.100505 43.7426 2.24264L76.7574 35.2574C79.1005 37.6005 79.1005 41.3995 76.7574 43.7426L43.7426 76.7574C41.3995 79.1005 37.6005 79.1005 35.2574 76.7574L2.24264 43.7426C-0.100501 41.3995 -0.100505 37.6005 2.24264 35.2574L35.2574 2.24264Z"
                      fill="#65DAFF"
                    />
                  </svg>
                </div>
              </div>
              <form>
                <h1 class="mb-4 text-2xl font-bold text-center text-gray-700">
                  Login
                </h1>
                <div class="mt-4">
                  <label class="block text-sm">Enter your Reference here : </label>
                  <input
                    v-model="Reference"
                    type="text"
                    class="w-full px-4 py-2 text-sm border rounded-md focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-600"
                    placeholder="ex: 12R7GG89"
                  />
                </div>
                
                <input type="submit" value="Login" @click.prevent="handleSubmit" class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue"
/>
{{failed}}
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import 'sweetalert2/dist/sweetalert2.min.css';
import Cookies from 'js-cookie';
export default {
    name: 'LoginView',
    data() {
        return {
                Reference: '',
            
        }
    },
    methods: {
        handleSubmit() {
            
           console.log(this.Reference);
            this.$store.dispatch('loginUser',this.Reference )
            .then(() => {
              
              if (Cookies.get('authIsReady')== true)
              {
                alert('Login Successful');
                
                this.$router.push('/');
                
              }
              else
              {
                this.failed = true;

              }

              
            })
            
          
        },
     
    }

  
}
</script>