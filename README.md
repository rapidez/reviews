# Rapidez Reviews

## Installation

```bash
composer require rapidez/reviews
```

If you haven't published the Rapidez views yet, publish them with:
```bash
php artisan vendor:publish --provider="Rapidez\Core\RapidezServiceProvider" --tag=views
```

### Configuration

If you'd like to show product reviews on out-of-stock product pages you need to enable this setting in Magento:

> Stores > Settings > Configuration > Catalog > Inventory > Stock Options > Display Out of Stock Products

### Product page

#### Review stars

Add the stars where you'd like in `resources/views/vendor/rapidez/product/overview.blade.php`:
```blade
@if($product->reviews_score)
    <x-rapidez-reviews::stars :score="$product->reviews_score" :count="$product->reviews_count" />
@endif
```

#### Review list

The review list can be added with:
```blade
@include('rapidez-reviews::reviews', [
    'sku' => $product->sku,
    'reviews_count' => $product->reviews_count,
    'reviews_score' => $product->reviews_score,
])
```

#### Review form

And the form to add a review:
```blade
@include('rapidez-reviews::form', ['sku' => $product->sku])
```

### Product listing

#### Review stars

Add somewhere in `resources/views/category/partials/listing/item.blade.php`:
```blade
<x-rapidez-reviews::stars v-if="item.reviews_count" count="item.reviews_count" score="item.reviews_score"/>

```

## Views

If you need to change the views you can publish them with:
```bash
php artisan vendor:publish --provider="Rapidez\Reviews\ReviewsServiceProvider" --tag=views
```

## License

GNU General Public License v3. Please see [License File](LICENSE) for more information.
