


$(document).ready(function () {
    let qte =1;
    let price =    $('#quick-order').data('choosen-price');
    console.log(price);
    let selectedWilaya= $('select[name="wilaya_id"] option:selected') ;
    let homeDeliveryRadio = $('#homeDelivery');
    let stopDeskRadio = $('#stopDesk');
    let priceHomeDelivery=$('#priceHomeDelivery');
    let priceStopDesk=$('#priceStopDesk');


    updateView();
    $('span#incrementQty').click(function(){
               
        $('input[name="product_qty"]').val(parseInt($('input[name="product_qty"]').val())+1  );
        updateView();

    });
    $('span#decrementQty').click(function(){
        if($('input[name="product_qty"]').val()>1){
            $('input[name="product_qty"]').val(parseInt($('input[name="product_qty"]').val())-1);
            updateView();

        }

    });
    function updateView(){
        $('#submitBtn').attr('disabled',selectedWilaya.val()==="");

        //based on selected wilaya get Costs:   
        if(selectedWilaya.data("home") ==="" || selectedWilaya.data("home")=== undefined ){
            priceHomeDelivery.text("");
            homeDeliveryRadio.attr('disabled',true);
            homeDeliveryRadio.data('cost',undefined);
        }   
        else {
            priceHomeDelivery.text(selectedWilaya.data("home")+"دج");
            homeDeliveryRadio.attr('disabled',false);
            homeDeliveryRadio.attr('checked',true);
            homeDeliveryRadio.data('cost',selectedWilaya.data("home"));

        } 
        if(selectedWilaya.data('stop-desk')==="" || selectedWilaya.data('stop-desk')===undefined ){
            priceStopDesk.text(selectedWilaya.data("stop-desk"));
            stopDeskRadio.attr('disabled',true);
            stopDeskRadio.attr('checked',false);
            stopDeskRadio.data('cost',undefined);
        }
        else {
            priceStopDesk.text(selectedWilaya.data("stop-desk") +"دج");
            stopDeskRadio.attr('disabled',false);
            stopDeskRadio.data('cost',selectedWilaya.data("stop-desk"));

        }

        choosenDeliveryCost= $('input[name="delivery"]:checked').data('cost'); 
        qte = parseInt($('input[name="product_qty"]').val());

        total = (qte*price)+ choosenDeliveryCost;
        console.log(qte);
        console.log(price);
        console.log(choosenDeliveryCost);
        if(!isNaN(total))
            $('#total').text(total +"دج");

        
        console.log('done')

    }
    $('input[name="delivery"]').on('change', function(){
        updateView();
    });
    //check if wilaya changes : 
    $('select[name="wilaya_id"]').on('change', function(){
        selectedWilaya=$('select[name="wilaya_id"] option:selected')
        updateView();
    });


});