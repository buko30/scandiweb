$(document).ready(function () {
    $('#productType').change(function () {
        let selectedVal = $("#productType option:selected").val();
        // console.log(`selectedVal = ${selectedVal}`)
        let template = ``;
        switch (selectedVal) {
            case 'dvd':
                template = `
                    <div class="row mt-2">
                        <div class="col-md-1">
                            Size (MB)
                        </div>
                        
                        <div class="col-md-2">
                            <input id="size" type="text" class="form-control">
                        </div>
                        
                        <div id="size_messages" class="col-md-5"></div>
                    </div>
               `;
                break;

            case 'furniture':
                template = `
                        <div class="row mt-2">
                            <div class="col-md-1">
                                Height (CM)
                            </div>
                            
                            <div class="col-md-2">
                                <input id="height" type="text" class="form-control">
                            </div>
                            
                            <div id="height_messages" class="col-md-5"></div>
                        </div>
                        
                        <div class="row mt-2">
                            <div class="col-md-1">
                                Width (CM)
                            </div>
                            
                            <div class="col-md-2">
                                <input id="width" type="text" class="form-control">
                            </div>
                            
                            <div id="width_messages" class="col-md-5"></div>
                        </div>
                        
                        <div class="row mt-2">
                            <div class="col-md-1">
                                Length (CM)
                            </div>
                            
                            <div class="col-md-2">
                                <input id="length" type="text" class="form-control">
                            </div>
                            
                            <div id="length_messages" class="col-md-5"></div>
                        </div>
               `;
                break;

            case 'book':
                template = `
                        <div class="row mt-2">
                            <div class="col-md-1">
                                Weight (KG)
                            </div>
                            
                            <div class="col-md-2">
                                <input id="weight" type="text" class="form-control">
                            </div>
                            
                            <div id="weight_messages" class="col-md-5"></div>
                        </div>
               `;

                break;

            default:
                break;
        }


        $('#subSection').html(template);

    })


    function cstTrim(txt) {
        if (txt === undefined || txt === null)
            return null;
        return txt.trim();
    }

    function validateSku(txt) {

        return txt !== null && txt.length >= 2 && txt.length <= 15;
    }

    function validateName(txt) {

        return txt !== null && txt.length >= 2 && txt.length <= 30;
    }

    function isNumber(txt) {
        return !isNaN(txt) && !isNaN(parseFloat(txt));
    }


    function validateForm(sku, name, price, productType, size, height, width, length, weight) {
        let isSku = validateSku(sku);
        let isName = validateName(name);
        let isPrice = isNumber(price);
        let isProductType = productType !== "-1";
        let isSize = (productType === 'dvd' && isNumber(size) || productType !== 'dvd');
        let isHeight = (productType === 'furniture' && isNumber(height) || productType !== 'furniture');
        let isWidth = (productType === 'furniture' && isNumber(width) || productType !== 'furniture');
        let isLength = (productType === 'furniture' && isNumber(length) || productType !== 'furniture');
        let isWeight = (productType === 'book' && isNumber(weight) || productType !== 'book');

        //updateMessages
        if (!isSku)
            $('#sku_messages').html(`<h6 class="error">Please, provide proper SKU</h6>`);
        else
            $('#sku_messages').html(``);

        if (!isName)
            $('#name_messages').html(`<h6 class="error">Please, provide Name</h6>`);
        else
            $('#name_messages').html(``);

        if (!isPrice)
            $('#price_messages').html(`<h6 class="error">Please, provide price</h6>`);
        else
            $('#price_messages').html(``);

        if (!isProductType)
            $('#productType_messages').html(`<h6 class="error">Please, provide Product Type</h6>`);
        else
            $('#productType_messages').html(``);

        if (!isSize)
            $('#size_messages').html(`<h6 class="error">Please, provide size</h6>`);
        else
            $('#size_messages').html(``);

        if (!isHeight)
            $('#height_messages').html(`<h6 class="error">Please, provide height</h6>`);
        else
            $('#height_messages').html(``);

        if (!isWidth)
            $('#width_messages').html(`<h6 class="error">Please, provide width</h6>`);
        else
            $('#width_messages').html(``);

        if (!isLength)
            $('#length_messages').html(`<h6 class="error">Please, provide length</h6>`);
        else
            $('#length_messages').html(``);

        if (!isWeight)
            $('#weight_messages').html(`<h6 class="error">Please, provide weight</h6>`);
        else
            $('#weight_messages').html(``);

        //end of messages
        return isSku && isName && isPrice && isProductType && isSize && isHeight && isWidth && isLength && isWeight;
    }


    function updateMessages(status, text){
        let msgs = $("#save_product_messages");
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


    $("#product_form").on("submit", function (e) {
        e.preventDefault();

        let sku = cstTrim($('#sku').val());
        let name = cstTrim($('#name').val());
        let price = cstTrim($('#price').val());
        let productType = $("#productType option:selected").val();
        let size = cstTrim($('#size').val());
        let height = cstTrim($('#height').val());
        let width = cstTrim($('#width').val());
        let length = cstTrim($('#length').val());
        let weight = cstTrim($('#weight').val());



        if (validateForm(sku, name, price, productType, size, height, width, length, weight)) {
            const postData = {
                sku: sku,
                name: name,
                price: parseFloat(price).toFixed(2),
                productType: productType,
                size: (size !== null) ? parseFloat(size).toFixed(2) : null,
                height: (height !== null) ? parseFloat(height).toFixed(2) : null,
                width: (width !== null) ? parseFloat(width).toFixed(2) : null,
                length: (length !== null) ? parseFloat(length).toFixed(2) : null,
                weight: (weight !== null) ? parseFloat(weight).toFixed(2) : null,
            };



            $.post('../Controllers/saveProduct.php', postData, function (data){
               //console.log(data)
                let info = JSON.parse(data);
                if(info.status === "error" && info.message === "SKU_not_unique")
                {
                    $('#sku_messages').html(`<h6 class="error">SKU must be unique</h6>`);
                    updateMessages("error","SKU must be unique")
                }
                else if(info.status === "success")
                {
                    $('#product_form').trigger('reset');
                    updateMessages("success","Product has been saved successfully")
                }
            });
        }
    });

});