<template>
    <select name="activity_id" id="activity_id" class="form-control" v-model="activity" @change="updateActivity">
        <option value="">Select Activity</option>
        <option v-for="activity in activities" :key="activity.id" :value="activity.id">{{ `${activity.id} - ${activity.activitytitle} - ${activity.venue}` }}</option>
    </select>
</template>
<script>
export default {
    name: 'activity-select',
    props: {
        participantid: String
    },
    data() {
        return {
            activity: '',
            activities: {}
        }
    },
    created() {
        eventBus.$on('list-updated', this.updateList);
        eventBus.$on('activity-created', this.updateActivities);
    },
    beforeDestroy() {
        eventBus.$off('list-updated', this.updateList);
        eventBus.$off('activity-created', this.updateActivities);
    },
    mounted() {
        this.fetchActivities();
    },
    methods: {
        fetchActivities() {
            var vm = this;
            axios.get('/values/activities', { params: {
                participantid: this.participantid
            }}).then(res => {
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
            this.$emit('activity-selected', activity, this.activity);
        },
        updateList(i) {
            function checkActivity(activity) {
                return activity.id === this;
            }
            var activityidx = this.activities.findIndex(checkActivity, i);
            this.activities.splice(activityidx, 1);
            this.activity = '';
        },
        updateActivities(activity) {
            this.activities.splice(0, 0, activity);
        }
    }
}
</script>
