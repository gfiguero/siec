<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * VehiculoAccidente
 *
 * @ORM\Table(name="Vehiculo_Accidente", indexes={
 * @ORM\Index(name="IDX_Vehiculo_Accidente_Consecuencia_Vehiculo", columns={"Consecuencia_Vehiculo"}),
 * @ORM\Index(name="IDX_Vehiculo_Accidente_Servicio_Vehiculo", columns={"Servicio_Vehiculo"}),
 * @ORM\Index(name="IDX_Vehiculo_Accidente_Vehiculo", columns={"Vehiculo"}),
 * @ORM\Index(name="IDX_Vehiculo_Accidente_Accidente", columns={"Accidente"}),
 * @ORM\Index(name="IDX_Vehiculo_Accidente_Maniobra_Vehiculo", columns={"Maniobra_Vehiculo"}),
 * @ORM\Index(name="IDX_Vehiculo_Accidente_Direccion_Vehiculo", columns={"Direccion_Vehiculo"})})
 * @ORM\Entity(repositoryClass="App\Repository\VehiculoAccidenteRepository")
 */
class VehiculoAccidente
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
     * @var bool|null
     *
     * @ORM\Column(name="Vehiculo_Es_Causante_Probable", type="boolean", nullable=true)
     */
    private $vehiculoEsCausanteProbable;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Vehiculo_Se_Fuga", type="boolean", nullable=true)
     */
    private $vehiculoSeFuga;

    /**
     * @var \Accidente
     *
     * @ORM\ManyToOne(targetEntity="Accidente", inversedBy="vehiculosAccidente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Accidente", referencedColumnName="Id")
     * })
     */
    private $accidente;

    /**
     * @var \ConsecuenciaVehiculo
     *
     * @ORM\ManyToOne(targetEntity="ConsecuenciaVehiculo", inversedBy="vehiculosAccidente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Consecuencia_Vehiculo", referencedColumnName="Id")
     * })
     */
    private $consecuenciaVehiculo;

    /**
     * @var \DireccionVehiculo
     *
     * @ORM\ManyToOne(targetEntity="DireccionVehiculo", inversedBy="vehiculosAccidente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Direccion_Vehiculo", referencedColumnName="Id")
     * })
     */
    private $direccionVehiculo;

    /**
     * @var \ManiobraVehiculo
     *
     * @ORM\ManyToOne(targetEntity="ManiobraVehiculo", inversedBy="vehiculosAccidente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Maniobra_Vehiculo", referencedColumnName="Id")
     * })
     */
    private $maniobraVehiculo;

    /**
     * @var \ServicioVehiculo
     *
     * @ORM\ManyToOne(targetEntity="ServicioVehiculo", inversedBy="vehiculosAccidente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Servicio_Vehiculo", referencedColumnName="Id")
     * })
     */
    private $servicioVehiculo;

    /**
     * @var \Vehiculo
     *
     * @Assert\Valid
     * @ORM\OneToOne(targetEntity="Vehiculo", inversedBy="vehiculoAccidente", cascade={"persist", "remove", "merge"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Vehiculo", referencedColumnName="Id")
     * })
     */
    private $vehiculo;

    /**
     * @var \PasajerosAccidente
     *
     * @ORM\OneToMany(targetEntity="PersonaAccidente", mappedBy="vehiculoAccidente", orphanRemoval=true, cascade={"persist", "remove", "merge"})
     */
    private $pasajerosAccidente;

    /**
     * @var \ConductorAccidente
     *
     * @ORM\OneToMany(targetEntity="PersonaAccidente", mappedBy="vehiculoConducidoAccidente", orphanRemoval=true, cascade={"persist", "remove", "merge"})
     */
    private $conductorAccidente;

    public function __construct()
    {
        $this->pasajerosAccidente = new ArrayCollection();
        $this->conductorAccidente = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVehiculoEsCausanteProbable(): ?bool
    {
        return $this->vehiculoEsCausanteProbable;
    }

    public function setVehiculoEsCausanteProbable(?bool $vehiculoEsCausanteProbable): self
    {
        $this->vehiculoEsCausanteProbable = $vehiculoEsCausanteProbable;

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

    public function getConsecuenciaVehiculo(): ?ConsecuenciaVehiculo
    {
        return $this->consecuenciaVehiculo;
    }

    public function setConsecuenciaVehiculo(?ConsecuenciaVehiculo $consecuenciaVehiculo): self
    {
        $this->consecuenciaVehiculo = $consecuenciaVehiculo;

        return $this;
    }

    public function getDireccionVehiculo(): ?DireccionVehiculo
    {
        return $this->direccionVehiculo;
    }

    public function setDireccionVehiculo(?DireccionVehiculo $direccionVehiculo): self
    {
        $this->direccionVehiculo = $direccionVehiculo;

        return $this;
    }

    public function getManiobraVehiculo(): ?ManiobraVehiculo
    {
        return $this->maniobraVehiculo;
    }

    public function setManiobraVehiculo(?ManiobraVehiculo $maniobraVehiculo): self
    {
        $this->maniobraVehiculo = $maniobraVehiculo;

        return $this;
    }

    public function getServicioVehiculo(): ?ServicioVehiculo
    {
        return $this->servicioVehiculo;
    }

    public function setServicioVehiculo(?ServicioVehiculo $servicioVehiculo): self
    {
        $this->servicioVehiculo = $servicioVehiculo;

        return $this;
    }

    public function getVehiculo(): ?Vehiculo
    {
        return $this->vehiculo;
    }

    public function setVehiculo(?Vehiculo $vehiculo): self
    {
        $this->vehiculo = $vehiculo;

        return $this;
    }

    /**
     * @return Collection|PersonaAccidente[]
     */
    public function getPasajerosAccidente(): Collection
    {
        return $this->pasajerosAccidente;
    }

    public function addPasajerosAccidente(PersonaAccidente $pasajerosAccidente): self
    {
        if (!$this->pasajerosAccidente->contains($pasajerosAccidente)) {
            $this->pasajerosAccidente[] = $pasajerosAccidente;
            $pasajerosAccidente->setVehiculoAccidente($this);
        }

        return $this;
    }

    public function removePasajerosAccidente(PersonaAccidente $pasajerosAccidente): self
    {
        if ($this->pasajerosAccidente->contains($pasajerosAccidente)) {
            $this->pasajerosAccidente->removeElement($pasajerosAccidente);
            // set the owning side to null (unless already changed)
            if ($pasajerosAccidente->getVehiculoAccidente() === $this) {
                $pasajerosAccidente->setVehiculoAccidente(null);
            }
        }

        return $this;
    }

    public function getVehiculoSeFuga(): ?bool
    {
        return $this->vehiculoSeFuga;
    }

    public function setVehiculoSeFuga(?bool $vehiculoSeFuga): self
    {
        $this->vehiculoSeFuga = $vehiculoSeFuga;

        return $this;
    }

    /**
     * @return Collection|PersonaAccidente[]
     */
    public function getConductorAccidente(): Collection
    {
        return $this->conductorAccidente;
    }

    public function addConductorAccidente(PersonaAccidente $conductorAccidente): self
    {
        if (!$this->conductorAccidente->contains($conductorAccidente)) {
            $this->conductorAccidente[] = $conductorAccidente;
            $conductorAccidente->setVehiculoConducidoAccidente($this);
        }

        return $this;
    }

    public function removeConductorAccidente(PersonaAccidente $conductorAccidente): self
    {
        if ($this->conductorAccidente->contains($conductorAccidente)) {
            $this->conductorAccidente->removeElement($conductorAccidente);
            // set the owning side to null (unless already changed)
            if ($conductorAccidente->getVehiculoConducidoAccidente() === $this) {
                $conductorAccidente->setVehiculoConducidoAccidente(null);
            }
        }

        return $this;
    }


}
