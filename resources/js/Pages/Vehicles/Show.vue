<script>
import { router,useForm} from '@inertiajs/vue3'
import vinGenerator  from 'vin-generator'


export default {
  props: {
    vehicles: Array,
    items: Array,
  },
  data(){
    return{
      searchForm: useForm({
        txtserach: null,
      }),
      selectedOption: null,
    }
  },  

  methods: {       
    fetchData() {
      var randomvin = vinGenerator.generateVin();
        fetch('https://vpic.nhtsa.dot.gov/api/vehicles/decodevinvaluesextended/'+randomvin+'?format=json')
        .then(response => response.json())
        .then(data => 
          (data.Results).forEach(v => {          
            this.items.push({ vin: v.VIN, make: v.Make, model:v.Model,year:v.ModelYear })
          }),

        ) 
    },
    saveData(){
      let allitems = this.items
      // let selecteditem = this.items.find(o => o.vin === this.selectedOption);

      let selecteditem;

      for(let i=0;i<=this.items.length;i++)
      {
         if(this.items[i].vin === this.selectedOption)
         {
            selecteditem = i
         }
      }

      router.visit('/vehicle/save', {
        method: 'post',
        headers:{
          'content-type':'application/json',     
        },
        'Content-type':'application/json',  
        data: {selecteditem, 'allitems':allitems },
        onSuccess: () => {
        },
        onError: errors => {alert("error")},
      })

    },
    deleteData($vechicleID){
      if(confirm("Do you really want to delete?")){
        router.visit('/vehicle/delete', {
          method: 'post',
          data: {'id':$vechicleID},
          onSuccess: () => {
          },
          onError: errors => {alert("error")},
        })
      }
    }
  },
  
}

</script>

<template>



<div>
  
  Vechicle :: 
  <select v-model="selectedOption">
    <!-- <option selected="selected" value="default">Select Data</option> -->
    <option v-for="item in items" :value="item.vin" :key="item.vin">
      {{item.vin}}-{{item.model}}-{{item.make}}-{{item.year}}
    </option>
  </select>
  <br/>
  <button @click="saveData">Save</button>
  <br/>
  <br/><br/>
<button  @click="fetchData">Generate RandomVIN</button>
</div>

<h2>Here</h2>
{{ lat }}



<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">VIN</th>
      <th scope="col">Make</th>
      <th scope="col">Model</th>
      <th scope="col">Year</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="vehicle in vehicles" :key="vehicle.id">
      <th scope="row">{{vehicle.id}}</th>
      <td>{{vehicle.vin}}</td>
      <td>{{vehicle.make}}</td>
      <td>{{vehicle.model}}</td>
      <td>{{vehicle.year}}</td>
      <td>  <button @click="deleteData(vehicle.id)">Delete</button></td>
    </tr>
  </tbody>
</table>

<FalshC />

</template>

