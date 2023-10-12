@if($reviews_score)
    <lazy>
        <graphql v-cloak query='@include('rapidez-reviews::queries.reviews', @compact('sku'))'>
            <div slot-scope="{ data }" v-if="data?.products?.items[0]?.reviews" class="flex flex-col gap-4">
                <div class="hidden" itemprop="aggregateRating" itemtype="https://schema.org/AggregateRating" itemscope>
                    <meta itemprop="reviewCount" content="{{ $reviews_count }}" />
                    <meta itemprop="ratingValue" content="{{ $reviews_score }}" />
                    <meta itemprop="bestRating" content="100" />
                </div>
                <div v-for="review in data.products.items[0].reviews.items" class="w-full p-8 border rounded bg-white" itemprop="review" itemtype="https://schema.org/Review" itemscope>
                    <div class="flex items-center gap-2 text-inactive" itemprop="author" itemtype="https://schema.org/Person" itemscope>
                        <strong itemprop="name">@{{ review.nickname }}</strong>
                        <span class="text-xs">@{{ new Date(review.created_at).toLocaleDateString() }}</span>
                    </div>
                    <div itemprop="reviewRating" itemtype="https://schema.org/Rating" itemscope>
                        <meta itemprop="ratingValue" v-bind:content="review.average_rating" />
                        <meta itemprop="bestRating" content="100" />
                        <stars class="mt-1" v-bind:score="review.average_rating"></stars>
                    </div>
                    <strong class="block mt-3" itemprop="name">@{{ review.summary }}</strong>
                    <p class="mt-1 text-sm" itemprop="reviewBody">@{{ review.text }}</p>
                </div>
            </div>
        </graphql>
    </lazy>
@else
    <div class="w-full p-8 mb-4 border rounded bg-white">
        <div class="flex items-center gap-2 text-inactive">
            <strong itemprop="name">@lang('No reviews found')</strong>
            <span class="text-xs">
                @{{ new Date(Date.now()).toLocaleDateString() }}
            </span>
        </div>
        <stars class="mt-1" :score="100"></stars>
        <strong class="block mt-3">
            @lang('Be the first to write a review')
        </strong>
        <p class="mt-1 text-sm">
            {{ $product->name }}
        </p>
    </div>
@endif
