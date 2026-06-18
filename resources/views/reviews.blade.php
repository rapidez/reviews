<div class="flex w-full justify-between gap-x-14 mt-20 max-lg:flex-col">
    <div class="lg:w-96">
        <div class="flex flex-col">
            <div class="flex flex-wrap items-center justify-between">
                <div class="flex flex-col">
                    <div class="text-2xl text font-semibold">@lang('Product reviews')</div>
                    <div class="mt-2.5 flex flex-wrap items-center gap-x-2">
                        <x-rapidez-reviews::stars :score="$product->reviews_score" open-review-sidebar />
                        <div class="text-sm text-muted font-normal">
                            @if($product->reviews_count)
                                {{ $product->reviews_count }} @lang('Reviews')
                            @else
                                @lang('No reviews yet')
                            @endif
                        </div>
                    </div>
                </div>
                <div class="border shadow-sm flex flex-col rounded border bg-white p-4 pb-2.5">
                    <div class="text font-bold">
                        <span class="text-secondary text-2xl mr-1.5" data-testid="rating-number">{{ number_format($product->reviews_score / 10, 1) }}</span>/ 10
                    </div>
                    <div class="text-sm text mt-1 text-center font-normal">@lang('Rating')</div>
                </div>
            </div>
            <div class="mt-6 flex flex-col gap-y-2.5">
                @foreach($product->reviewCountPerStar(5)->reverse() as $star => $reviewsCount)
                    <div class="flex flex-wrap items-center justify-between">
                        <div class="text-sm text flex items-center gap-x-2.5 font-medium">
                            <div class="w-2">{{ $star }}</div>
                            <div @class([
                                "flex items-center justify-center relative size-[18px] shrink-0",
                                "bg-emerald-600" => $reviewsCount,
                                "bg-emphasis" => !$reviewsCount,
                                ])>
                                <x-rapidez::reviews-star />
                            </div>
                        </div>
                        <x-rapidez-reviews::bar class="mx-4 flex-1" :score="$reviewsCount / ($product->reviews_count == 0 ? 1 : $product->reviews_count) * 100" />
                        <div class="text-sm text-muted text-left font-normal min-w-20">
                            @choice(':count Review|:count Reviews', $reviewsCount)
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 flex flex-col gap-y-1.5">
                <div class="text-lg text font-semibold">@lang('Share your experience')</div>
                <div class="text font-normal">
                    @lang('Are you familiar with this article? Share your experience with others and let us know what you think!')
                </div>
            </div>
            <x-rapidez::button.secondary
                for="review-form"
                class="mt-4 w-full"
                data-testid="write-review-button"
            >
                @lang('Write a review')
            </x-rapidez::button.secondary>
            <x-rapidez::slideover id="review-form" position="right">
                <x-slot:title class="mx-0">@lang('Write a review')</x-slot:title>
                @include('rapidez-reviews::form', ['sku' => $product->sku])
            </x-rapidez::slideover>
        </div>
    </div>
    <div class="w-full flex-1">
        @include('rapidez-reviews::components.reviews', ['sku' => $product->sku, 'reviews_count' => $product->reviews_count, 'reviews_score' => $product->reviews_score])
    </div>
</div>
