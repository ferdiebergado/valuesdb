<template>
    <div>
        <div class="row">
            <div class="col-7">
                <activity-select :participantid="participantid" @activity-selected="updateActivity"></activity-select>
            </div>
            <div class="col-3">
                <role-select @role-updated="updateRole"></role-select>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-success" @click.prevent="updateList" title="Add to List"><i class="fa fa-th-list"></i></button>
                <a class="btn btn-primary" href="javascript:void();" data-toggle="modal" data-target="#activity-form" title="Create new"><i class="fa fa-plus"></i></a></p>
            </div>
        </div>
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
                    <input v-if="!activity.new" type="hidden" name="activity[]" :value="JSON.stringify(activity)">
                    <input v-if="activity.new" type="hidden" name="activities[]" :value="JSON.stringify({ activity: {id: activity.activity.id, role: activity.role.id}})">
                </tr>
            </tbody>
            <activity-form @activity-created="pushNewActivity"></activity-form>
        </table>
    </div>
</template>
<script>
import ActivityForm from './ActivityForm.vue';
import ActivitySelect from './ActivitySelect.vue';
import RoleSelect from './RoleSelect.vue';
export default {
    components: {
        ActivityForm,
        ActivitySelect,
        RoleSelect
    },
    props: {
        participantid: String
    },
    data() {
        return {
            activities: {},
            activityindex: '',
            activity: '',
            role: {}
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
        updateActivity(activity, index) {
            this.activityindex = index;
            this.activity = activity;
        },
        updateRole(role) {
            this.role = role;
        },
        updateList() {
            if (this.activity && this.role) {
                var i = this.activityindex;
                this.activities.splice(0, 0, {activity: this.activity, role: this.role});
                this.activityindex = '';
                this.activity = {};
                eventBus.$emit('list-updated', i);
            } else {
                alert('Please select an Activity and a Role.');
            }
        },
        pushNewActivity(activity) {
            console.log(activity);
            this.activities.splice(0, 0, activity);
            $('#activity-form').modal('hide');
        }
    }
}
</script>
