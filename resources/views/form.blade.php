<graphql v-cloak query='@include('rapidez-reviews::queries.ratingsMetadata')'>
    <div v-if="data" slot-scope="{ data }" class="w-full pt-7 pb-0 mb-5 rounded px-8">
        <graphql-mutation
            query="@include('rapidez-reviews::queries.reviewsForm')"
            :variables="{ ratings: [], sku: '{{ $sku }}' }"
            :clear="true"
            :recaptcha="{{ Rapidez::config('recaptcha_frontend/type_for/product_review') == 'recaptcha_v3' ? 'true' : 'false' }}"
            :notify="{ message: '@lang('You submitted your review for moderation.')' }"
        >
            <form slot-scope="{ variables, mutate, mutated }" v-on:submit.prevent="mutate">
                <div class="w-full pt-2 rounded-lg">
                    <div class="flex flex-wrap w-full">
                        <div class="w-full">
                            <div v-for="(rating, index) in data.productReviewRatingsMetadata.items" class="mb-2">
                                <x-rapidez::label>@{{ rating.name }}</x-rapidez::label>
                                <div class="flex items-center gap-0.5">
                                    <label
                                        v-for="ratingValue in rating.values"
                                        class="cursor-pointer bg-emphasis hover:text-white hover:bg-emerald-600 [&:has(~label:hover)]:bg-emerald-600 [&:has(~label:hover)]:text-white"
                                        v-bind:class="{
                                            '!text-white !bg-emerald-600': ratingValue.value <= rating.values.find((ratingValue) => ratingValue.value_id == variables.ratings[index]?.value_id)?.value,
                                        }"
                                        v-bind:title="ratingValue.label"
                                        data-testid="star-rating"
                                    >
                                        <input
                                            v-model="variables.ratings[index]"
                                            type="radio"
                                            class="sr-only"
                                            v-bind:name="'rating-' + rating.id"
                                            v-bind:value="{ id: rating.id, value_id: ratingValue.value_id }"
                                            required
                                        />
                                        <span class="flex items-center justify-center size-5 shrink-0 transition">
                                            <x-rapidez::reviews-star />
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col gap-y-3">
                                <label>
                                    <x-rapidez::label>
                                        @lang('Your name')
                                    </x-rapidez::label>
                                    <x-rapidez::input v-model="variables.nickname" name="nickname" required />
                                </label>
                                <label>
                                    <x-rapidez::label>
                                        @lang('Title of your review')
                                    </x-rapidez::label>
                                    <x-rapidez::input v-model="variables.summary" name="summary" required />
                                </label>
                                <label>
                                    <x-rapidez::label>
                                        @lang('What do you think of this product?')
                                    </x-rapidez::label>
                                    <x-rapidez::input.textarea v-model="variables.text" name="review" required />
                                </label>
                            </div>
                        </div>
                        <div class="flex flex-col gap-y-2 w-full mt-2">
                            <x-rapidez::button.primary
                                v-bind:disabled="variables.ratings.length == 0"
                                v-on:click="window.document.getElementById('review-form').checked = false"
                                class="text-base w-full"
                                type="submit"
                                data-testid="submit-review"
                            >
                                @lang('Submit Review')
                            </x-rapidez::button.primary>
                        </div>
                    </div>
                </div>
            </form>
        </graphql-mutation>
    </div>
</graphql>

@if(Rapidez::config('recaptcha_frontend/type_for/product_review') == 'recaptcha_v3' && $key = Rapidez::config('recaptcha_frontend/type_recaptcha_v3/public_key', null, true))
    @push('head')
        <script src="https://www.google.com/recaptcha/api.js?render={{ $key }}" async defer></script>
    @endpush
@endif
