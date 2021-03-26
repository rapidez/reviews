# Rapidez Review
## Installation
```
composer require rapidez/review
```

After installation add `require('Vendor/rapidez/review/resources/js/app.js');` to `resources/js/app.js`.

If you haven't published the Rapidez views yet, publish them with:
```
php artisan vendor:publish --provider="Rapidez\Core\RapidezServiceProvider" --tag=views
```

### Product page
#### Review stars
Add `<product-rating :rating_summary="{{ $product->rating_summary }}" :reviews_count="{{ $product->reviews_count }}" />` where you'd like to display the product rating in stars, most likely somewhere below the product name: `resources/views/vendor/rapidez/product/overview.blade.php`.
> Optionally you can use the prop `star_size` to change the size of the stars (default: 20), `star_class` to add a class to the active stars (default: 'text-primary') and `star_class_inactive` for the inactive stars (default: 'text-gray-400').

#### Review list
Add `@include('review::reviews', ['sku' => $product->sku])` where you'd like to display the review list, most likely somewhere on the product overview: `resources/views/vendor/rapidez/product/overview.blade.php`.

#### Review form
Add `@include('review::review-form', ['sku' => $product->sku])` where you'd like to display the review form, most likely somewhere below the review list: `resources/views/vendor/rapidez/product/overview.blade.php`.

### Product items
#### Review stars
Add `<product-rating :rating_summary="item.rating_summary" :reviews_count="item.reviews_count" />` in the product item template to display the product rating in stars, most likely somewhere below the product name: `resources/views/category/partials/listing/item.blade.php`.
> Optionally you can use the prop `star_size` to change the size of the stars (default: 20), `star_class` to add a class to the active stars (default: 'text-primary') and `star_class_inactive` for the inactive stars (default: 'text-gray-400').

## Views
If you need to change the views you can publish them with:
```
php artisan vendor:publish --provider="Rapidez\Review\ReviewServiceProvider" --tag=views
```
