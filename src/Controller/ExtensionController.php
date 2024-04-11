<?php

namespace App\Controller;

use App\Entity\Extension;
use App\Form\ExtensionType;
use App\Repository\ExtensionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/extension')]
class ExtensionController extends AbstractController
{
    #[Route('/', name: 'app_extension_index', methods: ['GET'])]
    public function index(ExtensionRepository $extensionRepository): Response
    {
        return $this->render('extension/index.html.twig', [
            'extensions' => $extensionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_extension_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $extension = new Extension();
        $form = $this->createForm(ExtensionType::class, $extension);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($extension);
            $entityManager->flush();

            return $this->redirectToRoute('app_extension_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('extension/new.html.twig', [
            'extension' => $extension,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_extension_show', methods: ['GET'])]
    public function show(Extension $extension): Response
    {
        return $this->render('extension/show.html.twig', [
            'extension' => $extension,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_extension_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Extension $extension, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ExtensionType::class, $extension);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_extension_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('extension/edit.html.twig', [
            'extension' => $extension,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_extension_delete', methods: ['POST'])]
    public function delete(Request $request, Extension $extension, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$extension->getId(), $request->request->get('_token'))) {
            $entityManager->remove($extension);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_extension_index', [], Response::HTTP_SEE_OTHER);
    }
}
