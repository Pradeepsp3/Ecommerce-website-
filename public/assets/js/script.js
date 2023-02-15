
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


// // download invoice
function exportPDF(invoiceNo){
    invoiceNo = JSON.stringify(invoiceNo);
    console.log(invoiceNo);
    var options = {
  };
  var pdf = new jsPDF('l', 'pt', 'a5');
  pdf.addHTML($("#printInvoice"), 15, 15, options, function() {
    pdf.save(`Invoice${invoiceNo}.pdf`);
  });
}


//view Debit Card Details
function debitCardView(){
    document.getElementById('debitView').style.display = 'block';
    document.getElementById('creditView').style.display = 'none';
}

//view Credit Card Details
function creditCardView(){
    document.getElementById('creditView').style.display = 'block';
    document.getElementById('debitView').style.display = 'none';
}

//view cards selection section on checkout page
function viewCardsAdded(){
    document.getElementById('viewCardsAdded').style.display = 'block';

}


// //add items to sessions
// function addItemToSession(id){
//     var itemIds = [];
//     itemIds.push(id);
//     document.getElementById('cart').innerHTML += 1;
//     console.log(itemIds);
// }
