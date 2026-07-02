<?php

namespace dao;

use Exception;
use model\GenericModel;
use utils\Conexao;

abstract class GenericDAO
{
    protected static $modelClass;

    public static function salvar(GenericModel $model)
    {
        try {
            $em = Conexao::getEntityManager();
            $em->beginTransaction();
            $em->persist($model);
            $em->flush();
            $em->commit();
            return $model;
        } catch (Exception $ex) {
            $em->rollback();
            throw new Exception("Falha ao salvar os dados. " . $ex->getMessage());
        }
    }

    public static function listar()
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(static::$modelClass);
            return $repository->findAll();
        } catch (Exception $ex) {
            throw new Exception("Falha ao listar os dados. " . $ex->getMessage());
        }
    }

    public static function buscarPorId($id)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(static::$modelClass);
            return $repository->find($id);
        } catch (Exception $ex) {
            throw new Exception("Falha ao buscar pelo ID. " . $ex->getMessage());
        }
    }

    public static function excluir($id)
    {
        try {
            $em = Conexao::getEntityManager();
            $model = $em->getRepository(static::$modelClass)->find($id);
            $em->beginTransaction();
            $em->remove($model);
            $em->flush();
            $em->commit();
        } catch (Exception $ex) {
            $em->rollback();
            throw new Exception("Falha ao excluir os dados. " . $ex->getMessage());
        }
    }
}