<?php

declare(strict_types=1);

namespace App\Controller;

use App\Response\Builder\SerializerBuilder;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractApiController extends AbstractFOSRestController
{
    public function __construct(public SerializerBuilder $serializerBuilder)
    {
    }

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

    protected function isSimpleUser(): bool
    {
        return !($this->isGranted('ROLE_SUPER_ADMIN') && $this->isGranted('ROLE_ADMIN'));
    }
}