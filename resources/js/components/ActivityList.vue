<template>
    <table class="table table-hover table-condensed table-striped">
        <thead>
            <tr>
                <th>Title of the Activity</th>
                <th>Venue</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Managed By</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="activity in activities" :key="activity.id">
                <td>{{ activity.activitytitle }}</td>
                <td>{{ activity.venue }}</td>
                <td>{{ activity.startdate }}</td>
                <td>{{ activity.enddate }}</td>
                <td>{{ activity.managedby }}</td>
                <td>{{ activity.role.name }}</td>
            </tr>
        </tbody>
        <activity-form :participantid="participantid" @activity-created="updateActivities"></activity-form>
    </table>
</template>
<script>
import ActivityForm from './ActivityForm.vue';
export default {
    components: {
        ActivityForm
    },
    props: {
        participantid: String
    },
    data() {
        return {
            activities: {}
        }
    },
    mounted() {
        this.fetchActivities();
    },
    methods: {
        fetchActivities() {
            var vm = this;
            axios.get('/values/activities', { params: {
                participantid: parseInt(vm.participantid)
            }}).then(res => {
                vm.$set(vm.$data, 'activities', res.data);
            }).catch(err => {
                console.log(err.response.data);
            });
        },
        updateActivities(activity) {
            this.activities.splice(0, 0, activity);
        }
    }
}
</script>
