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

## Usage

You can use the `PPZS3Service` facade to upload one or more files to your S3-compatible API endpoint.

```php
use PPZS3Service;

// Single file upload
$response = PPZS3Service::upload([
    'file' => $request->file('file'), // Required: uploaded file instance
    'directory' => 'e-ejen',          // Required: S3 directory/folder
    'tag' => 'qr',                    // Required: Tag for the file
    'emp_id' => 'KKS020',             // Required: Employee ID
    // Optional parameters:
    // 'filename' => 'custom_name',    // Optional: Custom filename 
    // 'is_temporary' => 1,            // Optional: 1 for temporary, 0 for permanent
    // 'description' => 'QR E-Ejen',   // Optional: File description
]);

// Multiple file upload
$response = PPZS3Service::upload([
    'file' => $request->file('file'), // Required: array of uploaded file instance
    'directory' => 'e-ejen',         // Required
    'tag' => 'qr',                   // Required
    'emp_id' => 'KKS020',            // Required
    // ...other optional params
]);

// Handling the response
if (!empty($response['success']) && $response['success']) {
    // For single file: $response['data']
    // For multiple files: $response['results'] (array of results)
} else {
    $errorMsg = $response['message'] ?? 'Upload failed';
}
```

### Parameter Reference

| Parameter     | Required | Type           | Description                                              |
|---------------|----------|----------------|----------------------------------------------------------|
| file          | Yes      | file/array     | The file(s) to upload  |
| directory     | Yes      | string         | S3 directory/folder                                      |
| tag           | Yes      | string         | Tag for the file (e.g. 'qr')                             |
| emp_id        | Yes      | string         | Employee ID (required for all uploads)                   |
| filename      | No       | string         | Custom filename (extension will be set by API)           |
| is_temporary  | No       | bool/int       | 1 for temporary, 0 for permanent                         |
| description   | No       | string         | File description                                         |

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag=s3service-config
```

This will create a `config/s3service.php` file with the following options:

Set the corresponding environment variables in your `.env` file:

```
PPZ_S3_UPLOAD_ENDPOINT=https://your-upload-endpoint
PPZ_API_KEY=your-api-key
```