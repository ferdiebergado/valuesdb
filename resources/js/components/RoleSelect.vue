<template>
    <div class="input-group">
        <select class="form-control" v-model="role" @change="updateRole">
            <option value="">Select Role</option>
            <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
        </select>
        <div class="input-group-append">
            <span class="input-group-text"><a href="javascript:void();" data-toggle="modal" data-target="#role-form" title="Create Role"><i class="fa fa-plus"></i></a></span>
        </div>
        <role-form @role-created="refreshRoles"></role-form>
    </div>
</template>
<script>
import RoleForm from './RoleForm.vue';
export default {
    name: 'role-select',
    components: {
        RoleForm
    },
    data() {
        return {
            role: '',
            roles: {}
        }
    },
    created() {
        eventBus.$on('list-updated', this.resetRole);
    },
    beforeDestroy() {
        eventBus.$off('list-updated', this.resetRole);
    },
    mounted() {
        this.fetchRoles();
    },
    methods: {
        fetchRoles() {
            var vm = this;
            axios.get('/values/roles').then(res => {
                vm.$set(vm.$data, 'roles', res.data);
            }).catch(err => {
                alert(err.response.data);
                console.log(err.response.data);
            });
        },
        updateRole() {
            function checkRole(role) {
                return role.id === this;
            }
            var role = this.roles.find(checkRole, this.role);
            this.$emit('role-selected', role);
        },
        resetRole() {
            this.role = '';
        },
        refreshRoles() {
            this.fetchRoles();
            $('#role-form').modal('hide');
        }
    }
}
</script>
