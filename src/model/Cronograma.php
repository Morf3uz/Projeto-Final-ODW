<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_cronograma')]
class Cronograma extends GenericModel
{
    #[ORM\Column(type: 'text', name: 'descricao_cronograma', nullable: true)]
    private $descricao;

    #[ORM\Column(type: 'string', name: 'horario_cronograma', length: 10, nullable: true)]
    private $horario;

    #[ORM\ManyToOne(targetEntity: PacoteDeTurismo::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(name: 'pacote_id', nullable: true)]
    private $pacote;

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getHorario()
    {
        return $this->horario;
    }

    public function setHorario($horario): void
    {
        $this->horario = $horario;
    }

    public function getPacote()
    {
        return $this->pacote;
    }

    public function setPacote($pacote): void
    {
        $this->pacote = $pacote;
    }
}