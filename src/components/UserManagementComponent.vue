<template>
  <v-app>
    <label>saya</label>
  </v-app>
</template>

<script>
export default {
  name: "UserManagementComponent",
  mounted() {
    this.instance = axios.create({
      baseURL: '/tiketux/usermanagement/api/'
    });
    this.list();
  },
  data() {
    return {
      
    };
  },
  methods: {
    list: function(){
      console.log("test");  
      this.instance
        .get('list')
        .then(response => {
          console.log(response);
        })
        .catch(error => {                        
        });              
    }   
  }
};
</script>
