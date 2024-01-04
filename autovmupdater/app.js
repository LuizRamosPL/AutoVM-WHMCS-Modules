const { createApp } = Vue

  createApp({
    data() {
      return {
        iframeAddress : '/autovmupdatepage.php',
        ActonResponse : null,
        ChoseVersion: null,
        HardDeleteVisible: false,
      }
    },

    methods: {
        ChangeShowHardDelete(){
          this.HardDeleteVisible = !this.HardDeleteVisible;
          console.log(this.HardDeleteVisible);
        },

        funcDelete() {
          axios.post('./autovmupdatefunc.php', {funcmethod: 'delete'})
          .then(response => {
            // Handle the response from the server
            this.ActonResponse = response.data
          })
          .catch(error => {
            // Handle errors
            this.ActonResponse = error;
          });
        },
        
        funchardDelete() {
          axios.post('./autovmupdatefunc.php', {funcmethod: 'hardDelete'})
          .then(response => {
            // Handle the response from the server
            this.ActonResponse = response.data
            window.parent.location.reload();
          })
          .catch(error => {
            // Handle errors
            this.ActonResponse = error;
          });
        },

        funcInstall() {
          axios.post('./autovmupdatefunc.php', {funcmethod: 'install'})
          .then(response => {
            // Handle the response from the server
            this.ActonResponse = response.data
          })
          .catch(error => {
            // Handle errors
            this.ActonResponse = error;
          });
        },

        funcUpdate() {
          axios.post('./autovmupdatefunc.php', {funcmethod: 'update'})
          .then(response => {
            // Handle the response from the server
            this.ActonResponse = response.data
          })
          .catch(error => {
            // Handle errors
            this.ActonResponse = error;
          });
        },
        
        funcFix() {
          axios.post('./autovmupdatefunc.php', {funcmethod: 'fix'})
          .then(response => {
            // Handle the response from the server
            this.ActonResponse = response.data
          })
          .catch(error => {
            // Handle errors
            this.ActonResponse = error;
          });
        }
    },

  }).mount('#app')