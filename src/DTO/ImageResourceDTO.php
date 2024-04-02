<?php

namespace Arthmelikyan\Laramidjourney\DTO;

class ImageResourceDTO
{
    public string $prompt;

    public string $status;

    public ?string $uri;

    public int $progress;

    public array $buttons;

    public string $messageId;

    public ?string $createdAt;

    public ?string $updatedAt;

    public function __construct(array $response)
    {
        $this->prompt = $response['prompt'];
        $this->status = $response['status'];
        $this->messageId = $response['messageId'];
        $this->uri = $response['uri'] ?? null;
        $this->progress = $response['progress'] ?? 0;
        $this->buttons = $response['buttons'] ?? [];
        $this->createdAt = $response['createdAt'] ?? null;
        $this->updatedAt = $response['updatedAt'] ?? null;
    }
}