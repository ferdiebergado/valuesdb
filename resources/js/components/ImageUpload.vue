<template>
    <div class="container">
        <div class="form-group row">
            <div class="col-4" v-if="image" style="display: flex; align-items: center; justify-content: center; margin: 0;">
                <img :src="image" class="img-responsive" height="120" width="160"></div>
                <div class="col-5">
                    <input type="file" v-on:change="onImageChange" accept=".jpg,.jpeg,.png" class="form-control"></div>
                    <input type="hidden" name="photo" :value="filename">
                    <div class="col-3">
                        <button class="btn btn-success btn-block" @click.prevent="uploadImage" :disabled="disabled">Upload Photo</button>
                    </div>
                </div>
            </div>
        </template>
<script>
    export default {
        data() {
            return {
              image: "",
              filename: "",
              disabled: true
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
  axios.post("/values/avatar", { file: this.image }).then(response => {
    if (response.data.success) {
      this.filename = response.data.filename;
      alert(response.data.success);
  }
});
}
}
}
</script>
