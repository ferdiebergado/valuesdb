<template>
    <select class="form-control" v-model="role" @change="updateRole">
        <option value="">Select Role</option>
        <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
    </select>
</template>
<script>
export default {
    name: 'role-select',
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
            this.$emit('role-updated', role);
        },
        resetRole() {
            this.role = '';
        }
    }
}
</script>
