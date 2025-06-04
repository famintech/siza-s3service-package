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

You can use the `SiZAS3Service` facade to upload files to your S3-compatible API endpoint.

```php
use SiZAS3Service;

// Basic usage (required parameters)
$response = SiZAS3Service::upload([
    'file' => $request->file('file'), // Required: UploadedFile instance
    'tag' => 'qr',                    // Required: Tag for the file
    // Optional parameters (uncomment as needed):
    // 'directory' => 'e-ejen',        // Optional: S3 directory/folder
    // 'filename' => 'custom_name',    // Optional: Custom filename (extension will be set by API)
    // 'is_temporary' => 1,            // Optional: 1 for temporary, 0 for permanent
    // 'description' => 'QR E-Ejen',   // Optional: File description
    // 'emp_id' => 'KKS020',           // Required if tag is 'qr'
]);

// Handling the response
if (!empty($response['success']) && $response['success']) {
    // Success: Access file URL and other data
    $url = $response['data']['url'];
    // ... your logic here
} else {
    // Error: Check message or errors
    $errorMsg = $response['message'] ?? 'Upload failed';
    // ... your error handling here
}
```

### Parameter Reference

| Parameter     | Required | Type    | Description                                              |
|---------------|----------|---------|----------------------------------------------------------|
| file          | Yes      | file    | The file to upload (`UploadedFile` from Laravel request) |
| tag           | Yes      | string  | Tag for the file (e.g. 'qr')                            |
| directory     | No       | string  | S3 directory/folder                                      |
| filename      | No       | string  | Custom filename (extension will be set by API)           |
| is_temporary  | No       | bool/int| 1 for temporary, 0 for permanent                         |
| description   | No       | string  | File description                                         |
| emp_id        | No*      | string  | Required if tag is 'qr'                                  |

> **Note:** If `tag` is `'qr'`, you must provide `emp_id`.

The `upload` method returns the JSON-decoded response from the API. You can use this facade anywhere in your Laravel application for a consistent and simple file upload experience.

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