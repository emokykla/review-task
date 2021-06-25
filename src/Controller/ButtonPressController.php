<?php

namespace App\Controller;

use App\Entity\CounterUpdateLogEntity;
use App\Service\CounterManagerService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ButtonPressController extends AbstractController
{
    #[Route('/', name: 'button_press')]
    public function index(Request $request, CounterManagerService $counterManagerService, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder()->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->addFlash('success', 'Counter incremented!');
            $counterManagerService->incrementCounter();
            $log = (new CounterUpdateLogEntity())
                ->setCounter($counterManagerService->counter)
                ->setTimestamp((new DateTime())->format('Y-m-d H:i:s'));
            $entityManager->persist($log);
            $entityManager->flush();
        }

        return $this->render(
            'button_press/index.html.twig',
            [
                'form' => $form->createView(),
                'counter' => $counterManagerService->counter,
                'lastUpdate' => $entityManager->getRepository(CounterUpdateLogEntity::class)->findOneBy([])
            ]
        );
    }
}
