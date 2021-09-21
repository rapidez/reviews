# Rapidez Reviews

## Installation

```
composer require rapidez/reviews
```

And register the Vue components in `resources/js/app.js`:
```
Vue.component('stars', require('Vendor/rapidez/reviews/resources/js/components/Stars.vue').default)
Vue.component('star-input', require('Vendor/rapidez/reviews/resources/js/components/StarInput.vue').default)
```

If you haven't published the Rapidez views yet, publish them with:
```
php artisan vendor:publish --provider="Rapidez\Core\RapidezServiceProvider" --tag=views
```

### Product page

#### Review stars

Add the stars where you'd like in `resources/views/vendor/rapidez/product/overview.blade.php`:
```
@if($product->reviews_score)
    <stars score="{{ $product->reviews_score }}" count="{{ $product->reviews_count }}"></stars>
@endif
```

> Optionally you can change the classes with the `class-star`, `class-star-inactive` and `class-count` props.

#### Review list

The review list can be added with:
```
@include('rapidez-reviews::reviews', ['sku' => $product->sku])
```

#### Review form

And the form to add a review:
```
@include('rapidez-reviews::form', ['sku' => $product->sku])
```

### Product listing

#### Review stars

Add somewhere in `resources/views/category/partials/listing/item.blade.php`:
```
<stars v-if="item.reviews_score" :score="item.reviews_score" :count="item.reviews_count"></stars>
```

## Views

If you need to change the views you can publish them with:
```
php artisan vendor:publish --provider="Rapidez\Reviews\ReviewsServiceProvider" --tag=views
```

## License

GNU General Public License v3. Please see [License File](LICENSE) for more information.
