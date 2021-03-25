<div id="review-form" class="flex mt-4 mb-4 w-full">
    <graphql v-cloak query='@include('review::queries.ratingsMetadata')'>
        <div v-if="data" slot-scope="{ data }">
            <graphql-mutation v-cloak query="mutation { createProductReview ( input: changes ), { review { nickname summary text average_rating ratings_breakdown { name value } } } }">
                <form slot-scope="{ changes, mutate, mutated }" v-on:submit.prevent="mutate">
                    <div class="w-full max-w-xl bg-white rounded-lg pt-2">
                        <span class="font-bold text-1xl">@lang('Add Your Review')</span>
                        <div class="flex flex-wrap w-full">
                            <div class="w-full md:max-w-xl">
                                <span class="font-semibold text-gray-700 text-sm">@lang('Rating')</span>
                                <div class="flex items-center mb-2">
                                    <star-input v-model="changes.ratings" name="ratings" :rating-id="data.productReviewRatingsMetadata.items[0].id" :rating-values="data.productReviewRatingsMetadata.items[0].values"></star-input>
                                </div>
                                <x-rapidez::input v-bind:value="changes.sku = '{{ $sku }}'" v-on:input="changes.sku = $event" name="sku" class="bg-gray-100 rounded border-none w-full bg-gray-200 focus:bg-white mb-2 hidden"/>
                                <x-rapidez::input v-model="changes.nickname" name="nickname" class="bg-gray-100 rounded border-none w-full bg-gray-200 focus:bg-white mb-2"/>
                                <x-rapidez::input v-model="changes.summary" name="summary" class="bg-gray-100 rounded border-none w-full bg-gray-200 focus:bg-white mb-2"/>
                                <label for="review">@lang('Review')</label>
                                <textarea v-model="changes.text" class="bg-gray-100 rounded border-none w-full h-20 py-2 px-3 bg-gray-200 focus:bg-white" name="review" required></textarea>
                            </div>
                            <div class="w-full md:w-full flex items-start mt-2">
                                <button type="submit" class="btn btn-primary" :disabled="mutated">
                                    @lang('Submit Review')
                                </button>
                                <span v-if="mutated" class="text-green-500">
                                    @lang('You submitted your review for moderation.')
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </graphql-mutation>
        </div>
    </graphql>
</div>
