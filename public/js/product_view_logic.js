$("#less_button").click(function(){
    var total= parseInt($("#stock_units").text());
    if (total>1){
      total=total-1;
    }
    $("#stock_units").text(total);
});

$("#plus_button").click(function(){
    var total= parseInt($("#stock_units").text());
      total=total+1;
    $("#stock_units").text(total);
});

$('#addToCartButton').click(function () {
  /* find id */
  var id = parseInt($("#product_id").text());

  var stock_units=parseInt($("#stock_units").text());
  var params = {
    id: id,
    stock_units: stock_units
  };
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  request = $.ajax({
    url: "addToCart",
    type: "POST",
    data: params
  }); // Callback handler that will be called on success

  request.done(function (response, textStatus, jqXHR) {
    // Log a message to the console
    //console.log(response);
    //console.log(textStatus); //push array
    location.reload();

  });
  request.fail(function (jqXHR, textStatus, errorThrown) {
    // Log the error to the console
    console.error("The following error occurred: " + textStatus, errorThrown);
  });
});
