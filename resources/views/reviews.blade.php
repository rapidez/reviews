<graphql v-cloak query='@include('rapidez-reviews::queries.reviews', ['sku' => $product->sku])'>
    <div slot-scope="{ data }" v-if="data">
        <strong class="block text-2xl mt-5">@lang('Customer Reviews')</strong>
        <div itemprop="aggregateRating" itemtype="https://schema.org/AggregateRating" itemscope>
            <meta itemprop="reviewCount" :content="data.products.items[0].reviews.items.length" />
            <meta itemprop="ratingValue" :content="data.products.items[0].rating_summary" />
            <meta itemprop="bestRating" content="100" />
        </div>
        <div v-for="review in data.products.items[0].reviews.items" class="w-full bg-gray-200 rounded p-3 mt-3" itemprop="review" itemtype="https://schema.org/Review" itemscope>
            <p class="flex items-baseline" itemprop="author" itemtype="https://schema.org/Person" itemscope>
                <strong itemprop="name">@{{ review.nickname }}</strong>
                <span class="ml-2 text-xs">@{{ new Date(review.created_at).toLocaleDateString() }}</span>
            </p>
            <div itemprop="reviewRating" itemtype="https://schema.org/Rating" itemscope>
                <meta itemprop="ratingValue" :content="review.average_rating" />
                <meta itemprop="bestRating" content="100" />
                <stars class="mt-1" :score="review.average_rating"></stars>
            </div>
            <strong class="block mt-3" itemprop="name">@{{ review.summary }}</strong>
            <p class="mt-1 text-sm" itemprop="reviewBody">@{{ review.text }}</p>
        </div>
    </div>
</graphql>
