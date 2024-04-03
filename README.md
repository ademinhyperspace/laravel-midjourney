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

$midjourney->findGeneratedImage('29e09f05-6aa0-4749-8946-315d4fe8b8d3'); // returns ImageResourceDTO object
$midjourney->imageToImage('https://i.imgur.com/jlFgGpe.jpeg', 'imagine these cats are js developers'); // returns GenerateImageDTO object
```