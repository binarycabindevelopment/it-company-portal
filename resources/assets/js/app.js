
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('modal', require('./components/modals/ModalComponent.vue'));
Vue.component('agenda', require('./components/agenda/AgendaComponent.vue'));
Vue.component('agenda-employee-item', require('./components/agenda/AgendaEmployeeItemComponent.vue'));
Vue.component('agenda-employee-item-cell-time', require('./components/agenda/AgendaEmployeeItemCellTimeComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
        expandedMenuElement: null,
        activeModal: null,
    },
    methods: {
        expandMenu: function(elementId){
            console.log(elementId);
            if(this.expandedMenuElement == elementId){
                this.expandedMenuElement = null;
            }else{
                this.expandedMenuElement = elementId;
            }
        },
        activateModal: function(modalKey){
            this.activeModal = modalKey;
        },
        clearModals: function(){
            this.activeModal = null;
        }
    }
});


$( document ).ready(function() {
    $('.datatable').DataTable({
        select: {
            style: 'multi'
        }
    });
    $('.multiselect').select2();
    $('.items-container').each(function(){
        itemContainerUpdateDisplay($(this));
    });
    $('[rel="items-add-button"]').click(function(){
        var itemsContainer = $(this).closest('.items-container');
        itemContainerIncreaseItems(itemsContainer);
    });
    $('[rel="delete-button"]').click(function(){
        if (!confirm("Are you sure?")){
            event.preventDefault();
        }
    });
    $('.datetimepicker').datetimepicker({
        format:'m/d/Y H:i'
    });
    $('.datepicker').datetimepicker({
        timepicker:false,
        format:'m/d/Y'
    });
    $('[rel="copyText"]').click(function(){
        var selectedText = $(this).data('content');
        window.prompt("Copy to clipboard: Ctrl+C, Enter", selectedText);
    });
    $('.setIconClass').click(function(){
        var classValue = $(this).attr('data-icon-value');
        setIconClass(classValue);
    });
    /*
    $('.calendar').fullCalendar({
        // put your options and callbacks here
    });
    */
});

function setIconClass(classValue){
    $('[name="marker[icon]"]').val(classValue);
    var imageSource = '/img/markers/'+classValue+'.png';
    $('.marker-image').attr('src',imageSource);
}

function itemContainerIncreaseItems(itemsContainer){
    var numberOfItems = itemsContainer.data('itemsCount');
    itemsContainer.data('itemsCount',numberOfItems+1);
    itemContainerUpdateDisplay(itemsContainer);
}

function itemContainerUpdateDisplay(itemsContainer){
    var numberOfItems = itemsContainer.data('itemsCount');
    var currentItem = 0;
    $(itemsContainer).children('.item-container').each(function () {
        if(currentItem < numberOfItems){
            $(this).show();
        }else{
            $(this).hide();
        }
        currentItem++;
    });
}

// Stellar Dashboard
require('./../vendor/stellar-dashboard/js/off-canvas');
//import './../vendor/stellar-dashboard/js/misc';
//import './../vendor/stellar-dashboard/js/dashboard';
//