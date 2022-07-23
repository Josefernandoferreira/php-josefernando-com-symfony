<?php

namespace App\Entity;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TelefoneRepository")
 */
class Telefone implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
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
     * @ORM\Column(type="string",length=3)
     */
    public $ddd;

    /**
     * @ORM\Column(type="string",length=50)
     */
    public $numero;


    public function getId(): ?int
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

    public function getDataAtualizacao() :?datetime
    {
        return $this->dataAtualizacao;
    }

    public function setDataAtualizacao(datetime $dataAtualizacao): ?self
    {
        $this->dataAtualizacao = $dataAtualizacao;
        return $this;
    }

    public function getDDD() :?string
    {
        return $this->ddd;
    }

    public function setDDD(string $ddd): ?self
    {
        $this->ddd = $ddd;
        return $this;
    }

    public function getNumero() :?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): ?self
    {
        $this->numero = $numero;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'dataCriacao' => $this->getDataCriacao(),
            'dataAtualizacao' => $this->getDataAtualizacao(),
            'ddd' => $this->getDDD(),
            'numero' => $this->getNumero()
        ];
    }

}