
  $("#btn-submit").click(function(){
    var stripe = Stripe("pk_test_51IGkTPAy4FlKjV1rR8rdRHaAxJsSSPprkfsJuByNTPqIXwsh14QQW4FfZ6ftiXiNeCcvz2KC3P4Hoj4SnXGnPtyg002DjH39FE");
    Stripe.setPublishableKey("pk_test_51IGkTPAy4FlKjV1rR8rdRHaAxJsSSPprkfsJuByNTPqIXwsh14QQW4FfZ6ftiXiNeCcvz2KC3P4Hoj4SnXGnPtyg002DjH39FE");
    Stripe.card.createToken({
        number: $('#ccn').val(),
        cvc: $('#cvc').val(),
        exp_month: parseInt($('#expiry_month').val()),
        exp_year: parseInt($('#expiry_year').val())
      }, stripeHandleResponse);
  });

  function stripeHandleResponse(status, response) {
          if (response.error) {
                  console.log("Create Token Error");
          } else {
              var token = response['id'];
              var shoppingCartId=parseInt($("#shoppingCartId").val());
              var address = $("#send_address").val();
              var cp = $("#cp").val();
              var country = $("#country").val();
              var provincia = $("#provincia").val();
              console.log(shoppingCartId);
              var params = {
                token: token,
                shoppingCartId:shoppingCartId,
                address:address,
                cp:cp,
                country:country,
                provincia:provincia
              };
              $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              request = $.ajax({
                url: "pay",
                type: "POST",
                data: params
              }); // Callback handler that will be called on success

              request.done(function (response, textStatus, jqXHR) {
                // Log a message to the console
                console.log(response);
                console.log(textStatus); //push array
                console.log("Payment Done");

              });
              request.fail(function (jqXHR, textStatus, errorThrown) {
                // Log the error to the console
                console.error("The following error occurred: " + textStatus, errorThrown);
              });

          }
      }
