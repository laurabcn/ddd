<?php

namespace App\Activities\Infrastructure\UI\http;

use App\Activities\Application\Activity\Find\FindActivityQuery;
use App\Activities\Application\Activity\Find\FindActivityResponse;
use App\Activities\Domain\Activity\Activity;
use App\Activities\Domain\Shared\ValueObject\Id;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;



/**
 * Class ApiController
 *
 * @Route("/")
 */
final class ApiController extends Controller
{

    /**
     * @Rest\Get("/activity/{id}")
     */
    public function getActivityAction(string $id): View
    {
        $repository = $this->getDoctrine()->getRepository(Activity::class);

        // query for a single Product by its primary key (usually "id")
        $activity = $repository->byId(new Id($id));

        return View::create($activity, Response::HTTP_OK);
    }

    /**
     * Lists all activities.
     * @Rest\Get("/activities")
     *
     */
    public function getArticleAction()
    {
        $repository = $this->getDoctrine()->getRepository(Activity::class);

        // query for a single Product by its primary key (usually "id")
        $article = $repository->all();

        return View::create($article, Response::HTTP_OK , []);
    }

}
