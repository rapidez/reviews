<lazy>
    <load-more-reviews v-slot="{ reviews, reviewPage, addReviews, nextPage }">
        <div>
            <graphql
                query='@include('rapidez-reviews::queries.reviews', compact('sku'))'
                :variables="{ page: reviewPage, pageSize: 3 }"
                :callback="addReviews"
                v-cloak
                v-slot="{ data }"
            >
                @{{ reviews }}
                <div v-if="reviews !== null" class="mt-5 flex flex-col lg:mt-0" data-testid="reviews">
                    <template v-if="reviews.length">
                        <template v-for="review in reviews">
                            @include('rapidez-reviews::components.item')
                        </template>

                        @include('rapidez-reviews::components.load-more-button')
                    </template>

                    <template v-else>
                        @include('rapidez-reviews::components.no-reviews')
                    </template>
                </div>
            </graphql>

            <div v-if="reviews === null">
                <x-heroicon-o-arrow-path class="text-secondary size-6 animate-spin" />
            </div>
        </div>
    </load-more-reviews>
</lazy>
