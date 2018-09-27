<template>
  <div class="container">
    <div class="large-12 medium-12 small-12 cell">
      <label>File
        <input type="file" id="file" ref="file" accept=".jpg,.jpeg,.png" v-on:change="handleFileUpload()"/>
      </label>
      <button @click.prevent="submitFile()">Submit</button>
    </div>
  </div>
</template>

<script>
export default {
  /*
      Defines the data used by the component
    */
  data() {
    return {
      file: "",
      fileid: null
    };
  },

  methods: {
    /*
        Submits the file to the server
      */
    submitFile() {
      /*
                Initialize the form data
            */
      let formData = new FormData();

      /*
                Add the form data we need to submit
            */

      formData.append("file", this.file);

      /*
          Make the request to the POST /single-file URL
        */
      axios
        .post("/values/avatar", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(function(res) {
          console.log(res);
          this.fileid = res.data.fileid;
        })
        .catch(function() {
          console.log("FAILURE!!");
        });
    },

    /*
        Handles a change on the file upload
      */
    handleFileUpload() {
      this.file = this.$refs.file.files[0];
    }
  }
};
</script>
