<graphql-mutation
    query='@include('rapidez-reviews::queries.reviews', compact('sku'))'
    v-slot="{ mutate }"
    :variables="{ page: reviewPage + 1, pageSize: 3 }"
    :callback="addReviews"
>
    <x-rapidez::button.outline
        v-if="reviews.length > 0 && reviews.length < {{ $reviews_count ?? 0 }}"
        v-on:click="nextPage(); mutate()"
        class="self-center"
    >
        @lang('Load more reviews')
    </x-rapidez::button.outline>
</graphql-mutation>