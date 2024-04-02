<?php

namespace Arthmelikyan\Laramidjourney\DTO;

class GenerateImageDTO
{
    public bool $success;

    public string $messageId;

    public string $createdAt;

    public function __construct(array $response)
    {
        $this->success = $response['success'];
        $this->messageId = $response['messageId'];
        $this->createdAt = $response['createdAt'];
    }
}