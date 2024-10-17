# PHP/Laravel Test

## Introduction

It provides a single `GET /locations` endpoint, a simple factory, model and seeder.

## Setup

First, we need to copy over our `.env.example` to `.env`:

```bash
cp .env.example .env
```

Then pull in our composer dependencies:

```bash
composer install
```

And finally, build our DB and seed it with some data:

```bash
touch database/database.sqlite
php artisan migrate --seed
```

## Tests

```bash
php artisan test
```


### Explanation of Changes Made:

1. The `FetchLocations` command class was modified to bulk insert the locations into the database which is more efficient than inserting one by one. Additionally, the `created_at` and `updated_at` fields are manually set since bulk insert doesn't update the timestamp fields. 
2. A new `DataSourceInterface` was created to allow for future implementations to conform to the same structure. This interface must be implemented by any classes used to fetch locations from external sources. eg json files, api endpoints, etc.
3. A new `FuellingProviderInterface` was created to allow for future implementations to conform to the same structure. 
4. The `BpJsonFileDataSource` and `ShellJsonFileDataSource` classes were created to fetch locations from their respective sources. Additionally, an unused `ShellHttpDataSource` class was created to fetch locations from the Shell API. 
5. An abstract class `BaseFuellingProvider` was created to provide a common interface for the different types of fuelling providers. The `getLocations` method was also added to this class to handle fetching locations from the data source and returning them in the required format.
6. The `AppServiceProvider` was modified to handle the dependency injection of the interfaces to their respective concrete classes. I also ensured to use `singleton` in the `register` method to ensure that the same instance is used throughout the application.

### Steps To Add a New Data Source To An existing Fuelling Provider:

1. Implement the `DataSourceInterface` interface in a new Data Source class.
3. Add the new data source to the `FetchLocations` command class.

### Steps to Add a New Fuelling Provider:

1. Implement the `DataSourceInterface` interface in a new Data Source class.
2. Implement the `FuellingProviderInterface` interface in a new Fuelling Provider class.
3. Add the new data source to `app/Providers/AppServiceProvider.php`



