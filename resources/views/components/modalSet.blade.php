@props(['id', 'maxWidth', 'maxWidth2' => '', 'close', 'content' => null])

@php
    $id = $id ?? md5($attributes->wire('model'));
    
    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '90' => 'sm:max-w-[90%]',
        '80' => 'sm:max-w-[80%]',
        '70' => 'sm:max-w-[70%]',
        '60' => 'sm:max-w-[60%]',
        '50' => 'sm:max-w-[50%]',
        '40' => 'sm:max-w-[40%]',
        '30' => 'sm:max-w-[30%]',
        '20' => 'sm:max-w-[20%]',
        '10' => 'sm:max-w-[10%]',
    ][$maxWidth ?? '2xl'];
@endphp

<div x-data="{
    show: @entangle($attributes->wire('model')),
    focusables() {
        // All focusable element types...
        let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'

        return [...$el.querySelectorAll(selector)]
            // All non-disabled elements...
            .filter(el => !el.hasAttribute('disabled'))
    },
    firstFocusable() { return this.focusables()[0] },
    lastFocusable() { return this.focusables().slice(-1)[0] },
    nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
    prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
    nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
    prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1 },
}" x-init="$watch('show', value => {
    if (value) {
        document.body.classList.add('overflow-y-hidden');
        document.body.classList.add('overflow-x-hidden');
        {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
    } else {
        document.body.classList.remove('overflow-y-hidden');
        document.body.classList.remove('overflow-x-hidden');
    }
})" x-on:close.stop="show = false" {{-- x-on:keydown.escape.window="show = false" --}}
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()" x-show="show" id="{{ $id }}"
    class="jetstream-modal fixed inset-0 px-8 py-6 sm:px-0 z-[99999]" style="display: none;">

    <div x-show="show" class="fixed inset-0 transform transition-all" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-[#1D1D1D]/90 backdrop-blur-md"></div>
    </div>

    <div x-show="show" class="relative {{ $maxWidth2 }}  mx-auto" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

        <div
            class="overflow-y-auto p-8 NunitoRegular text-sm rounded-lg scrollVerde relative z-10  shadow-xl transform transition-all sm:w-full scrollbar-hide h-full max-h-[90vh] border-2 border-white bg-[#F1F5F9]">
            {{ $content }}
        </div>

        <div wire:click="$set('{{ $close }}', false)"
            class="w-10 h-10 z-50 top-3 right-3 shadow-md shadow-[#000000]/10 absolute bg-[#F1F5F9] hover:bg-[#F1F5F9]/90 rounded-full text-[#64748B] border border-[#E2E8F0] flex justify-center items-center cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-7 h-7">
                <path
                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
            </svg>
        </div>
    </div>
</div>
