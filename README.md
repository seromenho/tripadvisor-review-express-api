# TripAdvisor Review Express API  

Simple PHP Wrapper for the TripAdvisor Review Express API

## Installation
You can intall it to your project easily through composer:  

    $ composer require seromenho/tripadvisor-review-express-api

## Usage

```php
<?php
require "./vendor/autoload.php";

use ReviewExpressApi\ReviewExpressApi;

$review = new ReviewExpressApi("some_key");

$body = array(
    array(
        "recipient"   => "john@example.com",
        "location_id" => "h89575",
        "checkout"    => "2014-12-31",
        "country"     => "US"
    ),
    array(
        "partner_request_id" => "745C6BFF-F0C7-401F-A691-4407F78DC96C",
        "location_id" => "h89575",
        "recipient" => "mme.toutlemonde@example.fr",
        "checkin" => "2014-11-07",
        "checkout"=> "2014-11-12",
        "language"=> "fr",
        "country" => "FR"
    )
);

try {
    $response = $review->create($body);
} catch (RequestException $e) {
    echo $e->getRequest();
    if ($e->hasResponse()) {
        echo $e->getResponse();
    }
}
```
