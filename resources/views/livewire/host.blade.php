<div
    style="position:fixed;right:1rem;bottom:1rem;z-index:10000;display:flex;flex-direction:column;gap:0.5rem;width:min(22rem,calc(100vw - 2rem));pointer-events:none;"
    aria-live="polite"
>
    @foreach ($toasts as $toast)
        @php
            $colors = match ($toast['type']) {
                'success' => 'border-emerald-200 bg-emerald-50 text-emerald-900',
                'error' => 'border-red-200 bg-red-50 text-red-900',
                'warning' => 'border-amber-200 bg-amber-50 text-amber-950',
                default => 'border-sky-200 bg-sky-50 text-sky-950',
            };
        @endphp
        <div
            wire:key="{{ $toast['id'] }}"
            x-data="{ show: true }"
            x-init="setTimeout(() => { show = false; setTimeout(() => $wire.dismiss(@js($toast['id'])), 200) }, 4200)"
            x-show="show"
            x-transition.opacity.duration.200ms
            class="pointer-events-auto rounded-xl border px-3.5 py-3 text-sm shadow-lg {{ $colors }}"
            style="box-shadow:0 10px 30px rgba(15,23,42,.12);"
        >
            <div class="flex items-start gap-2">
                <p class="min-w-0 flex-1 font-medium">{{ $toast['message'] }}</p>
                <button
                    type="button"
                    class="shrink-0 rounded-md px-1.5 py-0.5 text-xs opacity-70 hover:opacity-100"
                    wire:click="dismiss(@js($toast['id']))"
                >
                    ×
                </button>
            </div>
        </div>
    @endforeach
</div>
