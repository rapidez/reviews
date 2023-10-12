<div class="top-5 self-start w-full rounded bg-white p-4">
    <x-rapidez::recaptcha location="product_review"/>
    <graphql-mutation
        query="mutation review ($sku: String!, $nickname: String!, $summary: String!, $text: String!, $ratings: [ProductReviewRatingInput!]!) { createProductReview ( input: { sku: $sku, nickname: $nickname, summary: $summary, text: $text, ratings: $ratings } ), { review { nickname summary text average_rating ratings_breakdown { name value } } } }"
        :variables="{ ratings: [], sku: '{{ $sku }}' }"
        :clear="true"
        :recaptcha="{{ Rapidez::config('recaptcha_frontend/type_for/product_review') == 'recaptcha_v3' ? 'true' : 'false' }}"
    >
        <div slot-scope="{ variables, mutate, mutated }">
            <form @submit="mutate">
                <div class="w-full bg-white rounded-lg pt-2">
                    <strong class="text-1xl">@lang('Add Your Review')</strong>
                    <div class="flex flex-wrap w-full">
                        <div class="w-full">
                            <graphql query='@include('rapidez-reviews::queries.ratingsMetadata')'>
                                <div v-cloak v-if="data" slot-scope="{ data }">
                                    <div class="mb-2" v-for="(rating, index) in data.productReviewRatingsMetadata.items">
                                        <x-rapidez::label>@{{ rating.name }}</x-rapidez::label>
                                        <star-input v-model="variables.ratings[index]" :rating="rating">
                                            <fieldset class="flex items-center" slot-scope="{ rating, isActive, _renderProxy: starInput }">
                                                <label v-for="ratingValue in rating.values">
                                                    <x-heroicon-s-star class="w-5 h-5 cursor-pointer" v-bind:class="isActive(ratingValue) ? 'text-neutral' : 'text-gray-400'"/>
                                                    <input class="sr-only" type="radio" v-model="starInput.value" :name="'stars' + rating.id" :value="{ id: rating.id, value_id: ratingValue.value_id }" required />
                                                </label>
                                            </fieldset>
                                        </star-input>
                                    </div>
                                </div>
                                <div v-else class="blur animate-pulse mb-2">
                                    <x-rapidez::label>@lang('Rating')</x-rapidez::label>
                                    <div class="flex">
                                        @for ($i = 0; $i < 5; $i++)
                                            <x-heroicon-s-star class="w-5 h-5 cursor-pointer text-gray-400" />
                                        @endfor
                                    </div>
                                </div>
                            </graphql>
                            <div class="space-y-2">
                                <x-rapidez::input v-model="variables.nickname" name="nickname" required/>
                                <x-rapidez::input v-model="variables.summary" name="summary" required/>
                                <x-rapidez::textarea v-model="variables.text" name="review" required/>
                            </div>
                        </div>
                        <div class="w-full flex items-center mt-2">
                            <x-rapidez::button type="submit">
                                @lang('Submit Review')
                            </x-rapidez::button>
                            <span v-if="mutated" v-cloak class="ml-3 text-green-500">
                                @lang('You submitted your review for moderation.')
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </graphql-mutation>
</div>
