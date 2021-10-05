<div class="fixed inset-x-0 bottom-0 z-50 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end"
    wire:key="alerSuccess">
    <div 
    x-data="{ show: false }"
        x-init="() => {
            setTimeout(() => show = true, 0);
            setTimeout(() => show = false, 5000);
        }"
    x-show="show" 
    x-description="Notification panel, show/hide based on alert state." 
    @click.away="show = false" 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-90"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-90"
        class="w-full max-w-sm bg-white rounded-lg shadow-lg pointer-events-auto">
    <div class="overflow-hidden text-white bg-green-500 rounded-lg shadow-xs">
        <div class="p-4">
        <div class="flex items-start">
            <div class="flex-shrink-0 w-12 h-12">
                <svg class="text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-3 w-0 flex-1 pt-0.5">
            <p class="text-sm font-medium leading-5 text-white">
                {{ session('success') }}
            </p>
            </div>
            <div class="flex flex-shrink-0 w-6 h-6 ml-4">
            <button @click="show = false" class="inline-flex text-gray-400 transition duration-150 ease-in-out focus:outline-none focus:text-gray-500">
                <svg class="text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>