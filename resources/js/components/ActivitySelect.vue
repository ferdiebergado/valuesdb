<template>
    <select name="activity_id" id="activity_id" class="form-control" v-model="activity" @change="updateActivity">
        <option value="">Select</option>
        <option v-for="activity in activities" :key="activity.id" :value="activity.id">{{ activity.activitytitle + ' - ' + activity.venue }}</option>
    </select>
</template>
<script>
export default {
    name: 'activity-select',
    data() {
        return {
            activity: '',
            activities: {}
        }
    },
    mounted() {
        this.fetchActivities();
        // this.updateActivity();
    },
    methods: {
        fetchActivities() {
            var vm = this;
            axios.get('/values/activities').then(res => {
                vm.$set(vm.$data, 'activities', res.data);
            }).catch(err => {
                alert(err.response.data);
                console.log(err.response.data);
            });
        },
        updateActivity() {
            function checkActivity(activity) {
                return activity.id === this;
            }
            var activity = this.activities.find(checkActivity, this.activity);
            // if (!this.paxactivities.find(checkActivity, activity)) {
            //     axios.post('/values/activities', activity).then(res => {
            //         console.log('Activity added.');
            //     }).catch(err => {
            //         alert(err.response.data);
            //     });
            this.$emit('activity-selected', activity);
            // } else {
            //     alert('Event is already listed.');
            // }
        }
    }
}
</script>
