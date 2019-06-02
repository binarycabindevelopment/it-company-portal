<script>
    var customerFacilities = {!! json_encode(\App\Options\CustomerFacilityId::get()) !!};
    $(function() {
        if($('#customer_id').length && $('#mappable_id').length){
            updateCustomerFacilityies();
            $('#customer_id').change(function(){
                updateCustomerFacilityies();
            });
        }
    });
    function updateCustomerFacilityies(){
        var customerFacilityId = $('#customer_id').val();
        var currentSelectedFacilityId = $('#mappable_id').val();
        var clearSelectedFacilityId = true;
        $('#mappable_id option[value!=""]').hide();
        if(customerFacilities.hasOwnProperty(customerFacilityId)){
            showOnlyTheseFacilityIds = customerFacilities[customerFacilityId];
            for(var i=0;i<showOnlyTheseFacilityIds.length;i++){
                if(currentSelectedFacilityId == showOnlyTheseFacilityIds[i]){
                    clearSelectedFacilityId = false;
                }
                $('#mappable_id option[value="'+showOnlyTheseFacilityIds[i]+'"]').show();
            }
        }
        if(clearSelectedFacilityId){
            $('#mappable_id').val('');
        }
    }
</script>