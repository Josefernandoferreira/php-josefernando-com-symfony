<?php

namespace App\Entity;
use \DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Usuario implements \JsonSerializable
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;


    /**
     * @ORM\Column(type="date")
     */
    public $dataCriacao;

    /**
     * @ORM\Column(type="date")
     */
    public $dataAtualizacao;

    /**
     * @ORM\Column(type="string",length=30)
     */
    public $nome ;

    /**
     * @ORM\Column(type="date")
     */
    public $dataNascimento ;

    /**
     * @ORM\Column(type="string",length=20))
     */
    public $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Telefone")
     * @ORM\JoinColumn(nullable=false)
     */
    public $listaTelefones;



    public function getId(): ?Int
    {
        return $this->id;
    }

    public function getDataCriacao(): ?datetime
    {
        return $this->dataCriacao;
    }

    public function setDataCriacao(datetime $dataCriacao): self
    {
        $this->dataCriacao = $dataCriacao;
        return $this;
    }

    public function getDataAtualizacao(): ?datetime
    {
        return $this->dataAtualizacao;
    }

    public function setDataAtualizacao(datetime $dataAtualizacao): self
    {
        $this->dataAtualizacao = $dataAtualizacao;
        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    public function getDataNascimento(): ?datetime
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(datetime $dataNascimento): self
    {
        $this->dataNascimento = $dataNascimento;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getListaTelefones(): ?Telefone
    {
        return $this->listaTelefones;
    }

    public function setListaTelefones(?Telefone $listaTelefones): self
    {
        $this->listaTelefones = $listaTelefones;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'dataCriacao' => $this->getDataCriacao(),
            'dataAtualizacao' => $this->getDataAtualizacao(),
            'nome' => $this->getNome(),
            'dataNascimento' => $this->getDataNascimento(),
            'email' => $this->getEmail(),
            'listaTelefones' => $this->getListaTelefones()->getId()
        ];
    }

}

