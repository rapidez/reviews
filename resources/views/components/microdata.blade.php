@if($product->reviews_score)
    <div itemprop="aggregateRating" itemtype="https://schema.org/AggregateRating" itemscope>
        <meta itemprop="reviewCount" content="{{ $product->reviews_count }}" />
        <meta itemprop="ratingValue" content="{{ $product->reviews_score }}" />
        <meta itemprop="bestRating" content="100" />
    </div>
@endif
