<?php

namespace Arthmelikyan\Laramidjourney\Interfaces;

use Arthmelikyan\Laramidjourney\DTO\GenerateImageDTO;
use Arthmelikyan\Laramidjourney\DTO\ImageResourceDTO;

interface LaraMidjourneyInterface
{
    public function generateImage(string $prompt, string $externalImageUrl = ''): GenerateImageDTO;

    public function findGeneratedImage(string $messageId): ImageResourceDTO;
}
