<?php

declare(strict_types=1);

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
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
}