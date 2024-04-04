<?php

namespace Arthmelikyan\Laramidjourney;

use Arthmelikyan\Laramidjourney\Config\MidjourneyConfig;
use Arthmelikyan\Laramidjourney\DTO\GenerateImageDTO;
use Arthmelikyan\Laramidjourney\DTO\ImageResourceDTO;
use Arthmelikyan\Laramidjourney\Exceptions\GenerateImageException;
use Arthmelikyan\Laramidjourney\Exceptions\MissingApiTokenException;
use Arthmelikyan\Laramidjourney\Exceptions\MissingImageException;
use Arthmelikyan\Laramidjourney\Interfaces\LaraMidjourneyInterface;
use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

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

    /**
     * @throws GenerateImageException
     */
    public function generateImage(string $prompt, string $externalImageUrl = ''): GenerateImageDTO
    {
        try {
            $response = $this->httpClient
                ->post($this->config->getEndpointUri('imagine'), [
                    'prompt' => "$externalImageUrl $prompt",
                ])
                ->json();
        } catch (Exception $ex) {
            throw new GenerateImageException(
                message: 'Could not generate image: '.$ex->getMessage(),
                code: HttpResponse::HTTP_BAD_REQUEST
            );
        }

        return new GenerateImageDTO($response);
    }

    /**
     * @throws MissingImageException
     */
    public function findGeneratedImage(string $messageId): ImageResourceDTO
    {
        try {
            $response = $this->httpClient
                ->get($this->config->getEndpointUri('message').$messageId)
                ->json();
        } catch (Exception $ex) {
            throw new MissingImageException(
                message: 'Image not found error: '.$ex->getMessage(),
                code: HttpResponse::HTTP_NOT_FOUND
            );
        }

        return new ImageResourceDTO($response);
    }
}
