<?php

declare(strict_types=1);

namespace App\Response\Builder;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder as Builder;

class SerializerBuilder
{
    private Serializer $serializer;

    public function __construct()
    {
        $this->serializer = Builder::create()->build();
    }

    public function getSerializer(): Serializer
    {
        return $this->serializer;
    }

    public function setSerializer(Serializer $serializer): void
    {
        $this->serializer = $serializer;
    }

    public function serialize($data, string $format, ?SerializationContext $context = null, ?string $type = null): string
    {
        return $this->serializer->serialize($data, $format, $context, $type);
    }

    public function build($data, ?SerializationContext $context = null): string
    {
        return $this->serialize($data, 'json', $context);
    }

    public function buildWithGroups($data, array $groups): string
    {
        return $this->build($data, SerializationContext::create()->setGroups($groups));
    }

    public function buildWithGroup($data, string $group): string
    {
        return $this->buildWithGroups($data, [$group]);
    }
}
