<?php

namespace App\Controller;

use App\Entity\TypeExtension;
use App\Form\TypeExtensionType;
use App\Repository\TypeExtensionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/type/extension')]
class TypeExtensionController extends AbstractController
{
    #[Route('/', name: 'app_type_extension_index', methods: ['GET'])]
    public function index(TypeExtensionRepository $typeExtensionRepository): Response
    {
        return $this->render('type_extension/index.html.twig', [
            'type_extensions' => $typeExtensionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_extension_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeExtension = new TypeExtension();
        $form = $this->createForm(TypeExtensionType::class, $typeExtension);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeExtension);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_extension_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_extension/new.html.twig', [
            'type_extension' => $typeExtension,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_extension_show', methods: ['GET'])]
    public function show(TypeExtension $typeExtension): Response
    {
        return $this->render('type_extension/show.html.twig', [
            'type_extension' => $typeExtension,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_extension_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeExtension $typeExtension, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeExtensionType::class, $typeExtension);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_type_extension_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_extension/edit.html.twig', [
            'type_extension' => $typeExtension,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_extension_delete', methods: ['POST'])]
    public function delete(Request $request, TypeExtension $typeExtension, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeExtension->getId(), $request->request->get('_token'))) {
            $entityManager->remove($typeExtension);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_type_extension_index', [], Response::HTTP_SEE_OTHER);
    }
}
