<script>
    var customerFacilities = {!! json_encode(\App\Options\CustomerFacilityId::get()) !!};
    $(function() {
        if($('#customer_id').length && $('#assetable_id').length){
            updateCustomerFacilityies();
            $('#customer_id').change(function(){
                updateCustomerFacilityies();
            });
        }
    });
    function updateCustomerFacilityies(){
        var customerFacilityId = $('#customer_id').val();
        var currentSelectedFacilityId = $('#assetable_id').val();
        var clearSelectedFacilityId = true;
        $('#assetable_id option[value!=""]').hide();
        if(customerFacilities.hasOwnProperty(customerFacilityId)){
            showOnlyTheseFacilityIds = customerFacilities[customerFacilityId];
            for(var i=0;i<showOnlyTheseFacilityIds.length;i++){
                if(currentSelectedFacilityId == showOnlyTheseFacilityIds[i]){
                    clearSelectedFacilityId = false;
                }
                $('#assetable_id option[value="'+showOnlyTheseFacilityIds[i]+'"]').show();
            }
        }
        if(clearSelectedFacilityId){
            $('#assetable_id').val('');
        }
    }
</script>