Stripe.setPublishableKey('pk_test_u6WyT5Rlfr96r3gIAMz0YWlB');

var $form = $('#checkout-form');

$form.submit(function(event){

  $('#charge-error').addClass('hidden');
  $form.find('button').prop('disabled', true);
  Stripe.card.createToken({

    name: $('#card-name').val(),
    address: $('#card-address').val(),
    number: $('#card-number').val(),
    cvc: $('#card-cvc').val(),
    exp_month: $('#card-expiry-month').val(),
    exp_year: $('#card-expiry-year').val()

  }, stripeResponseHandler);
  return false;
});

function stripeResponseHandler(status , response){
  if(response.error) { // problem!
    // Show the errors on the form
    $('#charge-error').removeClass('hidden');
    $('#charge-error').text('response.error.message');
    $form.find('button').prop('disabled', false);

  }
  else{//Token was created
    //get token id
    var token = response.id;

    // Insert the token into the form so it gets submitted to the server:
   $form.append($('<input type="hidden" name="stripeToken" />').val(token));

   // Submit the form:
   $form.get(0).submit();

  }
}
