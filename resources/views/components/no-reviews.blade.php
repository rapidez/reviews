<div class="w-full py-7 lg:px-7 lg:mb-5 lg:border rounded">
    <div>
        <div class="md:flex md:items-center">
            <span class="inline-block align-text-bottom">
                <x-rapidez-reviews::stars score="100" />
            </span>
        </div>
    </div>
    <strong class="block mt-2.5 font-bold text">
        @lang('Be the first to write a review')
    </strong>
    <p class="flex items-center mt-5 text-sm text">
        {{ $product->name }}
    </p>
    <x-rapidez::button.outline for="review-form" class="mt-6 justify-self-start">
        @lang('Write a review')
    </x-rapidez::button.outline>
</div>
