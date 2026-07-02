<?php

namespace dao;

use Exception;
use model\Cronograma;
use utils\Conexao;

class CronogramaDAO extends GenericDAO
{
    protected static $modelClass = Cronograma::class;

    public static function buscarPorPacoteQueryBuilder($pacoteId)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Cronograma::class);
            $queryBuilder = $repository->createQueryBuilder('c');
            $queryBuilder
                ->where('c.pacote = :pacoteId')
                ->setParameter('pacoteId', (int) $pacoteId);
            return $queryBuilder->getQuery()->getResult();
        } catch (Exception $ex) {
            throw new Exception("Falha ao buscar cronogramas pelo pacote. " . $ex->getMessage());
        }
    }

    public static function buscarPorDescricaoDQL($descricao)
    {
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery(
                "SELECT c FROM model\\Cronograma c WHERE c.descricao LIKE :descricao"
            );
            $query->setParameter('descricao', '%' . $descricao . '%');
            return $query->getResult();
        } catch (Exception $ex) {
            throw new Exception("Falha ao buscar cronogramas pela descrição. " . $ex->getMessage());
        }
    }
}