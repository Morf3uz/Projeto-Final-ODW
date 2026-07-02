<?php

namespace dao;

use Exception;
use model\Destino;
use utils\Conexao;

class DestinoDAO extends GenericDAO
{
    protected static $modelClass = Destino::class;

    public static function buscarPorCategoria($categoria)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Destino::class);
            return $repository->findBy(['categoria' => $categoria]);
        } catch (Exception $ex) {
            throw new Exception("Falha ao buscar destino pela categoria. " . $ex->getMessage());
        }
    }

    public static function buscarPorNomeQueryBuilder($nome)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Destino::class);
            $queryBuilder = $repository->createQueryBuilder('d');
            $queryBuilder
                ->where('d.nome LIKE :nome')
                ->setParameter('nome', '%' . $nome . '%');
            return $queryBuilder->getQuery()->getResult();
        } catch (Exception $ex) {
            throw new Exception("Falha ao buscar destino pelo nome. " . $ex->getMessage());
        }
    }

    public static function buscarPorPaisDQL($pais)
    {
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery("SELECT d FROM model\\Destino d WHERE d.pais = :pais");
            $query->setParameter('pais', $pais);
            return $query->getResult();
        } catch (Exception $ex) {
            throw new Exception("Falha ao buscar destino pelo país. " . $ex->getMessage());
        }
    }
}