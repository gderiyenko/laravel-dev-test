@if (isset($_GET['checkout_url']) && $stripe_checkout = $_GET['checkout_url'])
    <input type="checkbox" id="welcome_n_checkout" class="modal-toggle" checked/>
    <div id="welcome_n_checkout_modal" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">You're welcome!</h3>
            <p class="py-4">Ready to checkout?</p>
            <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button id="cancel_checkout" class="btn">not yet</button>
                    <button id="redirect_to_stripe_checkout" class="btn btn-primary">Yes! (go to Stripe checkout)</button>
                </form>
            </div>
        </div>
        <label class="modal-backdrop" for="my_modal_7">Close</label>
    </div>


    <script>
        // close modal
        $('#cancel_checkout').click(function() {
            $('#welcome_n_checkout_modal').remove();
        });

        // redirect to Stripe checkout
        $('#redirect_to_stripe_checkout').click(function() {
            window.open('{{ $stripe_checkout }}', '_blank');
        });
    </script>
@endif
