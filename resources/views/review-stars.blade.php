<div class="flex items-start">
    <div class="flex items-center">
        <graphql v-cloak query='@include('review::queries.reviews', ['sku' => $product->sku])'>
            <div class="flex items-center" slot-scope="{ data }" v-if="data">
                <product-reviews v-cloak :product="data.products.items[0]">
                    <div class="flex items-center" slot-scope="{ rating }">
                        <svg v-for="star in rating.stars" class="w-4 h-4 fill-current text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        <svg v-for="star in 5 - rating.stars" class="w-4 h-4 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                    </div>
                </product-reviews>
                <span class="ml-2 hover:underline"><a href="#reviews">@{{ data.products.items[0].reviews.items.length }} @lang('Reviews')</a></span>
            </div>
        </graphql>
    </div>
</div>
