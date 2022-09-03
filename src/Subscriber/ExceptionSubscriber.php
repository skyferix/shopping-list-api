<?php

declare(strict_types=1);

namespace App\Subscriber;

use App\Response\Body\ExceptionBody;
use App\Response\Builder\SerializerBuilder;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public function __construct(private SerializerBuilder $serializerBuilder, private ExceptionBody $exceptionBody)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => ['serialize']
        ];
    }

    public function serialize(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $request = $event->getRequest();

        $code = $exception->getCode();

        if ($request->headers->get('Content-Type') !== 'application/json') {
            return;
        }

        $statusCode = 0 === $code ? Response::HTTP_INTERNAL_SERVER_ERROR : $code;
        $headers = [];

        if ($exception instanceof HttpExceptionInterface) {
            $headers = $exception->getHeaders();
            $statusCode = $exception->getStatusCode();
        }

        $body = $this->getExceptionBody($exception, $statusCode);

        $responseBody = $this->serializerBuilder->build($body);

        $response = new Response($responseBody, $statusCode, $headers);

        $event->setResponse($response);
    }


    private function getExceptionBody(\Throwable $exception, int $statusCode): ExceptionBody
    {
        $this->exceptionBody->setCode($statusCode);
        $this->exceptionBody->setMessage($exception->getMessage());
        $this->exceptionBody->setTrace($exception->getTrace());

        return $this->exceptionBody;
    }
}