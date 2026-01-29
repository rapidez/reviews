# Rapidez Reviews

![](images/pdp-review-stars.png)
![](images/pdp-with-reviews.png)
![](images/pdp-reviews-form.png)
![](images/pdp-without-reviews.png)
![](images/product-tile-reviews.png)

## Installation

```bash
composer require rapidez/reviews
```

And run the Rapidez indexer:

```bash
php artisan rapidez:index
```

After that the reviews will show up automatically as it's added within the Rapidez core. If you'd like to change that you can publish the Rapidez Core views with:
```bash
php artisan vendor:publish --provider="Rapidez\Core\RapidezServiceProvider" --tag=views
```

## Configuration

If you'd like to show product reviews on out-of-stock product pages you need to enable this setting in Magento:

> Stores > Settings > Configuration > Catalog > Inventory > Stock Options > Display Out of Stock Products


## Views

If you need to change the views you can publish them with:
```bash
php artisan vendor:publish --provider="Rapidez\Reviews\ReviewsServiceProvider" --tag=views
```

## License

GNU General Public License v3. Please see [License File](LICENSE) for more information.
