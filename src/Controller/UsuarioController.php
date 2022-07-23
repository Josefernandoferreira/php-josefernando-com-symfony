<?php




namespace App\Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");

use App\Entity\Usuario;
use App\Service\UsuarioFactory;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use \DateTime;
use Symfony\Component\VarDumper\Cloner\Data;

class UsuarioController extends AbstractController{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UsuarioFactory
     */
    private $usuarioFactory;

    public function __construct(EntityManagerInterface $entityManager, UsuarioFactory $usuarioFactory)
    {
        $this->entityManager = $entityManager;
        $this->usuarioFactory = $usuarioFactory;
    }

    /**
     * @Route("/usuario", methods={"POST"})
     */
    public function novo(Request $request): Response
    {
        $corpoRequisicao = $request->getContent();
        $usuario = $this->usuarioFactory->criarUsuario($corpoRequisicao);

        $this->entityManager->persist($usuario);
        $this->entityManager->flush();

        return new JsonResponse($usuario);
    }

    /**
     * @Route("/usuario", methods={"GET"})
     */
    public function buscarTodos(): Response
    {
        $repositorioDeUsuarios = $this
            ->getDoctrine()
            ->getRepository(Usuario::class);

        $usuarioList = $repositorioDeUsuarios->findAll();

        return new JsonResponse($usuarioList);
    }

    /**
     * @Route("/usuario/{id}", methods={"GET"})
     */
    public function buscarPorId(int $id): Response
    {
        $usuario = $this->buscaUsuario($id);
        $codigoRetorno = is_null($usuario) ? Response::HTTP_NO_CONTENT : 200 ;

        return new JsonResponse($usuario, $codigoRetorno);
    }

    /**
     * @Route("/usuario/{id}", methods={"PUT"})
     */
    public function atualizaUsuarios(int $id, Request $request) : Response
    {

        $corpoRequisicao = $request->getContent();
        $usuarioEnviado = $this->usuarioFactory->criarUsuario($corpoRequisicao);

        $usuarioExistente = $this->buscaUsuario($id);

        if(is_null($usuarioExistente)){
            return new Response(' ',Response::HTTP_NOT_FOUND);
        }

        $usuarioExistente

            ->setDataCriacao($usuarioEnviado->getDataCriacao())
            ->setDataAtualizacao($usuarioEnviado->getDataAtualizacao())
            ->setNome($usuarioEnviado->getNome())
            ->setDataNascimento($usuarioEnviado->getDataNascimento())
            ->setEmail($usuarioEnviado->getEmail())
            ->setListaTelefones($usuarioEnviado->getListaTelefones());

        $this->entityManager->flush();

        return new JsonResponse($usuarioExistente);
    }

    /**
     * @Route("/usuario/{id}", methods={"DELETE"})
     */
    public function removeUsuarios(int $id) : Response
    {
        $usuario = $this->buscaUsuario($id);
        $this->entityManager->remove($usuario);
        $this->entityManager->flush();

        return new Response('',Response::HTTP_NO_CONTENT);
    }

    /**
     * @param $id
     * @return mixed|object|null
     */
    public function buscaUsuario(int $id)
    {
        $repositorioDeUsuarios = $this
            ->getDoctrine()
            ->getRepository(Usuario::class);
        $usuarioExistente = $repositorioDeUsuarios->find($id);
        return $usuarioExistente;
    }

}