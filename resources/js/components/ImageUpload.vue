<template>
<div>
    <div class="form-group row mt-5">
        <div class="col-4" v-if="image" style="display: flex; align-items: center; justify-content: center; margin: 0;">
            <img :src="image" class="img-responsive" height="120" width="160"></div>
            <div class="col-4">
                <input type="file" v-on:change="onImageChange" accept=".jpg,.jpeg,.png" class="form-control" required></div>
                <input type="hidden" name="photo" :value="filename">
                    <div class="col-4">
                        <button class="btn btn-success btn-block" @click.prevent="uploadImage" :disabled="disabled">
                            <i class="fa fa-upload" v-if="!uploading"></i><span v-if="uploading"><img src="/img/ajax-loader.gif" alt="ajax loader"> Uploading ({{ uploadPercentage }}%)</span>
                            {{ !uploading ? 'Upload Photo' : '' }} </button>
                    </div>
                </div>
                <!-- <progress max="100" :value.prop="uploadPercentage" v-if="uploading"></progress> -->
                <small class="form-text text-muted">Click "Choose File" and select an image file (.jpg, .jpeg, .png only). Then, click Upload Photo. (Required)</small>
            </div>
</template>

<script>
export default {
  props: {
    defaultvalue: String
  },
  data() {
    return {
      image: "",
      filename: this.defaultvalue,
      disabled: true,
      uploadPercentage: 0,
      uploading: false
    };
  },
  methods: {
    onImageChange(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) {
        return;
      }
      this.disabled = false;
      this.createImage(files[0]);
    },
    createImage(file) {
      let reader = new FileReader();
      let vm = this;
      reader.onload = e => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    uploadImage() {
      this.uploading = true;
      axios
        .post(
          "/values/avatar",
          { file: this.image },
          {
            onUploadProgress: function(progressEvent) {
              this.uploadPercentage = parseInt(
                Math.round((progressEvent.loaded * 100) / progressEvent.total)
              );
            }.bind(this)
          }
        )
        .then(response => {
          if (response.data.success) {
            this.filename = response.data.filename;
            this.uploading = false;
            console.log(response.data.success);
          }
        })
        .catch(err => {
          alert(err.response.data);
          return;
        });
    }
  }
};
</script>
