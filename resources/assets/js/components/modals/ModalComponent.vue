<template>
    <transition name="modal" v-if="open">
        <div class="modal-mask" >
            <div class="modal-wrapper" v-on:click.stop="clickMask">
                <div class="modal-container" @click.stop>
                    <div class="modal-body">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['open'],
        mounted() {
            console.log('Component mounted.')
        },
        data: function () {
            return {
            }
        },
        methods: {
            clickMask: function(){
                this.$parent.clearModals();
            },
        }
    }
</script>
