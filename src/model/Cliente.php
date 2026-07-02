<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_cliente')]
class Cliente extends GenericModel
{
    #[ORM\Column(type: 'string', name: 'nome_cliente')]
    private $nome;

    #[ORM\Column(type: 'string', name: 'email_cliente', unique: true)]
    private $email;

    #[ORM\Column(type: 'string', name: 'cpf_cliente', length: 11, unique: true, nullable: true)]
    private $cpf;

    #[ORM\Column(type: 'string', name: 'senha_cliente', nullable: true)]
    private $senha;

    #[ORM\Column(type: 'boolean', name: 'is_admin', options: ['default' => false])]
    private bool $isAdmin = false;

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf): void
    {
        $this->cpf = $cpf;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha): void
    {
        $this->senha = $senha;
    }

    public function getIsAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): void
    {
        $this->isAdmin = $isAdmin;
    }
}