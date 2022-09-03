<?php

declare(strict_types=1);

namespace App\Response\Body;

use JMS\Serializer\Annotation as Serializer;

class ExceptionBody
{
    const UPPER_ENV = ['prod'];

    #[Serializer\Type('integer')]
    private int $code;

    #[Serializer\Type('string')]
    private string $message;

    #[Serializer\Type('array')]
    private array $trace;

    #[Serializer\Exclude]
    private bool $isTraceEnabled;

    public function __construct(string $environment, bool $debug)
    {
        $this->isTraceEnabled = !$this->isUpperEnv($environment) || $debug;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }


    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getTrace(): array
    {
        return $this->trace;
    }

    public function setTrace(array $trace): void
    {
        if (!$this->isTraceEnabled) {
            return;
        }

        $this->trace = $trace;
    }

    private function isUpperEnv($environment): bool
    {
        return in_array($environment, self::UPPER_ENV);
    }
}