<?php

declare(strict_types=1);

namespace App\Controller;

use App\Distance\Distance;
use App\Distance\DistanceServiceInterface;
use App\Distance\Unit;
use App\Redis\RedisClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DistanceController extends AbstractController
{
    public function __construct(
        private readonly DistanceServiceInterface $distanceService,
        private readonly RedisClientInterface $redisClient
    ) {}
    #[Route('/distance', methods: ['GET'])]
    public function get(Request $request): JsonResponse
    {
        try {
            $firstDistance = new Distance(
                (float) $request->get('first_distance_value'),
                Unit::from($request->get('first_distance_unit'))
            );

            $secondDistance = new Distance(
                (float) $request->get('second_distance_value'),
                Unit::from($request->get('second_distance_unit'))
            );
            $responseUnit = Unit::from($request->get('response_unit'));

            $redisKey = $this->generateRedisKey($firstDistance, $secondDistance, $responseUnit);
            if ($cachedRecord = $this->redisClient->read($redisKey)) {
                return new JsonResponse($cachedRecord, Response::HTTP_OK, [], true);
            }

            $totalDistance = $this->distanceService->calculate($firstDistance, $secondDistance, $responseUnit);

            $this->redisClient->write($redisKey, json_encode($totalDistance, JSON_THROW_ON_ERROR));

            return new JsonResponse([
                'distance' => $totalDistance->getValue(),
                'unit' => $totalDistance->getUnit(),
            ], Response::HTTP_OK);
        } catch (\Throwable $exception) {
            return new JsonResponse(
                sprintf('Something is wrong: %s!', $exception->getMessage()),
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    private function generateRedisKey(Distance $firstDistance, Distance $secondDistance, Unit $unit): string
    {
        return sprintf(
            '%s-%s-%s-%s-%s',
            $firstDistance->getValue(),
            $firstDistance->getUnit()->value,
            $secondDistance->getValue(),
            $secondDistance->getUnit()->value,
            $unit->value
        );
    }
}