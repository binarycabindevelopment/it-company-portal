<template>
    <div class="agenda-list-cell agenda-list-cell-time" v-bind:class="'agenda-list-cell-time-'+numericTime">
        <button class="agenda-list-schedule-item" v-for="ticketIndex in ticketsCount">Ticket Name</button>
        <button class="agenda-list-schedule-item-blank">Add Item</button>
    </div>
</template>

<script>
    import moment from 'moment'
    export default {
        props: {
            numericTime: {
                default: null
            },
            initialEmployee: {
                default: null
            },
        },
        mounted() {
            console.log('Agenda employee item cell time mounted.');
            console.log(this.numericTime);
            console.log(this.employee);
            this.ticketsCount = Math.floor(Math.random() * 4);
        },
        data: function () {
            return {
                ticketsCount: 0,
                employee: this.initialEmployee
            }
        },
        methods: {

        },
        computed: {

        }
    }
</script>
