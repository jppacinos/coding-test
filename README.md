<a name="readme-top"></a>

<div align="center">
    <h3 align="center">Backend Developer coding test</h3>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-test">About the test</a>
    </li>
    <li>
      <a href="#requirements">Requirements</a>
      <ul>
        <li><a href="#product-specifications">Product specifications</a></li>
        <li><a href="#api-requirements">API Requirements</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li>
      <a href="#bonus-points">Bonus points</a>
    </li>
  </ol>
</details>

<!-- ABOUT THE TEST -->
## About the test

You're tasked to create a simple REST web service application for a fictional e-commerce business using Laravel.

You need to develop the following REST APIs:

* Products list
* Product detail
* Create product
* Update product
* Delete product

<!-- REQUIREMENTS -->
## Requirements

### Product specifications

A product needs to have the following information:

* Product name
* Product description
* Product price
* Created at
* Updated at

### API requirements

* Products list API
    * The products list API must be paginated.
* Create and Update product API
    * The product name, description, and price must be required.
    * The product name must accept a maximum of 255 characters.
    * The product price must be numeric in type and must accept up to two decimal places.
    * The created at and updated at fields must be in timestamp format.

Others:
* You are required to use MYSQL for the database storage in this test.
* You are free to use any library or component just as long as it can be installed using Composer.
* Don't forget to provide instructions on how to set the application up.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- GETTING STARTED -->
## Getting Started

### Prerequisites

* Git
* Composer
* PHP ^8.0.2
* MySQL

### Installation

#### Automatically generate a new repository
Click <a href="https://github.com/QualityTrade/backend-dev-coding-test/generate" target="_blank">here</a> to generate a new repository from this template.

* Select your GitHub username as the owner.
* Name the repository `{FIRST NAME}-{LAST NAME}-coding-test`. (e.g. `john-doe-coding-test`)
* Make sure to set the repository visibility to Public.
* Clone your generated repository.

#### Manual
If automatically generating a new repository does not work, follow these steps instead.

* Click <a href="https://github.com/QualityTrade/backend-dev-coding-test/archive/refs/heads/main.zip">here</a> to download the ZIP archive of the test.
* Create a new repository named `{FIRST NAME}-{LAST NAME}-coding-test`. (e.g. `john-doe-coding-test`)
* Push your code to the new repository.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- BONUS POINTS -->
## Bonus points

#### For bonus points:

* Cache the response of the Product detail API. You are free to use any cache driver.
* Use the Service layer and Repository design patterns.
* Create automated tests for the app.

#### Answer the question below by updating this file.

Q: The management requested a new feature where in the fictional e-commerce app must have a "featured products" section.
How would you go about implementing this feature in the backend?

A: The possible solution is to create a `product_featured` table with columns of `id` (pk), and `product_id` (fk to `products.id`). When a product is featured, we insert a record in the `product_featured.product_id` with specified `products.id` and when it is no longer featured, then we will remove the `product_id` in the `product_featured` table.

In retrieving this featured products in the backend, we can make join queries with this implementation in Laravel.
```php
Product::join('product_featured', 'product_featured.product_id', '=', 'products.id')->all();
```

<!-- APPLICATION SETUP -->
## Local Setup

-   run `composer install` (requires Composer: https://getcomposer.org)
-   configure `.env.example` to `.env` please (also see: .env-backup)
-   run `php artisan key:generate`
-   run migrations `php artisan migrate:fresh --seed`
-   run development server `php artisan serve`
