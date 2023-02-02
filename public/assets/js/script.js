
// category to product select in add item
$(document).ready(function() {
    $('#categoryList').on('change', function() {
        $("#productList").attr('disabled', false); //enable subcategory select
        $("#productList").val("");
        $(".product").attr('disabled', true); //disable all category option
        $(".product").hide(); //hide all subcategory option
        $(".parent-" + $(this).val()).attr('disabled',false); //enable subcategory of selected category/parent
        $(".parent-" + $(this).val()).show();
    });
});

//cart items

document.getElementById('cartItem').addEventListener('click', function (){
        console.log("function running");
        var cartItem = document.getElementById('cartItem');
        // var cart = document.getElementById('cart');
        var itemId = cartItem.innerHTML;
        // var cartArray = [];
        // cartArray.push(itemId);
        console.log(itemId);
});




document.getElementById('quantityUp').addEventListener('click', function (){
    console.log('function running');
    var quantityUp = document.getElementById('quantity');
    var price = document.getElementById('price');
    var totalPrice = price * quantityUp;
    price.innerHTML = totalPrice;
});





