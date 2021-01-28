<?php

namespace App\Controller;

use App\Entity\Train;
use App\Form\TrainType;
use App\Repository\TrainRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/train")
 */
class TrainController extends AbstractController
{
    /**
     * @Route("/", name="train_index", methods={"GET"})
     */
    public function index(TrainRepository $trainRepository): Response
    {
        return $this->render('train/index.html.twig', [
            'trains' => $trainRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="train_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $train = new Train();
        $form = $this->createForm(TrainType::class, $train);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($train);
            $entityManager->flush();

            return $this->redirectToRoute('train_index');
        }

        return $this->render('train/new.html.twig', [
            'train' => $train,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="train_show", methods={"GET"})
     */
    public function show(Train $train): Response
    {
        return $this->render('train/show.html.twig', [
            'train' => $train,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="train_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Train $train): Response
    {
        $form = $this->createForm(TrainType::class, $train);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('train_index');
        }

        return $this->render('train/edit.html.twig', [
            'train' => $train,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="train_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Train $train): Response
    {
        if ($this->isCsrfTokenValid('delete'.$train->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($train);
            $entityManager->flush();
        }

        return $this->redirectToRoute('train_index');
    }
}
