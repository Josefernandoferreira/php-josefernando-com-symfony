<?php

namespace App\Controller;

use App\Entity\Telefone;
use App\Repository\TelefoneRepository;
use \DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TelefoneController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */

    private $entityManager;

    /**
     * @var TelefoneRepository
     */
    private $telefoneRepository;

    public function __construct(EntityManagerInterface $entityManager, TelefoneRepository $telefoneRepository) {
        $this->entityManager = $entityManager;
        $this->telefoneRepository = $telefoneRepository;
    }

    /**
     * @Route("/telefone", methods={"POST"})
     */
    public function novo(Request $request): Response
    {
        $dadosRequest = $request->getContent();
        $dadosEmJson = json_decode($dadosRequest);

        $telefone = new Telefone();
        $telefone
            ->setDataAtualizacao(new DateTime())
            ->setDataCriacao(new DateTime())
            ->setDDD($dadosEmJson->ddd)
            ->setNumero($dadosEmJson->numero);

        $this->entityManager->persist($telefone);
        $this->entityManager->flush();

        return new JsonResponse($telefone);
    }

    /**
     * @Route("/telefone", methods={"GET"})
     */
    public function buscarTodos(): Response
    {
        $telefoneList = $this->telefoneRepository->findAll();

        return new JsonResponse($telefoneList);
    }

    /**
     * @Route("/telefone/{id}", methods={"GET"})
     */
    public function buscarPorId(int $id): Response
    {
        return new JsonResponse($this->telefoneRepository->find($id));
    }

    /**
     * @Route("/telefone/{id}", methods={"PUT"})
     */
    public function atualizaTelefone(int $id, Request $request): Response
    {
        $dadosRequest = $request->getContent();
        $dadosEmJson = json_decode($dadosRequest);

        $telefone = $this->telefoneRepository->find($id);
        $telefone
            ->setDataAtualizacao(new DateTime())
            ->setDDD($dadosEmJson->ddd)
            ->setNumero($dadosEmJson->numero);

        $this->entityManager->flush();

        return new JsonResponse($telefone);
    }

    /**
     * @Route("/telefone/{id}", methods={"DELETE"})
     */
    public function removeTelefone(int $id): Response
    {
        $telefone = $this->telefoneRepository->find($id);
        $this->entityManager->remove($telefone);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
