<graphql v-cloak query='@include('rapidez-reviews::queries.reviews', ['sku' => $product->sku])'>
    <div slot-scope="{ data }" v-if="data">
        <strong class="block text-2xl mt-5">@lang('Customer Reviews')</strong>
        <div v-for="review in data.products.items[0].reviews.items" class="w-full bg-gray-200 rounded p-3 mt-3">
            <p class="flex items-baseline">
                <strong>@{{ review.nickname }}</strong>
                <span class="ml-2 text-xs">@{{ new Date(review.created_at).toLocaleDateString() }}</span>
            </p>
            <stars class="mt-1" :score="review.average_rating"></stars>
            <strong class="block mt-3">@{{ review.summary }}</strong>
            <p class="mt-1 text-sm">@{{ review.text }}</p>
        </div>
    </div>
</graphql>
