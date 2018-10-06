<template>
    <select name="region_id" id="region_id" class="form-control" v-model.number="region" @change="updateDivisions">
        <option value="">Select Region</option>
        <option v-for="region in regions" :key="region.id" :value="region.id">{{ region.name }}</option>
    </select>
</template>
<script>
export default {
    props: {
        regionid: String
    },
    data() {
        return {
            region: this.regionid,
            regions: {}
        }
    },
    mounted() {
        this.fetchRegions();
        this.updateDivisions();
    },
    methods: {
        fetchRegions() {
            var vm = this;
            axios.get('/values/regions').then(res => {
                vm.$set(vm.$data, 'regions', res.data);
            }).catch(err => {
                alert(err.response.data);
                console.log(err.response.data);
            });
        },
        updateDivisions() {
            eventBus.$emit('region-updated', this.region);
        }
    }
}
</script>
