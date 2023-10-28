<?php

namespace src\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="src\Repository\ContatoRepository")
 * @ORM\Table(name="contato")
 */
class Contato
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $tipo;

    /**
     * @ORM\Column(type="string")
     */
    private $descricao;

     /**
     * @ORM\ManyToOne(targetEntity="src\Entity\Pessoa")
     * @ORM\JoinColumn(name="idPessoa", referencedColumnName="id")
     */
    private $pessoa;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getPessoa()
    {
        return $this->pessoa;
    }

    public function setPessoa($pessoa)
    {
        $this->pessoa = $pessoa;
    }

}