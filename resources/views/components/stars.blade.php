@props(['score' => 0, 'count' => null])

<div {{ $attributes->twMerge('flex items-center gap-1') }}>
    <div class="relative">
        <div class="flex gap-0.5">
            @for ($star = 0; $star < 5; $star++)
                <x-heroicon-s-star class="size-5 text-muted/50" />
            @endfor
        </div>
        <div
            style="width: {{ (int)$score }}%"
            v-bind:style="{ width: ({{ $score }} || 0) + '%'}"
            class="absolute inset-0 flex gap-0.5 overflow-hidden"
        >
            @for ($star = 0; $star < 5; $star++)
                <x-heroicon-s-star class="size-5 shrink-0 text-yellow-400" />
            @endfor
        </div>
    </div>
    @if ($count || $attributes->has('v-bind:count'))
        <span
            class="text-sm"
            @if ($attributes->has('v-bind:count'))
                v-text="'(' + ({{ $attributes['v-bind:count'] }} || 0) + ')'"
            @endif
        >
            ({{ $count }})
        </span>
    @endif
</div>
