paypal.Button.render({
    env: 'sandbox', // sandbox | production
    style: {
        label: 'checkout',  // checkout | credit | pay | buynow | generic
        size:  'responsive', // small | medium | large | responsive
        shape: 'pill',   // pill | rect
        color: 'gold'   // gold | blue | silver | black
    },

    // PayPal Client IDs - replace with your own
    // Create a PayPal app: https://developer.paypal.com/developer/applications/create

    client: {
        sandbox:    'ATAyLSGgkwKrplcTkYZpc2zkq1GcIVInGHJEPJqwZ2U6tLxS8XSdcbFlrfZvARhG5wAIRx4LBsbHLTxN',
        production: ''
    },

    // Wait for the PayPal button to be clicked

    payment: function(data, actions) {
        return actions.payment.create({
            payment: {
                transactions: [
                    {
                        amount: { total: $('.lead').attr('data-total'), currency: 'EUR' }, 
                        description: "Compra de productos a Develoteca: "+$('.lead').attr('data-total')+"€",
                        custom: $('.lead').attr('data-id')+"#"+$('.lead').attr('data-idVenta')
                    }
                ]
            }
        });
    },

    /*
    onApprove: function (data, actions) {
        return actions.order.capture().then(function(details){
            window.location.replace("http://localhost/carrito/success.php");
        })
    },
    */
    
    // Wait for the payment to be authorized by the customer

    onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function() {
            console.log(data);
            window.location = "/verificar/"+data.paymentToken+"/"+data.paymentID;
        });
    }

}, '#paypal-button-container');
