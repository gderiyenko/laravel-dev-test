<x-guest-layout>

    @include('components.header')

    <h1 class="text-3xl font-bold text-center">Register</h1>

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



    <form method="POST" action="{{ route('register') }}" class="sm:max-w-md mx-auto">
        @csrf

        {{-- Selected plan --}}
        <div class="card mx-auto mb-2">
            <span>
                <ion-icon name="information-circle-outline" size="small" class="mr-2"></ion-icon>
                Pass your contact info, and system will redirect you to Stripe Payment on <span id="selected" class="font-bold">B2B</span> plan.</span>
        </div>
        <input type="hidden" name="plan" value="B2B" />

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit" class="btn btn-primary ml-4">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>



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
