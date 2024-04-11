<?php

namespace App\Controller;

use App\Entity\Langue;
use App\Form\LangueType;
use App\Repository\LangueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/langue')]
class LangueController extends AbstractController
{
    #[Route('/', name: 'app_langue_index', methods: ['GET'])]
    public function index(LangueRepository $langueRepository): Response
    {
        return $this->render('langue/index.html.twig', [
            'langues' => $langueRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_langue_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $langue = new Langue();
        $form = $this->createForm(LangueType::class, $langue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($langue);
            $entityManager->flush();

            return $this->redirectToRoute('app_langue_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('langue/new.html.twig', [
            'langue' => $langue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_langue_show', methods: ['GET'])]
    public function show(Langue $langue): Response
    {
        return $this->render('langue/show.html.twig', [
            'langue' => $langue,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_langue_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Langue $langue, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LangueType::class, $langue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_langue_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('langue/edit.html.twig', [
            'langue' => $langue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_langue_delete', methods: ['POST'])]
    public function delete(Request $request, Langue $langue, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$langue->getId(), $request->request->get('_token'))) {
            $entityManager->remove($langue);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_langue_index', [], Response::HTTP_SEE_OTHER);
    }
}
