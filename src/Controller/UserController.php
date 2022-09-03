<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

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
     *     @Model(type=User::class, groups={"all"})
     * )
     */
    public function readCurrent(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            return $this->respondSuccess([
                'email' => $user->getUserIdentifier(),
                'roles' => $user->getRoles()
            ]);
        }
        $response = $this->buildSerializedResponse($user, ['all']);
        return $this->respondSuccess($response);
    }


    #[Rest\Post('/api/user')]
    #[IsGranted('ROLE_ADMIN')]
    #[ParamConverter('user', class: User::class, converter: 'fos_rest.request_body')]
    /**
     * @OA\Tag(name="User")
     *
     * @OA\RequestBody(
     *     required=true,
     *     @Model(type=User::class, groups={"create"})
     * )
     * @OA\Response(
     *     response=201,
     *     description="Return created user data",
     *     @Model(type=User::class, groups={"all"})
     * )
     */
    public function create(User $user, ConstraintViolationListInterface $validationErrors, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        if (count($validationErrors) > 0) {
            return $this->respondError($validationErrors);
        }

        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $user->getPassword()
        );

        $user->setPassword($hashedPassword);

        $entityManager->persist($user);
        $entityManager->flush($user);

        return $this->respondSuccess($user, Response::HTTP_CREATED);
    }

    #[Rest\Get('/api/user')]
    #[IsGranted('ROLE_ADMIN')]
    /**
     * @OA\Tag(name="User")
     *
     * @OA\Response(
     *     response=200,
     *     description="Return current user data",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=User::class, groups={"all"}))
     *     )
     * )
     */
    public function readAll(UserRepository $repository): Response
    {
        $users = $repository->findAll();
        $response = $this->buildSerializedResponse($users, ['all']);

        return $this->respondSuccess($response);
    }
}