<?php

namespace Arthmelikyan\Laramidjourney\Tests\Feature;

use Arthmelikyan\Laramidjourney\DTO\GenerateImageDTO;
use Arthmelikyan\Laramidjourney\DTO\ImageResourceDTO;
use Arthmelikyan\Laramidjourney\Exceptions\GenerateImageException;
use Arthmelikyan\Laramidjourney\Exceptions\MissingImageException;
use Arthmelikyan\Laramidjourney\LaraMidjourney;
use Arthmelikyan\Laramidjourney\Tests\TestCase;

class MidjourneyPackageTest extends TestCase
{
    /**
     * @throws GenerateImageException
     */
    public function test_that_text_to_image_generation_works()
    {
        $midjourney = new LaraMidjourney();

        $response = $midjourney->generateImage('A little parrot eating carrots');

        $this->assertInstanceOf(GenerateImageDTO::class, $response);
    }

    /**
     * @throws MissingImageException
     */
    public function test_that_it_returns_processed_image()
    {
        $midjourney = new LaraMidjourney();
        $response = $midjourney->findGeneratedImage('15df905d-11fc-46d5-8bc2-9d652506d1eb');

        $this->assertInstanceOf(ImageResourceDTO::class, $response);
        $this->assertStringStartsWith('https://', $response->uri);
        $this->assertEquals('DONE', $response->status);
    }

    /**
     * @throws GenerateImageException
     */
    public function test_that_image_to_image_generation_works()
    {
        $midjourney = new LaraMidjourney();

        $response = $midjourney->generateImage(
            prompt: 'imagine these cats are software developers',
            externalImageUrl: 'https://i.imgur.com/jlFgGpe.jpeg',
        );

        $this->assertTrue($response->success);
        $this->assertInstanceOf(GenerateImageDTO::class, $response);
    }
}
