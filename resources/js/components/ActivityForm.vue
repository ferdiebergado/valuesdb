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
                            <div class="alert alert-danger" role="alert" v-if="error">
                                <strong>Error</strong> {{ error }}
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="activitytitle">Title <span><small class="text-muted">(Required)</small></span></label>
                                        <textarea class="form-control" name="activitytitle" id="activitytitle" rows="3" v-model="activity.activitytitle" required autofocus></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="venue">Venue <span><small class="text-muted">(Required)</small></span></label>
                                        <input type="text" class="form-control" name="venue" id="venue" v-model="activity.venue" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="startdate">Start Date <span><small class="text-muted">(Required)</small></span></label>
                                        <flat-pickr v-model="activity.startdate"></flat-pickr>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="enddate">End Date <span><small class="text-muted">(Required)</small></span></label>
                                        <flat-pickr v-model="activity.enddate"></flat-pickr>
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
<!--                             <div class="row">
                                <div class="col-12">
                                    <label for="role_id">Role</label>
                                    <role-select :required="true" @role-updated="updateRole"></role-select>
                                </div>
                            </div> -->
                        </div> <!-- container -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-left" data-dismiss="modal"><i class="fa fa-ban"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div> <!-- modal dialog -->
    </div> <!-- Modal -->
</template>
<script>
// import RoleSelect from './RoleSelect.vue';
export default {
  name: "activity-form",
  // components: {
  //     RoleSelect
  // },
  data() {
    return {
      activity: {
        activitytitle: "",
        venue: "",
        startdate: null,
        enddate: null,
        managedby: ""
      },
      // role: {
      //     id: '',
      //     name: ''
      // },
      error: ""
    };
  },
  methods: {
    save() {
      var vm = this;
      axios
        .post("/values/activities", this.activity)
        .then(res => {
          console.table([res.data.data]);
          // this.$emit('activity-created', {activity: res.data.data, new: true});
          this.$emit("activity-created");
          this.activity = {};
        })
        .catch(err => {
          this.error = err.response.data;
        });
    }
    // updateRole(role) {
    //     this.role.id = role.id;
    //     this.role.name = role.name;
    // }
  }
};
</script>
