<?php

namespace App\Service;

use App\Controller\UsuarioController;
use App\Entity\Usuario;
use App\Repository\TelefoneRepository;
use DateTime;

class UsuarioFactory
{

    /**
     * @var TelefoneRepository
     */
    private $telefoneRepository;

    public function __construct(TelefoneRepository $telefoneRepository)
    {
        $this->telefoneRepository = $telefoneRepository;
    }

    public function criarUsuario(string $json): Usuario
    {

        $dadosEmJson = json_decode($json);
        $telefoneId = $dadosEmJson->listaTelefones;
        $telefone = $this->telefoneRepository->find($telefoneId);

        $usuario = new Usuario();

        $dataNascimento = new DateTime($dadosEmJson->dataNascimento);

        $usuario
            ->setDataCriacao(new DateTime())
            ->setDataAtualizacao(new DateTime())
            ->setNome($dadosEmJson->nome)
            ->setDataNascimento($dataNascimento)
            ->setEmail($dadosEmJson->email)
            ->setListaTelefones($telefone);

        return $usuario;
    }
}