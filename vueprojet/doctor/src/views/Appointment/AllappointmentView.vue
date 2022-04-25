<template>
    <div class="bg-white shadow-md rounded my-6">

<div class="w-full border-x border-t mt-6 border-collapse text-left">
   <table class="text-left w-full border-collapse">
  <thead>
        <tr>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Horaire</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">date</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Action</th>
        </tr>
      </thead>
      <tbody>
         <tr class="border-b hover:bg-gray-50"  v-for="Appointment in Appointments" :key="Appointment.id" >
            <td class="py-4 px-6 border-b border-grey-light">
                {{ Appointment.Horaire }}
            </td>
            <td class="py-4 px-6 border-b border-grey-light">
               {{ Appointment.DateConsult }}
               
            </td>
            <td class="py-4 px-6 border-b border-grey-light flex gap-4">
            <button  class="rounded-lg text-white bg-green-400 p-2 ">
            <a @click="UpdateAppointment(Appointment.id)" class="cursor-pointer ">
                Edit
            </a>
            </button>
             <button class="rounded-lg text-white bg-red-400 p-2 ">
            <a @click="deleteAppointment(Appointment.id)" class="cursor-pointer ">
                delete
            </a>
            </button>
            </td>
         </tr>
        
      </tbody>
   </table>
</div>
</div>

</template>

<script>

import { computed, watch } from '@vue/runtime-core'
import { get } from 'js-cookie';
import  Cookies from 'js-cookie';
import { get as get_cookie } from "js-cookie";



export default {
   
   data() {
       return {
           Reference: Cookies.get("user"),
         
           Appointments:[],
       }
   },
   methods:{
     BackBook()
     {
      this.$router.push('/Appointment');
     },
      deleteAppointment(id)
      {
          console.log(id);
        fetch('http://localhost/doctor/Appointments/delete/'+id, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
             'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            id: id,
          }),
        })
        .then(response => response.json())
        .then(data => {
          alert(data.message);
         this.Appointments.splice(this.Appointments.indexOf(id),1);
        })
      },
      UpdateAppointment(id)
      {
        this.$router.push('/Appointment/update/'+id);
      },
     
   },
      mounted() {
        console.log(this.Reference);
      fetch('http://localhost/doctor/Appointments/get/'+this.Reference,{
        method: 'GET',
        headers: {
          'Content-Type': 'application/json'
        },
      })
      .then(response =>response.json())
      .then(data => {

        console.log(data);
        if (data[0] === 200)
        {
          this.Appointments = data[1];
          console.log('444');


        }
        console.log(this.Appointments);
      
      })
     
    
    },
   
    
}
</script>
