<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\SearchTypeRequest;
use App\Services\Factory\SearchFactory;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SearchController extends AbstractController
{
    #[Route('/movies_search', name: 'movies_search', methods: ['GET'])]
    public function moviesSearch(
        Request $request,
        ValidatorInterface $validator,
        SearchFactory $searchFactory,
        LoggerInterface $logger
    ): JsonResponse {
        try {
            $searchTypeRequest = new SearchTypeRequest($request->query->get('type'));

            $errors = $validator->validate($searchTypeRequest);

            if (count($errors) > 0) {
                return $this->json(['message' => (string)$errors], Response::HTTP_BAD_REQUEST);
            }
            $searchStrategy = $searchFactory->make($searchTypeRequest->getTypeAsEnum());

            $movies = $searchStrategy->execute();

            return $this->json(
                [
                    'message' => Response::$statusTexts[Response::HTTP_OK],
                    'data' => ['count' => count($movies), 'movies' => $movies]
                ]
            );
        } catch (\Throwable $e) {
            $logger->error($e->getMessage());

            return $this->json(
                ['message' => Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR]],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
