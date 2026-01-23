@if($product->reviewSummary?->rating_summary)
    <div itemprop="aggregateRating" itemtype="https://schema.org/AggregateRating" itemscope>
        <meta itemprop="reviewCount" content="{{ $product->reviewSummary->reviews_count }}" />
        <meta itemprop="ratingValue" content="{{ $product->reviewSummary->rating_summary }}" />
        <meta itemprop="bestRating" content="100" />
    </div>
@endif
