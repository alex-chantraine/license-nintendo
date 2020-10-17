<?php

namespace App\Controller;

use App\Form\Search\ConsoleType;
use App\Service\ConsolesService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Search\Console as SearchConsole;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/consoles", name="consoles_")
 */
class ConsoleController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(ConsolesService $consolesService, PaginatorInterface $paginator, Request $request)
    {
        $search = new SearchConsole();
        $form = $this->createForm(ConsoleType::class, $search);
        $form->handleRequest($request);

        $consoles = $paginator->paginate(
            $consolesService->findBySearchCriterias($search),
            $request->query->getInt('page', 1), 
            10
        );
        return $this->render('console/list.html.twig', [
            'consoles' => $consoles,
            'searchForm' => $form->createView()
        ]);
    }
}