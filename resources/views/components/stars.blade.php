@props(['score' => 0, 'count' => null])

<div {{ $attributes->twMerge('flex items-center gap-1') }}>
    <div class="relative">
        <div class="flex gap-0.5">
            @for ($star = 0; $star < 5; $star++)
                <x-heroicon-s-star class="text-muted/50 size-5" />
            @endfor
        </div>
        <div
            v-bind:style="{ width: ({{ $score }} || 0) + '%'}"
            style="width: {{ (int)$score }}%"
            class="absolute inset-0 flex gap-0.5 overflow-hidden"
        >
            @for ($star = 0; $star < 5; $star++)
                <x-heroicon-s-star class="size-5 shrink-0 text-yellow-400" />
            @endfor
        </div>
    </div>
    @if ($count)
        <span class="text-sm" v-text="'(' + ({{ $count }} || 0) + ')'">
            ({{ (int)$count }})
        </span>
    @endif
</div>
