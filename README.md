# PPZ S3Service Laravel Package

A Laravel package that provides a simple facade for uploading files to a custom S3-compatible endpoint via an API. This package is designed to be easily integrated into Laravel applications, supporting Laravel 8.x through 12.x.

## Features
- Facade-based API for file uploads
- Configurable endpoint and API key
- Simple integration with Laravel's service provider and config system

## Installation

Require the package via Composer:

```bash
composer require ppz/s3service
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag=s3service-config
```

This will create a `config/s3service.php` file with the following options:

```php
return [
    'endpoint' => env('PPZ_S3_UPLOAD_ENDPOINT', 'https://dev-upload.siza.my/api/upload'),
    'api_key' => env('PPZ_API_KEY'),
];
```

- `endpoint`: The API endpoint for file uploads (default: `https://dev-upload.siza.my/api/upload`).
- `api_key`: Your API key for authenticating requests..

Set the corresponding environment variables in your `.env` file:

```
PPZ_S3_UPLOAD_ENDPOINT=https://your-upload-endpoint
PPZ_API_KEY=your-api-key
```

## Usage

You can use the facade `PPZS3Service` to upload files. Example:

```php
use PPZ\S3Service\PPZS3ServiceFacade as PPZS3Service;

$response = PPZS3Service::upload([
    'file' => $request->file('your_file_input'),
    // ... other parameters as required by your API
]);
```

- The `upload` method expects an array with at least a `file` key containing an instance of `UploadedFile` (from a Laravel request).
- Additional parameters can be included in the array and will be sent along with the file.
- The method returns the JSON-decoded response from the API.

## Service Provider & Facade

- **Service Provider:** `PPZ\S3Service\PPZS3ServiceProvider` is auto-discovered by Laravel.
- **Facade:** `PPZ\S3Service\PPZS3ServiceFacade` provides the `PPZS3Service` alias for easy static access.

## Advanced

If you need to access the service directly (not via the facade):

```php
$service = app('ppzs3service');
$response = $service::upload([...]);
```

## License

MIT 