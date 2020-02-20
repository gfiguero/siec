<?php

namespace App\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * Grupo
 *
 * @ORM\Entity(repositoryClass="App\Repository\GrupoRepository")
 * @ORM\Table(name="Grupo")
 */
class Grupo extends BaseGroup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="Id", type="integer", nullable=false)
     */
    protected $id;

    public function __construct($nombre ='', $roles = array())
    {
        parent::__construct($nombre, $roles);
    }

    public function __toString(): string
    {
        return parent::getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

}
