<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Incoherencia
 *
 * @ORM\Table(name="Incoherencia")
 * @ORM\Entity(repositoryClass="App\Repository\IncoherenciaRepository")
 */
class Incoherencia
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @var \Accidente
     *
     * @ORM\ManyToOne(targetEntity="Accidente", inversedBy="incoherencias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Accidente", referencedColumnName="Id", nullable=false)
     * })
     */
    private $accidente;

    public function __construct(Accidente $accidente, String $descripcion) {
        $this->descripcion = $descripcion;
        $this->accidente = $accidente;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getAccidente(): ?Accidente
    {
        return $this->accidente;
    }

    public function setAccidente(?Accidente $accidente): self
    {
        $this->accidente = $accidente;

        return $this;
    }
}
