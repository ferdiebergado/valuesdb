<template>
    <div>
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
                    <td>{{ activity.activity.activitytitle }}</td>
                    <td>{{ activity.activity.venue }}</td>
                    <td>{{ activity.activity.startdate }}</td>
                    <td>{{ activity.activity.enddate }}</td>
                    <td>{{ activity.activity.managedby }}</td>
                    <td>{{ activity.role.name }}</td>
                </tr>
            </tbody>
            <activity-form :participantid="participantid" @activity-created="updateActivities"></activity-form>
        </table>
        <activity-select @activity-selected="updateActivities"></activity-select>
    </div>
</template>
<script>
import ActivityForm from './ActivityForm.vue';
import ActivitySelect from './ActivitySelect.vue';
export default {
    components: {
        ActivityForm,
        ActivitySelect
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
            axios.get('/values/activity_participants', { params: {
                participantid: parseInt(vm.participantid)
            }}).then(res => {
                vm.$set(vm.$data, 'activities', res.data);
            }).catch(err => {
                alert(err.response.data);
                console.log(err.response.data);
            });
        },
        updateActivities(activity) {
            this.activities.splice(0, 0, activity);
            $('#activity-form').modal('hide');
        }
    }
}
</script>
