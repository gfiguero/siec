<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * TipoUbicacionRelativaAccidente
 *
 * @ORM\Table(name="Tipo_Ubicacion_Relativa_Accidente", uniqueConstraints={@ORM\UniqueConstraint(name="UQ_Tipo_Ubicacion_Relativa_Accidente_Codigo_Clase_Accidente", columns={"Codigo", "Clase_Accidente"})}, indexes={@ORM\Index(name="IDX_Tipo_Ubicacion_Relativa_Accidente_Clase_Accidente", columns={"Clase_Accidente"})})
 * @ORM\Entity(repositoryClass="App\Repository\TipoUbicacionRelativaAccidenteRepository")
 * @UniqueEntity(fields={"codigo", "claseAccidente"})
 */
class TipoUbicacionRelativaAccidente
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
     * @var \ClaseAccidente
     *
     * @ORM\ManyToOne(targetEntity="ClaseAccidente", inversedBy="tiposUbicacionRelativaAccidente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Clase_Accidente", referencedColumnName="Id", nullable=false)
     * })
     */
    private $claseAccidente;

    /**
     * @var \Accidentes
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Accidente", mappedBy="tipoUbicacionRelativaAccidente")
     */
    private $accidentes;

    public function __construct()
    {
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

    public function getClaseAccidente(): ?ClaseAccidente
    {
        return $this->claseAccidente;
    }

    public function setClaseAccidente(?ClaseAccidente $claseAccidente): self
    {
        $this->claseAccidente = $claseAccidente;

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
            $accidente->setTipoUbicacionRelativaAccidente($this);
        }

        return $this;
    }

    public function removeAccidente(Accidente $accidente): self
    {
        if ($this->accidentes->contains($accidente)) {
            $this->accidentes->removeElement($accidente);
            // set the owning side to null (unless already changed)
            if ($accidente->getTipoUbicacionRelativaAccidente() === $this) {
                $accidente->setTipoUbicacionRelativaAccidente(null);
            }
        }

        return $this;
    }


}
