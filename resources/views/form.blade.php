<graphql v-cloak query='@include('rapidez-reviews::queries.ratingsMetadata')'>
    <div v-if="data" slot-scope="{ data }">
        <graphql-mutation query="mutation { createProductReview ( input: changes ), { review { nickname summary text average_rating ratings_breakdown { name value } } } }" :clear="true" :recaptcha="{{ Rapidez::config('recaptcha_frontend/type_for/product_review') == 'recaptcha_v3' ? 'true' : 'false' }}">
            <form slot-scope="{ changes, mutate, mutated }" v-on:submit.prevent="mutate">
                <div class="w-full max-w-xl bg-white rounded-lg pt-2">
                    <strong class="text-1xl">@lang('Add Your Review')</strong>
                    <div class="flex flex-wrap w-full">
                        <div class="w-full md:max-w-xl">
                            <x-rapidez::label>@lang('Rating')</x-rapidez::label>
                            <star-input class="mb-2" v-model="changes.ratings" name="ratings" :rating-id="data.productReviewRatingsMetadata.items[0].id" :rating-values="data.productReviewRatingsMetadata.items[0].values"></star-input>
                            <input type="hidden" v-bind:value="changes.sku = '{{ $sku }}'" v-on:input="changes.sku = $event" name="sku" />
                            <div class="space-y-2">
                                <x-rapidez::input v-model="changes.nickname" name="nickname" required/>
                                <x-rapidez::input v-model="changes.summary" name="summary" required/>
                                <x-rapidez::textarea v-model="changes.text" name="review" required/>
                            </div>
                        </div>
                        <div class="w-full flex items-center mt-2">
                            <x-rapidez::button type="submit">
                                @lang('Submit Review')
                            </x-rapidez::button>
                            <span v-if="mutated" class="ml-3 text-green-500">
                                @lang('You submitted your review for moderation.')
                            </span>
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
