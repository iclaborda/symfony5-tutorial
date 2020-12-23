<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClienteRepository::class)
 */
class Cliente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $TX_NOME_CLIENTE;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $TX_EMAIL_CLIENTE;

    /**
     * @ORM\Column(type="string", length=256, unique=true)
     */
    private $NB_CPF_CNPJ;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $TNB_TELEFONE_CLIENTE;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTXNOMECLIENTE(): ?string
    {
        return $this->TX_NOME_CLIENTE;
    }

    public function setTXNOMECLIENTE(string $TX_NOME_CLIENTE): self
    {
        $this->TX_NOME_CLIENTE = $TX_NOME_CLIENTE;

        return $this;
    }

    public function getTXEMAILCLIENTE(): ?string
    {
        return $this->TX_EMAIL_CLIENTE;
    }

    public function setTXEMAILCLIENTE(string $TX_EMAIL_CLIENTE): self
    {
        $this->TX_EMAIL_CLIENTE = $TX_EMAIL_CLIENTE;

        return $this;
    }

    public function getNBCPFCNPJ(): ?string
    {
        return $this->NB_CPF_CNPJ;
    }

    public function setNBCPFCNPJ(string $NB_CPF_CNPJ): self
    {
        $this->NB_CPF_CNPJ = $NB_CPF_CNPJ;

        return $this;
    }

    public function getTNBTELEFONECLIENTE(): ?string
    {
        return $this->TNB_TELEFONE_CLIENTE;
    }

    public function setTNBTELEFONECLIENTE(string $TNB_TELEFONE_CLIENTE): self
    {
        $this->TNB_TELEFONE_CLIENTE = $TNB_TELEFONE_CLIENTE;

        return $this;
    }

    //Função que retorna os parametros do objeto dentro de um array para json_encode

    public function toArray() {
        return [
            'id_cliente' => $this->getId(),
            'nome_cliente' => $this->getTXNOMECLIENTE(),
            'CPF_cliente' => $this->getNBCPFCNPJ(),
            'email_cliente' => $this->getTXEMAILCLIENTE(),
            'telefone_cliente' => $this->getTNBTELEFONECLIENTE()
        ];
    }
}
