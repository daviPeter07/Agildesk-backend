<?php

declare(strict_types=1);

class CreateChatMessageDto
{
    public function __construct(
        public readonly int $ticketId,
        public readonly int $userId,
        public readonly string $message,
        public readonly bool $isInternal = false,
    ) {}
}
