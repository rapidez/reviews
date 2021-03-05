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
Add `@include('review::review-stars', ['sku' => $product->sku])` where you'd like to display the review stars, most likely somewhere below the product title: `resources/views/vendor/rapidez/product/overview.blade.php`.

#### Review list
Add `@include('review::reviews', ['sku' => $product->sku])` where you'd like to display the review list, most likely somewhere on the product overview: `resources/views/vendor/rapidez/product/overview.blade.php`.

#### Review form
Add `@include('review::review-form', ['sku' => $product->sku])` where you'd like to display the review form, most likely somewhere below the review list: `resources/views/vendor/rapidez/product/overview.blade.php`.

## Views
If you need to change the views you can publish them with:
```
php artisan vendor:publish --provider="Rapidez\Review\ReviewServiceProvider" --tag=views
```
