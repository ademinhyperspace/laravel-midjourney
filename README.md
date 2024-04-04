Please first publish the config file using this command

```
php artisan vendor:publish --tag=laramidjourney-config
```

Then add your bearer token in .env file 

```
MIDJOURNEY_API_TOKEN="your token"
```

# Usage
You can either use `LaraMidjourney` facade from `Arthmelikyan\Laramidjourney\Facades` or create the instance of `Arthmelikyan\Laramidjourney\Laramidjourney` class

```php
$midjourney = new LaraMidjourney();
$midjourney->generateImage('draw a cat') // returns GenerateImageDTO object

$midjourney->findGeneratedImage('15df905d-11fc-46d5-8bc2-9d652506d1eb'); // returns ImageResourceDTO object

```

to use image to image functionality just call generateImage like this

```php
$midjourney->generateImage('imagine these cats are js developers', 'https://i.imgur.com/jlFgGpe.jpeg'); // returns GenerateImageDTO object
```