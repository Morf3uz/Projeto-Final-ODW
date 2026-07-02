<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_destino')]
class Destino extends GenericModel
{
    #[ORM\Column(type: 'string', name: 'nome_destino', nullable: true)]
    private $nome;

    #[ORM\Column(type: 'text', name: 'descricao_destino', nullable: true)]
    private $descricao;

    #[ORM\Column(type: 'integer', name: 'duracao_dias', nullable: true)]
    private $duracaoDeDias;

    #[ORM\Column(type: 'string', name: 'categoria_destino', length: 100, nullable: true)]
    private $categoria;

    #[ORM\Column(type: 'string', name: 'pais_destino', length: 100, nullable: true)]
    private $pais;

    #[ORM\Column(type: 'text', name: 'imagem_url', nullable: true)]
    private $imagemUrl;

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getDuracaoDeDias()
    {
        return $this->duracaoDeDias;
    }

    public function setDuracaoDeDias($duracaoDeDias): void
    {
        $this->duracaoDeDias = $duracaoDeDias;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria): void
    {
        $this->categoria = $categoria;
    }

    public function getPais()
    {
        return $this->pais;
    }

    public function setPais($pais): void
    {
        $this->pais = $pais;
    }

    public function getImagemUrl()
    {
        return $this->imagemUrl;
    }

    public function setImagemUrl($imagemUrl): void
    {
        $this->imagemUrl = $imagemUrl;
    }
}