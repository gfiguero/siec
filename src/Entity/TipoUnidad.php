<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoUnidad
 *
 * @ORM\Table(name="Tipo_Unidad")
 * @ORM\Entity
 */
class TipoUnidad
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNombre();
    }

}
