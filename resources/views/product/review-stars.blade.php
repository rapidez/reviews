<div class="flex items-start">
    <div class="flex items-center">
        <graphql v-cloak query='@include('review::queries.reviews', ['sku' => $sku])'>
            <div class="flex items-center" slot-scope="{ data }" v-if="data">
                <product-rating :rating_summary="data.products.items[0].rating_summary" :list="true" />
            </div>
        </graphql>
    </div>
</div>
