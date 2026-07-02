<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
abstract class GenericModel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }
}