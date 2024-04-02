<?php

namespace Arthmelikyan\Laramidjourney\Config;

use Arthmelikyan\Laramidjourney\Exceptions\MissingApiTokenException;

readonly class MidjourneyConfig
{
    const MAX_TIMEOUT = 10;

    const API_URI = 'https://api.mymidjourney.ai/api/v1/midjourney';

    public function getEndpointUri(string $segment): string
    {
        return self::API_URI . str($segment)->start('/')->finish('/');
    }

    /**
     * @throws MissingApiTokenException
     */
    public function getAuthToken(): string
    {
        if (!filled(config('laramidjourney.midjourney_api_token'))) {
            throw new MissingApiTokenException(
                'Please Publish config file using and setup MIDJOURNEY_API_TOKEN inside your .env file.',
                403
            );
        }

        return config('laramidjourney.midjourney_api_token');
    }
}