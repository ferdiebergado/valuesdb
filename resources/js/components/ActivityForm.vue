<template>
    <!-- Modal -->
    <div class="modal fade" id="activity-form" tabindex="-1" role="dialog" aria-labelledby="Activity" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form @submit.prevent="save">
                    <div class="modal-header">
                        <h4 class="modal-title"> &nbsp;Activity</h4>
                        <span class="float-right"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></span>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="activitytitle">Title</label>
                                        <textarea class="form-control" name="activitytitle" id="activitytitle" rows="3" v-model="activity.activitytitle" required autofocus></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="venue">Venue</label>
                                        <input type="text" class="form-control" name="venue" id="venue" v-model="activity.venue" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="startdate">Start Date:</label>
                                        <input type="date" class="form-control" name="startdate" id="startdate" v-model="activity.startdate" placeholder="Start Date" required />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="enddate">End Date</label>
                                        <input type="date" class="form-control" name="enddate" id="enddate" v-model="activity.enddate" placeholder="End Date" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="managedby">Managed By</label>
                                        <input type="text" class="form-control" name="managedby" id="managedby" v-model="activity.managedby" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="role_id">Role</label>
                                    <role-select :required="true" @role-updated="updateRole"></role-select>
                                </div>
                            </div>
                        </div> <!-- container -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div> <!-- modal dialog -->
    </div> <!-- Modal -->
</template>
<script>
import RoleSelect from './RoleSelect.vue';
export default {
    name: 'activity-form',
    components: {
        RoleSelect
    },
    props: {
        participantid: String
    },
    data() {
        return {
            activity: {
                participant_id: this.participantid,
                activitytitle: '',
                venue: '',
                startdate: null,
                enddate: null,
                managedby: '',
                role_id: null
            }
        }
    },
    methods: {
        save() {
            var vm = this;
            axios.post('/values/activities', this.activity).then(res => {
                vm.$emit('activity-created', this.activity);
            }).catch(err => {
                console.log(err.response.data);
            })
        },
        updateRole(role) {
            this.activity.role_id = role;
        }
    }
}
</script>
