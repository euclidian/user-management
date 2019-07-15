<template>
  <v-app>
    <v-card>
      <v-card-title primary-title>
        <div>
          <h3 class="headline mb-0">Daftar User</h3>
        </div>
      </v-card-title>
      <v-data-table
        :rows-per-page-items="rowsPerPageItems"
        :pagination.sync="pagination"
        :headers="header"
        :items="usermanagement"
        class="elevation-1"
      >
        <template v-slot:items="props">
          <td>{{ props.item.id }}</td>
          <td>{{ props.item.name }}</td>
          <td>{{ props.item.secretid }}</td>
          <td>{{ props.item.secret }}</td>
          <td>
            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-btn fab dark small color="error" @click="generateToken(props.item.id)" v-on="on">
                  <v-icon dark>vpn_key</v-icon>
                </v-btn>
              </template>
              <span>Generate Token</span>
            </v-tooltip>
          </td>
        </template>
      </v-data-table>
    </v-card>
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
      usermanagement:[],
      header:[
        { text: "ID User ", value: "id" },
        { text: "Nama User", value: "name" },
        { text: "Secret ID", value: "secretid" },
        { text: "Secret", value: "secret" },
        { text: "Action", value: "id" }
      ]
    };
  },
  methods: {
    generateToken: function(params){
      var that = this;
      that.instance
        .post('generateToken', {
          "user_id" : params
        })
        .then(response => {
          that.usermanagement = response.data.data;
          that.list();
        })
        .catch(error => {
          that.list();                        
        });  
    },
    list: function(){
      var that = this; 
      that.instance
        .get('list')
        .then(response => {
          that.usermanagement = response.data.data;
          console.log(response.data);
        })
        .catch(error => {
          console.log(response.data);                        
        });              
    }   
  }
};
</script>
