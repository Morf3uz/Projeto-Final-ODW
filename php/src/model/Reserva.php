<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_reserva')]
class Reserva extends GenericModel
{
    #[ORM\Column(type: 'date', name: 'data_reserva', nullable: true)]
    private $dataReserva;

    #[ORM\ManyToOne(targetEntity: Cliente::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(name: 'cliente_id', nullable: true)]
    private $cliente;

    #[ORM\ManyToOne(targetEntity: PacoteDeTurismo::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(name: 'pacote_id', nullable: true)]
    private $pacote;

    public function getDataReserva()
    {
        return $this->dataReserva;
    }

    public function setDataReserva($dataReserva): void
    {
        $this->dataReserva = $dataReserva;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente($cliente): void
    {
        $this->cliente = $cliente;
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