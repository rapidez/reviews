@props(['score' => 0, 'count' => null])

<div {{ $attributes->twMerge('flex items-center gap-1') }}>
    <div class="relative">
        <div class="flex gap-0.5">
            @for ($star = 0; $star < 5; $star++)
                <div class="flex items-center justify-center bg-emphasis size-5">
                    <x-rapidez-reviews::star-icon />
                </div>
            @endfor
        </div>
        <div
            v-bind:style="{ width: ({{ $score }} || 0) + '%'}"
            style="width: {{ (int)$score }}%"
            class="absolute inset-0 flex gap-0.5 overflow-hidden"
        >
            @for ($star = 0; $star < 5; $star++)
                <div class="flex items-center justify-center bg-success size-5 shrink-0">
                    <x-rapidez-reviews::star-icon />
                </div>
            @endfor
        </div>
    </div>
    @if ($count)
        <span class="text-sm" v-text="'(' + ({{ $count }} || 0) + ')'">
            ({{ (int)$count }})
        </span>
    @endif
</div>
