<?php

declare(strict_types=1);

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder as Builder;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractApiController extends AbstractFOSRestController
{
    protected function respondError(mixed $errors, int $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY): Response
    {
        return $this->respond(['errors' => $errors], $statusCode, []);
    }

    protected function respondSuccess(mixed $data, int $statusCode = Response::HTTP_OK): Response
    {
        return $this->respond($data, $statusCode, []);
    }

    protected function respond(mixed $data, int $statusCode, array $headers = []): Response
    {
        return $this->handleView($this->view($data, $statusCode, $headers));
    }

    protected function buildSerializedResponse($data, array $groups): array
    {
        $serializer = Builder::create()
            ->setPropertyNamingStrategy(
                new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy())
            )->build();
        return $serializer->toArray($data, SerializationContext::create()->setGroups($groups));
    }
}