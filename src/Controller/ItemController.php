<?php

namespace App\Controller;

use App\Entity\Item;
use App\Form\Search\ItemType;
use App\Service\ItemsService;
use App\Entity\AbstractDisplayableEntity;
use App\Entity\Search\Item as SearchItem;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/items", name="items_")
 */
class ItemController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(ItemsService $itemsService, PaginatorInterface $paginator, Request $request)
    {
        $search = new SearchItem();
        $form = $this->createForm(ItemType::class, $search);
        $form->handleRequest($request);

        if($form->isSubmitted() && !$form->isValid()){
            $search = new SearchItem();
        }

        $items = $paginator->paginate(
            $itemsService->findBySearchCriterias($search),
            $request->query->getInt('page', 1), 
            10
        );

        return $this->render('item/list.html.twig', [
            'items' => $items,
            'searchForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/{slug}", name="view", requirements={"slug"=AbstractDisplayableEntity::SLUG_PATTERN})
     */
    public function view(Item $item)
    {
        return $this->render('item/view.html.twig', [
            'item' => $item
        ]);
    }
}
