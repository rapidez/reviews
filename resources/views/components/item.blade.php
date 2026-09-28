<div
    class="w-full py-7 lg:px-8 lg:mb-5 border-t first:border-0 rounded-sm lg:first:border lg:border"
    itemprop="review"
    itemtype="https://schema.org/Review"
    itemscope
    data-testid="review-item"
>
    <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/Product" class="hidden">
        <meta itemprop="name" content="{{ $product->name }}" />
        <meta itemprop="sku" content="{{ $product->sku }}" />
        <meta itemprop="url" content="{{ url($product->url) }}" />
    </div>
    <meta itemprop="datePublished" :content="review.created_at?.substring(0, 10)" />
    <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
        <meta itemprop="ratingValue" :content="review.average_rating" />
        <meta itemprop="bestRating" content="100" />
        <meta itemprop="worstRating" content="0" />
        <div class="lg:flex lg:items-center">
            <span class="inline-block align-text-bottom">
                <x-rapidez-reviews::stars score="review.average_rating" />
            </span>
        </div>
    </div>
    <strong class="block mt-2.5 font-bold text" itemprop="name">
        @{{ review.summary }}
    </strong>
    <p class="mt-2.5 text" itemprop="reviewBody">
        @{{ review.text }}
    </p>
    <p
        class="flex items-center mt-5 text-sm text"
        itemprop="author"
        itemtype="https://schema.org/Person"
        itemscope
    >
        <span itemprop="name">@{{ review.nickname }}</span>
        <span class="bg-emphasis mx-2.5 h-1 w-1 rounded-full"></span>
        <span class="w-25" data-testid="masked">@{{ new Date(review.created_at).toLocaleDateString() }}</span>
    </p>
</div>
