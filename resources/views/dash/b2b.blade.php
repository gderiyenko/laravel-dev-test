<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __("You're logged in as `B2B user`!") }}
            </div>
        </div>
    </div>
</div>

{{-- label B2B Purchase Details --}}
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __("B2B Purchase Details:") }}
                <br>
                {{ auth()->user()->purchaces->first()->last_digits ?? 'No purchaces yet' }}
            </div>
        </div>
    </div>
</div>