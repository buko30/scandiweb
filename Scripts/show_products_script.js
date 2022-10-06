$(document).ready(function () {
    displayAllProducts();

    function displayAllProducts() {
        $.post('../Controllers/showProducts.php', function (data) {
            // console.log(data);
            let info = JSON.parse(data);
            if (info.status === 'success') {
                let template = ``;
                let colCount = 0;
                info.data.forEach((obj) => {
                    if (colCount === 0) {
                        template += `<div class="row">`;
                    }
                    template += `<div class="col-md-3 mb-4">
                                     <fieldset>
                                        <div class="form-check ms-2 mt-1">
                                            <input class="form-check-input" type="checkbox" name="type" value="${obj.ID}">                                         
                                        </div>
                                        <p>${obj.SKU}</p>
                                        <p>${obj.Name}</p>
                                        <p>${parseFloat(obj.Price).toFixed(2)} $</p>
                                        <p>${(obj.type === 'dvd') ? 'Size: ' + obj.MB + ' MB' :
                        (obj.type === 'furniture') ? 'Dimensions: ' + obj.Height + 'X' + obj.Width + 'X' + obj.Length :
                            'Weight: ' + obj.KG + ' KG'}</p>
                                    </fieldset>
                                </div>`;
                    colCount++;
                    if (colCount === 4) {
                        template += `</div>`;
                        colCount = 0;
                    }
                })
                $('#product_list').html(template);
            }
        })
    }

    //----------------------------------------------------------------

    function updateMessages(id, status, text){
        let msgs = $(id);
        if(status === "success"){
            msgs.removeClass('alert-danger');
            msgs.addClass('alert-primary');
            msgs.html(text);
            msgs.show('slow');
            setTimeout(function (){
                msgs.hide('slow');
            },5000)
        }
        else if(status === "error"){
            msgs.removeClass('alert-primary');
            msgs.addClass('alert-danger');
            msgs.html(text);
            msgs.show('slow');
            setTimeout(function (){
                msgs.hide('slow');
            },5000)
        }
    }


    $('#delete-product-btn').click(function (){
        let productIDs = [];
        $("input:checkbox[name=type]:checked").each(function(){
            //console.log($(this).val());
            productIDs.push($(this).val());
        });
        if(productIDs.length){
            $.post('../Controllers/deleteProducts.php',{productIDs: productIDs}, function (data){
                console.log(data);
                let info = JSON.parse(data);
                if(info.status === 'success'){
                    displayAllProducts();
                    updateMessages('#show_products_messages','success', info.rowCount + " rows deleted");
                }
                else if(info.status === 'error'){
                    updateMessages('#show_products_messages','error', "something went wrong");

                }
            });
        }
    })

});