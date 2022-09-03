<?php

declare(strict_types=1);

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;

class ProductController extends AbstractApiController
{
    #[Rest\Get('/api/products')]
    /**
     * @OA\Tag(name="Products")
     *
     * @OA\Response(
     *     response=200,
     *     description="Returns product list"
     * )
     */
    public function index(): Response
    {
        return $this->respondSuccess(['pwd' => 'test']);
    }
}