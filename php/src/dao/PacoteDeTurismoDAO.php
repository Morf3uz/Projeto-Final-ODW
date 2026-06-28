<?php

namespace dao;

use Exception;
use model\PacoteDeTurismo;
use utils\Conexao;

class PacoteDeTurismoDAO extends GenericDAO
{
    protected static $modelClass = PacoteDeTurismo::class;

    public static function buscarPorPrecoMaximoQueryBuilder($preco)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(PacoteDeTurismo::class);
            $queryBuilder = $repository->createQueryBuilder('p');
            $queryBuilder
                ->where('p.preco <= :preco')
                ->setParameter('preco', $preco);
            return $queryBuilder->getQuery()->getResult();
        } catch (Exception $ex) {
            throw new Exception("Falha ao buscar pacotes por preço. " . $ex->getMessage());
        }
    }

    public static function buscarPorDestinoDQL($destinoId)
    {
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery(
                "SELECT p FROM model\\PacoteDeTurismo p JOIN p.destino d WHERE d.id = :destinoId"
            );
            $query->setParameter('destinoId', (int) $destinoId);
            return $query->getResult();
        } catch (Exception $ex) {
            throw new Exception("Falha ao buscar pacotes pelo destino. " . $ex->getMessage());
        }
    }
}