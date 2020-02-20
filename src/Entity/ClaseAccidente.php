<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * ClaseAccidente
 *
 * @ORM\Table(name="Clase_Accidente", uniqueConstraints={@ORM\UniqueConstraint(name="UQ_Clase_Accidente_Codigo", columns={"Codigo"})})
 * @ORM\Entity(repositoryClass="App\Repository\ClaseAccidenteRepository")
 * @UniqueEntity("codigo")
 */
class ClaseAccidente
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

    /**
     * @var string
     *
     * @ORM\Column(name="Codigo", type="string", length=10, nullable=false)
     */
    private $codigo;

    /**
     * @var \TiposAccidente
     *
     * @ORM\OneToMany(targetEntity="TipoAccidente", mappedBy="claseAccidente")
     * @ORM\OrderBy({"codigo" = "ASC"})
     */
    private $tiposAccidente;

    /**
     * @var \TiposUbicacionRelativaAccidente
     *
     * @ORM\OneToMany(targetEntity="TipoUbicacionRelativaAccidente", mappedBy="claseAccidente")
     */
    private $tiposUbicacionRelativaAccidente;

    /**
     * @var \Accidentes
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Accidente", mappedBy="claseAccidente")
     */
    private $accidentes;

    public function __construct()
    {
        $this->tiposAccidente = new ArrayCollection();
        $this->tiposUbicacionRelativaAccidente = new ArrayCollection();
        $this->accidentes = new ArrayCollection();
    }

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

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getCodigoNombre();
    }

    public function getCodigoNombre(): string
    {
        return $this->getCodigo() . ' - ' . $this->getNombre();
    }

    /**
     * @return Collection|TipoAccidente[]
     */
    public function getTiposAccidente(): Collection
    {
        return $this->tiposAccidente;
    }

    public function addTiposAccidente(TipoAccidente $tiposAccidente): self
    {
        if (!$this->tiposAccidente->contains($tiposAccidente)) {
            $this->tiposAccidente[] = $tiposAccidente;
            $tiposAccidente->setClaseAccidente($this);
        }

        return $this;
    }

    public function removeTiposAccidente(TipoAccidente $tiposAccidente): self
    {
        if ($this->tiposAccidente->contains($tiposAccidente)) {
            $this->tiposAccidente->removeElement($tiposAccidente);
            // set the owning side to null (unless already changed)
            if ($tiposAccidente->getClaseAccidente() === $this) {
                $tiposAccidente->setClaseAccidente(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TipoUbicacionRelativaAccidente[]
     */
    public function getTiposUbicacionRelativaAccidente(): Collection
    {
        return $this->tiposUbicacionRelativaAccidente;
    }

    public function addTiposUbicacionRelativaAccidente(TipoUbicacionRelativaAccidente $tiposUbicacionRelativaAccidente): self
    {
        if (!$this->tiposUbicacionRelativaAccidente->contains($tiposUbicacionRelativaAccidente)) {
            $this->tiposUbicacionRelativaAccidente[] = $tiposUbicacionRelativaAccidente;
            $tiposUbicacionRelativaAccidente->setClaseAccidente($this);
        }

        return $this;
    }

    public function removeTiposUbicacionRelativaAccidente(TipoUbicacionRelativaAccidente $tiposUbicacionRelativaAccidente): self
    {
        if ($this->tiposUbicacionRelativaAccidente->contains($tiposUbicacionRelativaAccidente)) {
            $this->tiposUbicacionRelativaAccidente->removeElement($tiposUbicacionRelativaAccidente);
            // set the owning side to null (unless already changed)
            if ($tiposUbicacionRelativaAccidente->getClaseAccidente() === $this) {
                $tiposUbicacionRelativaAccidente->setClaseAccidente(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Accidente[]
     */
    public function getAccidentes(): Collection
    {
        return $this->accidentes;
    }

    public function addAccidente(Accidente $accidente): self
    {
        if (!$this->accidentes->contains($accidente)) {
            $this->accidentes[] = $accidente;
            $accidente->setClaseAccidente($this);
        }

        return $this;
    }

    public function removeAccidente(Accidente $accidente): self
    {
        if ($this->accidentes->contains($accidente)) {
            $this->accidentes->removeElement($accidente);
            // set the owning side to null (unless already changed)
            if ($accidente->getClaseAccidente() === $this) {
                $accidente->setClaseAccidente(null);
            }
        }

        return $this;
    }


}
