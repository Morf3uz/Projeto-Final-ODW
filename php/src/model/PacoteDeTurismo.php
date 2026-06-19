<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_pacote_turismo')]
class PacoteDeTurismo extends GenericModel
{
    #[ORM\Column(type: 'string', name: 'nome_pacote', nullable: true)]
    private $nome;

    #[ORM\Column(type: 'decimal', name: 'preco_pacote', precision: 10, scale: 2, nullable: true)]
    private $preco;

    #[ORM\ManyToOne(targetEntity: Destino::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(name: 'destino_id', nullable: true)]
    private $destino;

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function setPreco($preco): void
    {
        $this->preco = $preco;
    }

    public function getDestino()
    {
        return $this->destino;
    }

    public function setDestino($destino): void
    {
        $this->destino = $destino;
    }
}