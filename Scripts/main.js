$( document ).ready(function() {
    console.log( "ready!" );

    $('#red_add_product').click(function (){
        window.location.href = "http://localhost/WEBSITES/Authors/ScandiWeb/App/Views/add_new_product.php";
    });

    $('#red_add_product2').click(function (){
        // console.log('inside red_add_product2');
        window.location.href = "http://localhost/WEBSITES/Authors/ScandiWeb/App/Views/add_new_product.php";
    });


    $('#red_show_product').click(function (){
        window.location.href = "http://localhost/WEBSITES/Authors/ScandiWeb/App/Views/show_products.php";
    });


    $('#red_welcome').click(function (){
        window.location.href = "http://localhost/WEBSITES/Authors/ScandiWeb/App/Views/index.php";
    });
});