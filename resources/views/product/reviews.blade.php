<div id="reviews" class="w-full">
    <graphql v-cloak query='@include('review::queries.reviews', ['sku' => $product->sku])'>
        <div slot-scope="{ data }" v-if="data">
            <h2 class="font-bold text-2xl mt-8">@lang('Customer Reviews')</h2>
            <div v-for="review in data.products.items[0].reviews.items" class="flex items-start w-full md:max-w-xl bg-gray-200 rounded p-3 mt-3">
                <div>
                    <p class="flex items-baseline">
                      <span class="font-bold">@{{ review.nickname }}</span>
                      <span class="ml-2 text-primary text-xs">@{{ new Date(review.created_at).toLocaleDateString() }}</span>
                    </p>
                    <div class="flex items-center mt-1">
                          <svg v-for="star in review.average_rating / 100 * 5" class="w-4 h-4 fill-current text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                          <svg v-for="star in 5 - review.average_rating / 100 * 5" class="w-4 h-4 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                    </div>
                    <div class="mt-3">
                        <span class="font-bold">@{{ review.summary }}</span>
                        <p class="mt-1">@{{ review.text }}</p>
                    </div>
                </div>
            </div>
        </div>
    </graphql>
</div>
