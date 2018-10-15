<template>
    <div class="input-group">
        <select name="activity_id" id="activity_id" class="form-control" v-model="activity" @change="updateActivity">
            <option value="">Select Activity</option>
            <option v-for="activity in activities" :key="activity.id" :value="activity.id">{{ `${activity.id} - ${activity.activitytitle} - ${activity.venue} - ${activity.startdate} - ${activity.enddate}` }}</option>
        </select>
        <div class="input-group-append">
            <span class="input-group-text">
                <a href="javascript:void();" data-toggle="modal" data-target="#activity-form" title="Create Activity"><i class="fa fa-plus-circle"></i></a>
            </span>
        </div>
        <activity-form @activity-created="refreshActivities"></activity-form>
    </div>
</template>
<script>
import ActivityForm from "./ActivityForm.vue";
export default {
  name: "activity-select",
  components: {
    ActivityForm
  },
  props: {
    participantid: String
  },
  data() {
    return {
      activity: "",
      activities: {}
    };
  },
  created() {
    eventBus.$on("list-updated", this.updateList);
    eventBus.$on("activity-removed", this.restoreActivity);
  },
  beforeDestroy() {
    eventBus.$off("list-updated", this.updateList);
    eventBus.$off("activity-removed", this.restoreActivity);
  },
  mounted() {
    this.fetchActivities();
  },
  methods: {
    fetchActivities() {
      var vm = this;
      axios
        .get("/values/activities", {
          params: {
            participantid: this.participantid
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
    updateActivity() {
      function checkActivity(activity) {
        return activity.id === this;
      }
      var activity = this.activities.find(checkActivity, this.activity);
      this.$emit("activity-selected", activity, this.activity);
    },
    updateList(i) {
      function checkActivity(activity) {
        return activity.id === this;
      }
      var activityidx = this.activities.findIndex(checkActivity, i);
      this.activities.splice(activityidx, 1);
      this.activity = "";
    },
    refreshActivities() {
      this.fetchActivities();
      $("#activity-form").modal("hide");
    },
    restoreActivity(activity) {
      this.activities.push(activity);
    }
  }
};
</script>
