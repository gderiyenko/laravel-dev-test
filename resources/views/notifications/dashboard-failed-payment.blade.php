@if (isset($_GET['checkout_failed']))
    <input type="checkbox" id="checkout_failed" class="modal-toggle" checked/>
    <div id="checkout_failed_modal" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Payment was cancelled!</h3>
            <p class="py-4">No worries, you can try again later.</p>
        </div>
        <label class="modal-backdrop" for="checkout_failed">ok</label>
    </div>
@endif
