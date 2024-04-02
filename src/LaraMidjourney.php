<?php

namespace Arthmelikyan\Laramidjourney;

use Arthmelikyan\Laramidjourney\Config\MidjourneyConfig;
use Arthmelikyan\Laramidjourney\DTO\GenerateImageDTO;
use Arthmelikyan\Laramidjourney\DTO\ImageResourceDTO;
use Arthmelikyan\Laramidjourney\Exceptions\MissingApiTokenException;
use Arthmelikyan\Laramidjourney\Interfaces\LaraMidjourneyInterface;
use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class LaraMidjourney implements LaraMidjourneyInterface
{
    private MidjourneyConfig $config;

    private PendingRequest $httpClient;

    /**
     * @throws MissingApiTokenException
     */
    public function __construct()
    {
        $this->config = new MidjourneyConfig();
        $this->httpClient = Http::withToken($this->config->getAuthToken())->throw();
    }

    public function generateImage(string $prompt): GenerateImageDTO
    {
        $response = $this->httpClient
            ->post($this->config->getEndpointUri('imagine'), [
                "prompt" => $prompt
            ])
            ->json();

        return new GenerateImageDTO($response);
    }

    /**
     * @throws Exception
     */
    public function findGeneratedImage(string $messageId): ImageResourceDTO
    {
        $response = $this->httpClient
            ->get($this->config->getEndpointUri('message') . $messageId)
            ->json();

        return new ImageResourceDTO($response);
    }

    public function imageToImage(string $imageFullUrl, string $prompt): GenerateImageDTO
    {
        $response = $this->httpClient
            ->post($this->config->getEndpointUri('imagine'), [
                "prompt" => "$imageFullUrl $prompt"
            ])
            ->json();

        return new GenerateImageDTO($response);
    }
}