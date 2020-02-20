<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * ServicioVehiculo
 *
 * @ORM\Table(name="Servicio_Vehiculo", uniqueConstraints={@ORM\UniqueConstraint(name="UQ_Servicio_Vehiculo_Codigo", columns={"Codigo"})})
 * @ORM\Entity(repositoryClass="App\Repository\ServicioVehiculoRepository")
 * @UniqueEntity("codigo")
 */
class ServicioVehiculo
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
     * @var \VehiculoAccidente
     *
     * @ORM\OneToMany(targetEntity="App\Entity\VehiculoAccidente", mappedBy="servicioVehiculo")
     */
    private $vehiculosAccidente;

    public function __construct()
    {
        $this->vehiculosAccidente = new ArrayCollection();
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
     * @return Collection|VehiculoAccidente[]
     */
    public function getVehiculosAccidente(): Collection
    {
        return $this->vehiculosAccidente;
    }

    public function addVehiculosAccidente(VehiculoAccidente $vehiculosAccidente): self
    {
        if (!$this->vehiculosAccidente->contains($vehiculosAccidente)) {
            $this->vehiculosAccidente[] = $vehiculosAccidente;
            $vehiculosAccidente->setServicioVehiculo($this);
        }

        return $this;
    }

    public function removeVehiculosAccidente(VehiculoAccidente $vehiculosAccidente): self
    {
        if ($this->vehiculosAccidente->contains($vehiculosAccidente)) {
            $this->vehiculosAccidente->removeElement($vehiculosAccidente);
            // set the owning side to null (unless already changed)
            if ($vehiculosAccidente->getServicioVehiculo() === $this) {
                $vehiculosAccidente->setServicioVehiculo(null);
            }
        }

        return $this;
    }


}
