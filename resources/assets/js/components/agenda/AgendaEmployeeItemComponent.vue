<template>
    <div class="agenda-employee-item-component">
        <div class="agenda-list-cell agenda-list-cell-action">&nbsp;</div>
        <div class="agenda-list-cell agenda-list-cell-name">Employee Name</div>
        <agenda-employee-item-cell-time v-for="numericTime in totalNumericTime" :key="numericTime" :numeric-time="numericTime"></agenda-employee-item-cell-time>
    </div>
</template>

<script>
    import moment from 'moment'
    export default {
        props: {
            initialEmployee: {
                default: null
            },
        },
        mounted() {
            console.log('Agenda employee item mounted.');
            console.log(this.employee);
        },
        data: function () {
            return {
                employee: this.initialEmployee,
                totalNumericTime: 48
            }
        },
        methods: {

        },
        computed: {

        }
    }
</script>
