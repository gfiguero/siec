<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArchivoAccidente
 *
 * @ORM\Table(name="Archivo_Accidente", indexes={@ORM\Index(name="IDX_Archivo_Accidente_Accidente", columns={"Accidente"})})
 * @ORM\Entity
 */
class ArchivoAccidente
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
     * @var string|null
     *
     * @ORM\Column(name="Nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Tipo", type="string", length=255, nullable=true)
     */
    private $tipo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Datos", type="blob", length=65535, nullable=true)
     */
    private $datos;

    /**
     * @var \Accidente
     *
     * @ORM\ManyToOne(targetEntity="Accidente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Accidente", referencedColumnName="Id")
     * })
     */
    private $accidente;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(?string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getDatos()
    {
        return $this->datos;
    }

    public function setDatos($datos): self
    {
        $this->datos = $datos;

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
