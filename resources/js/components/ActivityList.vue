<template>
    <div>
        <div class="row">
            <div class="col-7">
                <activity-select :participantid="participantid" @activity-selected="updateActivity"></activity-select>
            </div>
            <div class="col-4">
                <role-select @role-selected="updateRole"></role-select>
            </div>
            <div class="col-1">
                <button type="button" class="btn btn-success btn-block" @click.prevent="updateList" :disabled="disabled" title="Add to List"><i class="fa fa-th-list"></i></button>
            </div>
        </div>
        <table class="table table-hover table-condensed table-striped mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title of the Activity</th>
                    <th>Venue</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Managed By</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(activity, index) in activities" :key="activity.id">
                    <td>{{ index+=1 }}</td>
                    <td>{{ activity.activity.activitytitle }}</td>
                    <td>{{ activity.activity.venue }}</td>
                    <td>{{ activity.activity.startdate }}</td>
                    <td>{{ activity.activity.enddate }}</td>
                    <td>{{ activity.activity.managedby }}</td>
                    <td>{{ activity.role.name }}</td>
                    <input v-if="activity.new" type="hidden" name="activities[]" :value="JSON.stringify({ activity: {id: activity.activity.id, role: activity.role.id}})">                   
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import ActivitySelect from "./ActivitySelect.vue";
import RoleSelect from "./RoleSelect.vue";
export default {
  components: {
    ActivitySelect,
    RoleSelect
  },
  props: {
    participantid: String
  },
  data() {
    return {
      activities: {},
      activityindex: "",
      activity: "",
      role: "",
      disabled: true
    };
  },
  mounted() {
    this.fetchActivities();
  },
  methods: {
    fetchActivities() {
      var vm = this;
      axios
        .get("/values/activity_participants", {
          params: {
            participantid: parseInt(vm.participantid)
          }
        })
        .then(res => {
          vm.$set(vm.$data, "activities", res.data);
        })
        .catch(err => {
          alert(err.response.data);
          console.log(err.response.data);
        });
    },
    updateActivity(activity, index) {
      this.activityindex = index;
      this.activity = activity;
      this.enableAddToList();
    },
    updateRole(role) {
      this.role = role;
      this.enableAddToList();
    },
    enableAddToList() {
      if (!this.activity || !this.role) {
        this.disabled = true;
      } else {
        this.disabled = false;
      }
    },
    updateList() {
      if (this.activity && this.role) {
        var i = this.activityindex;
        this.activities.splice(0, 0, {
          activity: this.activity,
          role: this.role,
          new: true
        });
        this.activityindex = "";
        this.activity = {};
        this.role = "";
        eventBus.$emit("list-updated", i);
      } else {
        alert("Please select an Activity and a Role.");
      }
    }
  }
};
</script>
