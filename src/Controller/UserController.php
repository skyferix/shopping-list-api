<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;


class UserController extends AbstractApiController
{
    #[Rest\Get('/api/user/current')]
    /**
     * @OA\Tag(name="User")
     *
     * @OA\Response(
     *     response=200,
     *     description="Return current user data",
     *     @Model(type=User::class)
     * )
     */
    public function readCurrent(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        return $this->respondSuccess($user);
    }
}