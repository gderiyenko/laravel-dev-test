@if (isset($_GET['checkout_success']))
    <input type="checkbox" id="successful_payment" class="modal-toggle" checked/>
    <div id="successful_payment_modal" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Your account was upgraded!</h3>
            <p class="py-4">Thank you for participating in our beta program.</p>
        </div>
        <label class="modal-backdrop" for="successful_payment">Close</label>
    </div>
@endif
