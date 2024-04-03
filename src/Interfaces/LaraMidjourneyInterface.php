<?php

namespace Arthmelikyan\Laramidjourney\Interfaces;

use Arthmelikyan\Laramidjourney\DTO\GenerateImageDTO;
use Arthmelikyan\Laramidjourney\DTO\ImageResourceDTO;

interface LaraMidjourneyInterface
{
    public function generateImage(string $prompt): GenerateImageDTO;

    public function findGeneratedImage(string $messageId): ImageResourceDTO;

    public function imageToImage(string $imageFullUrl, string $prompt): GenerateImageDTO;
}