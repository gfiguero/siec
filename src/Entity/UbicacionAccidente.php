<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UbicacionAccidente
 *
 * @ORM\Table(name="Ubicacion_Accidente")
 * @ORM\Entity(repositoryClass="App\Repository\UbicacionAccidenteRepository")
 */
class UbicacionAccidente
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Glosa", type="string", length=255, nullable=true)
     */
    private $glosa;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Maestro_Id", type="string", length=255, nullable=true)
     */
    private $maestroId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Calle", type="string", length=255, nullable=true)
     */
    private $calle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Comuna", type="string", length=255, nullable=true)
     */
    private $comuna;

    /**
     * @var integer|null
     *
     * @ORM\Column(name="Tipo_Id", type="integer", nullable=true)
     */
    private $tipoId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Tipo", type="string", length=255, nullable=true)
     */
    private $tipo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Numero", type="string", length=255, nullable=true)
     */
    private $numero;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Pais", type="string", length=255, nullable=true)
     */
    private $pais;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Latitud", type="string", length=255, nullable=true)
     */
    private $latitud;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Longitud", type="string", length=255, nullable=true)
     */
    private $longitud;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Accidente", mappedBy="ubicacion", cascade={"persist", "remove"})
     */
    private $accidente;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaestroId(): ?string
    {
        return $this->maestroId;
    }

    public function setMaestroId(?string $maestroId): self
    {
        $this->maestroId = $maestroId;

        return $this;
    }

    public function getCalle(): ?string
    {
        return $this->calle;
    }

    public function setCalle(?string $calle): self
    {
        $this->calle = $calle;

        return $this;
    }

    public function getComuna(): ?string
    {
        return $this->comuna;
    }

    public function setComuna(?string $comuna): self
    {
        $this->comuna = $comuna;

        return $this;
    }

    public function getTipoId(): ?string
    {
        return $this->tipoId;
    }

    public function setTipoId(?string $tipoId): self
    {
        $this->tipoId = $tipoId;

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

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function setPais(?string $pais): self
    {
        $this->pais = $pais;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getLatitud(): ?string
    {
        return $this->latitud;
    }

    public function setLatitud(?string $latitud): self
    {
        $this->latitud = $latitud;

        return $this;
    }

    public function getLongitud(): ?string
    {
        return $this->longitud;
    }

    public function setLongitud(?string $longitud): self
    {
        $this->longitud = $longitud;

        return $this;
    }

    public function getAccidente(): ?Accidente
    {
        return $this->accidente;
    }

    public function setAccidente(Accidente $accidente): self
    {
        $this->accidente = $accidente;

        // set the owning side of the relation if necessary
        if ($this !== $accidente->getUbicacion()) {
            $accidente->setUbicacion($this);
        }

        return $this;
    }

    public function getGlosa(): ?string
    {
        return $this->glosa;
    }

    public function setGlosa(?string $glosa): self
    {
        $this->glosa = $glosa;

        return $this;
    }
}
