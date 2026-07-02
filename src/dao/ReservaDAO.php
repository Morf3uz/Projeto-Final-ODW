<?php

namespace dao;

use Exception;
use model\Reserva;
use utils\Conexao;

class ReservaDAO extends GenericDAO
{
    protected static $modelClass = Reserva::class;

    public static function buscarPorClienteQueryBuilder($clienteId)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Reserva::class);
            $queryBuilder = $repository->createQueryBuilder('r');
            $queryBuilder
                ->where('r.cliente = :clienteId')
                ->setParameter('clienteId', (int) $clienteId);
            return $queryBuilder->getQuery()->getResult();
        } catch (Exception $ex) {
            throw new Exception("Falha ao buscar reservas pelo cliente. " . $ex->getMessage());
        }
    }

    public static function buscarPorDataDQL($data)
    {
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery(
                "SELECT r FROM model\\Reserva r WHERE r.dataReserva = :data"
            );
            $query->setParameter('data', new \DateTime($data));
            return $query->getResult();
        } catch (Exception $ex) {
            throw new Exception("Falha ao buscar reservas pela data. " . $ex->getMessage());
        }
    }

    public static function buscarPorClienteEPacoteDQL($clienteId, $pacoteId)
    {
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery(
                "SELECT r FROM model\\Reserva r
                 JOIN r.cliente c
                 JOIN r.pacote p
                 WHERE c.id = :clienteId AND p.id = :pacoteId"
            );
            $query->setParameter('clienteId', (int) $clienteId);
            $query->setParameter('pacoteId', (int) $pacoteId);
            return $query->getResult();
        } catch (Exception $ex) {
            throw new Exception("Falha ao buscar reservas por cliente e pacote. " . $ex->getMessage());
        }
    }
}