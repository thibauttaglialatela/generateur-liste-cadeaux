<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\AI\Agent\AgentInterface;
use Symfony\AI\Platform\Message\Message;
use Symfony\AI\Platform\Message\MessageBag;

final readonly class ApiMistralAi
{
    public function __construct(
        private AgentInterface $agent,
    )
    {
    }

    public function submit(string $message): string
    {

        $messages = new MessageBag(
            Message::forSystem('incarne un conseiller travaillant dans un magasin'),
            Message::ofUser($message)
        );

        return $this->agent->call($messages)->getContent();
    }
}
