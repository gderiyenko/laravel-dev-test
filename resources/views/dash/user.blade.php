<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __("You're logged in as `Regular user`!") }}
                <strong>{{ __('(Plan required)') }}</strong>
            </div>
        </div>
    </div>
</div>

{{-- row, center, gap --}}
<div id="plan-select" class="grid grid-cols-2 gap-4 justify-center mt-5 mb-5">

    {{-- Product (B2C), to right --}}
    <div class="card w-96 shadow-xl ms-auto bg-base-100">
        <figure><img src="/img/plan-individual.png" alt="Individual Plan" /></figure>
        <div class="card-body">
            <h2 class="card-title">B2C</h2>
            <p>Individual plan</p>
            <div class="card-actions justify-start">
                <button class="btn btn-primary">Select</button>
            </div>
        </div>
    </div>

    {{-- Product (B2B), center --}}
    <div class="card w-96 shadow-xl bg-primary-content">
        <figure><img src="/img/plan-business.jpg" alt="Business Plan" /></figure>
        <div class="card-body rounded">
            <h2 class="card-title">B2B</h2>
            <p>Business plan</p>
            <p>For groups and large teams.</p>
            <div class="card-actions justify-start">
                <button class="btn btn-primary">Selected</button>
            </div>
        </div>
    </div>
</div>

{{-- to payment --}}
<div class="container mx-auto w-50 p-5">
    <form class="items-center justify-center mt-4">

        {{-- Selected plan --}}
        <div class="card mx-auto mb-2">
            <span>
                <ion-icon name="information-circle-outline" size="small" class="mr-2"></ion-icon>
                System will redirect you to Stripe Payment on <span id="selected" class="font-bold">B2B</span>
                plan.</span>
        </div>
        <input type="hidden" name="plan" value="B2B" />

        <button class="btn btn-neutral">
            <ion-icon name="card-outline" class="text-base-100" size="large" style="color: white;"></ion-icon>
            {{ __('To payment') }}
        </button>
    </form>
</div>


@pushOnce('bottom-scripts')
    {{-- Select plan --}}
    <script>
        // on click "select", add bg-primary-content, and remove from other
        $("#plan-select .btn.btn-primary").click(function() {
            let itemSelected = $(this).closest(".card");
            let itemDisabled = $(this).closest(".card").siblings();

            itemSelected.addClass("bg-primary-content").removeClass("bg-base-100"); // activate this item
            itemDisabled.removeClass("bg-primary-content").addClass("bg-base-100"); // disable another plan

            // change button text
            $(this).text("Selected");
            itemDisabled.find(".btn.btn-primary").text("Select");

            // Change text in selected plan
            let selectedPlan = $(this).closest(".card").find(".card-title").text();
            $("#selected").text(selectedPlan);

            // Change value in hidden input
            $("input[name='plan']").val(selectedPlan);
        });
    </script>
@endPushOnce
