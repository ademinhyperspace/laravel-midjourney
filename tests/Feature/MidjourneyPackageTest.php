<?php

namespace Arthmelikyan\Laramidjourney\Tests\Feature;

use Arthmelikyan\Laramidjourney\DTO\GenerateImageDTO;
use Arthmelikyan\Laramidjourney\DTO\ImageResourceDTO;
use Arthmelikyan\Laramidjourney\Exceptions\MissingImageException;
use Arthmelikyan\Laramidjourney\LaraMidjourney;
use Arthmelikyan\Laramidjourney\Tests\TestCase;
use Exception;

class MidjourneyPackageTest extends TestCase
{
    public function test_that_text_to_image_generation_works()
    {
        $midjourney = new LaraMidjourney();

        $response = $midjourney->generateImage('A little parrot eating carrots');

        $this->assertInstanceOf(GenerateImageDTO::class, $response);
    }

    /**
     * @throws Exception
     */
    public function test_that_it_returns_processed_image()
    {
        $midjourney = new LaraMidjourney();
        $response = $midjourney->findGeneratedImage('c181da5a-4833-43f3-b6dc-f7d826ad493d');

        $this->assertInstanceOf(ImageResourceDTO::class, $response);
        $this->assertStringStartsWith('https://', $response->uri);
        $this->assertEquals('DONE', $response->status);
    }

    public function test_that_image_to_image_generation_works()
    {
        $midjourney = new LaraMidjourney();

        $response = $midjourney->imageToImage(
            imageFullUrl: 'https://i.imgur.com/jlFgGpe.jpeg',
            prompt: 'imagine these cats are software developers'
        );

        $this->assertTrue($response->success);
        $this->assertInstanceOf(GenerateImageDTO::class, $response);
    }
}