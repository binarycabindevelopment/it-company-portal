<template>
    <div class="agenda-component">
        <div class="day-selector">
            <div class="previous-container">
                <button class="btn btn-primary" v-on:click="setDayPrevious">Prev</button>
            </div>
            <div class="selector-label">{{ date.format('MMMM Do, YYYY') }}</div>
            <div class="next-container">
                <button class="btn btn-primary" v-on:click="setDayNext">Next</button>
            </div>
        </div>
        <div class="agenda-list-container">
            <div class="agenda-list-headers">
                <div class="agenda-list-header agenda-list-header-action">&nbsp;</div>
                <div class="agenda-list-header agenda-list-header-name">&nbsp;</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-1">12:00am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-2">12:30am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-3">01:00am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-4">01:30am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-5">02:00am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-6">02:30am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-7">03:00am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-8">03:30am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-9">04:00am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-10">04:30am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-11">05:00am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-12">05:30am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-13">06:00am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-14">06:30am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-15">07:00am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-16">07:30am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-17">08:00am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-18">08:30am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-19">09:00am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-20">09:30am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-21">10:00am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-22">10:30am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-23">11:00am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-24">11:30am</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-25">12:00pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-26">12:30pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-27">01:00pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-28">01:30pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-29">02:00pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-30">02:30pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-31">03:00pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-31">03:30pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-33">04:00pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-34">04:30pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-35">05:00pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-36">05:30pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-37">06:00pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-38">06:30pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-39">07:00pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-40">07:30pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-41">08:00pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-42">08:30pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-43">09:00pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-44">09:30pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-45">10:00pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-46">10:30pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-47">11:00pm</div>
                <div class="agenda-list-header agenda-list-header-time agenda-list-header-time-48">11:30pm</div>
            </div>
            <agenda-employee-item v-for="employee in initialEmployees" :key="employee.id" :initial-employee="employee"></agenda-employee-item>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    export default {
        props: {
            initialEmployees: {
                default: []
            },
            initialDate: {
                default: moment().startOf('day').format('YYYY-MM-DD')
            },
        },
        mounted() {
            console.log('Agenda mounted.')
        },
        data: function () {
            return {
                day: this.initialDate
            }
        },
        methods: {
            setDayPrevious: function(){
                this.day = moment(this.day).subtract(1, "days").format('YYYY-MM-DD');
            },
            setDayNext: function(){
                this.day = moment(this.day).add(1, "days").format('YYYY-MM-DD');
            }
        },
        computed: {
            date: function(){
                return moment(this.day).startOf('day');
            }
        }
    }
</script>
