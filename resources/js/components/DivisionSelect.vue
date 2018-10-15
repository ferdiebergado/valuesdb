<template>
    <div>
        <p id="ajax-loader" v-if="loading">
            Updating... &nbsp;<img src="/img/ajax-loader-square.gif">
        </p>
        <select name="division_id" id="division_id" class="form-control" :disabled="disabled" v-if="!loading" v-model="division">
            <option value="">Select Division</option>
            <option v-for="division in divisions" :key="division.id" :value="division.id">{{ division.name }}</option>
        </select>
    </div>
</template>
<script>
export default {
  props: {
    divisionid: String
  },
  data() {
    return {
      loading: false,
      disabled: true,
      division: parseInt(this.divisionid),
      divisions: {}
    };
  },
  created() {
    eventBus.$on("region-updated", this.fetchDivisions);
  },
  beforeDestroy() {
    eventBus.$off("region-updated", this.fetchDivisions);
  },
  methods: {
    fetchDivisions(region) {
      var vm = this;
      this.loading = true;
      if (region === "" || region === 19) {
        this.disabled = true;
      } else {
        this.disabled = false;
      }
      axios
        .get("/values/divisions", {
          params: { region_id: region }
        })
        .then(function(res) {
          vm.$set(vm.$data, "divisions", res.data);
          vm.$set(vm.$data, "loading", false);
        })
        .catch(function(err) {
          alert(err.response.data);
          console.log(err.response.data);
        });
    }
  }
};
</script>
