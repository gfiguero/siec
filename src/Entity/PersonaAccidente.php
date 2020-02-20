<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PersonaAccidente
 *
 * @ORM\Table(name="Persona_Accidente", indexes={
 * @ORM\Index(name="IDX_Persona_Accidente_Vehiculo_Accidente", columns={"Vehiculo_Accidente"}),
 * @ORM\Index(name="IDX_Persona_Accidente_Vehiculo_Conducido_Accidente", columns={"Vehiculo_Conducido_Accidente"}),
 * @ORM\Index(name="IDX_Persona_Accidente_Consecuencia_Persona", columns={"Consecuencia_Persona"}),
 * @ORM\Index(name="IDX_Persona_Accidente_Comuna_Licencia", columns={"Comuna_Licencia"}),
 * @ORM\Index(name="IDX_Persona_Accidente_Condicion_Fisica", columns={"Condicion_Fisica"}),
 * @ORM\Index(name="IDX_Persona_Accidente_Accidente", columns={"Accidente"}),
 * @ORM\Index(name="IDX_Persona_Accidente_Persona", columns={"Persona"}),
 * @ORM\Index(name="IDX_Persona_Accidente_Clase_Licencia", columns={"Clase_Licencia"}),
 * @ORM\Index(name="IDX_Persona_Accidente_Tipo_Trayecto", columns={"Tipo_Trayecto"}),
 * @ORM\Index(name="IDX_Persona_Accidente_Cualidad_Especial", columns={"Cualidad_Especial"})})
 * @ORM\Entity(repositoryClass="App\Repository\PersonaAccidenteRepository")
 */
class PersonaAccidente
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
     * @ORM\Column(name="Persona_Es_Causante_Probable", type="boolean", nullable=true)
     */
    private $personaEsCausanteProbable;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Persona_Se_Fuga", type="boolean", nullable=true)
     */
    private $personaSeFuga;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Persona_Es_Conductor", type="boolean", nullable=true)
     */
    private $personaEsConductor;

    /**
     * @var \Accidente
     *
     * @ORM\ManyToOne(targetEntity="Accidente", inversedBy="peatonesAccidente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Accidente", referencedColumnName="Id")
     * })
     */
    private $accidente;

    /**
     * @var \ClaseLicencia
     *
     * @ORM\ManyToOne(targetEntity="ClaseLicencia", inversedBy="personasAccidente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Clase_Licencia", referencedColumnName="Id")
     * })
     */
    private $claseLicencia;

    /**
     * @var \Comuna
     *
     * @ORM\ManyToOne(targetEntity="Comuna")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Comuna_Licencia", referencedColumnName="Id")
     * })
     */
    private $comunaLicencia;

    /**
     * @var \CondicionFisica
     *
     * @ORM\ManyToOne(targetEntity="CondicionFisica", inversedBy="personasAccidente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Condicion_Fisica", referencedColumnName="Id")
     * })
     */
    private $condicionFisica;

    /**
     * @var \ConsecuenciaPersona
     *
     * @ORM\ManyToOne(targetEntity="ConsecuenciaPersona", inversedBy="personasAccidente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Consecuencia_Persona", referencedColumnName="Id")
     * })
     */
    private $consecuenciaPersona;

    /**
     * @var \CualidadEspecial
     *
     * @ORM\ManyToOne(targetEntity="CualidadEspecial", inversedBy="personasAccidente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Cualidad_Especial", referencedColumnName="Id")
     * })
     */
    private $cualidadEspecial;

    /**
     * @var \TipoTrayecto
     *
     * @ORM\ManyToOne(targetEntity="TipoTrayecto", inversedBy="personasAccidente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipo_Trayecto", referencedColumnName="Id")
     * })
     */
    private $tipoTrayecto;

    /**
     * @var \VehiculoAccidente
     *
     * @ORM\ManyToOne(targetEntity="VehiculoAccidente", inversedBy="pasajerosAccidente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Vehiculo_Accidente", referencedColumnName="Id")
     * })
     */
    private $vehiculoAccidente;

    /**
     * @var \VehiculoConducidoAccidente
     *
     * @ORM\ManyToOne(targetEntity="VehiculoAccidente", inversedBy="conductorAccidente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Vehiculo_Conducido_Accidente", referencedColumnName="Id")
     * })
     */
    private $vehiculoConducidoAccidente;

    /**
     * @var \Persona
     *
     * @ORM\OneToOne(targetEntity="Persona", inversedBy="personaAccidente", cascade={"persist", "remove", "merge"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Persona", referencedColumnName="Id")
     * })
     */
    private $persona;

    /**
     * @var \Seguridad
     *
     * @ORM\ManyToMany(targetEntity="SeguridadPersona", inversedBy="personaAccidentes", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(
     *   name="Seguridad_Persona_Accidente",
     *   joinColumns={@ORM\JoinColumn(name="PersonaAccidente", referencedColumnName="Id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="SeguridadPersona", referencedColumnName="Id")}
     * )
     */
    private $seguridad;

    public function __construct()
    {
        $this->seguridad = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getId();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonaEsCausanteProbable(): ?bool
    {
        return $this->personaEsCausanteProbable;
    }

    public function setPersonaEsCausanteProbable(?bool $personaEsCausanteProbable): self
    {
        $this->personaEsCausanteProbable = $personaEsCausanteProbable;

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

    public function getClaseLicencia(): ?ClaseLicencia
    {
        return $this->claseLicencia;
    }

    public function setClaseLicencia(?ClaseLicencia $claseLicencia): self
    {
        $this->claseLicencia = $claseLicencia;

        return $this;
    }

    public function getComunaLicencia(): ?Comuna
    {
        return $this->comunaLicencia;
    }

    public function setComunaLicencia(?Comuna $comunaLicencia): self
    {
        $this->comunaLicencia = $comunaLicencia;

        return $this;
    }

    public function getCondicionFisica(): ?CondicionFisica
    {
        return $this->condicionFisica;
    }

    public function setCondicionFisica(?CondicionFisica $condicionFisica): self
    {
        $this->condicionFisica = $condicionFisica;

        return $this;
    }

    public function getConsecuenciaPersona(): ?ConsecuenciaPersona
    {
        return $this->consecuenciaPersona;
    }

    public function setConsecuenciaPersona(?ConsecuenciaPersona $consecuenciaPersona): self
    {
        $this->consecuenciaPersona = $consecuenciaPersona;

        return $this;
    }

    public function getCualidadEspecial(): ?CualidadEspecial
    {
        return $this->cualidadEspecial;
    }

    public function setCualidadEspecial(?CualidadEspecial $cualidadEspecial): self
    {
        $this->cualidadEspecial = $cualidadEspecial;

        return $this;
    }

    public function getPersona(): ?Persona
    {
        return $this->persona;
    }

    public function setPersona(?Persona $persona): self
    {
        $this->persona = $persona;

        return $this;
    }

    public function getTipoTrayecto(): ?TipoTrayecto
    {
        return $this->tipoTrayecto;
    }

    public function setTipoTrayecto(?TipoTrayecto $tipoTrayecto): self
    {
        $this->tipoTrayecto = $tipoTrayecto;

        return $this;
    }

    public function getVehiculoAccidente(): ?VehiculoAccidente
    {
        return $this->vehiculoAccidente;
    }

    public function setVehiculoAccidente(?VehiculoAccidente $vehiculoAccidente): self
    {
        $this->vehiculoAccidente = $vehiculoAccidente;

        return $this;
    }

    public function getPersonaEsConductor(): ?bool
    {
        return $this->personaEsConductor;
    }

    public function setPersonaEsConductor(?bool $personaEsConductor): self
    {
        $this->personaEsConductor = $personaEsConductor;

        return $this;
    }

    public function getPersonaSeFuga(): ?bool
    {
        return $this->personaSeFuga;
    }

    public function setPersonaSeFuga(?bool $personaSeFuga): self
    {
        $this->personaSeFuga = $personaSeFuga;

        return $this;
    }

    /**
     * @return Collection|SeguridadPersona[]
     */
    public function getSeguridad(): Collection
    {
        return $this->seguridad;
    }

    public function getSeguridadToString(): ?string
    {
        $array = array();
        foreach ($this->seguridad as $seguridad) {
            $array[] = $seguridad->getNombre();
        }
        return implode(', ', $array);
    }

    public function addSeguridad(SeguridadPersona $seguridad): self
    {
        if (!$this->seguridad->contains($seguridad)) {
            $this->seguridad[] = $seguridad;
        }

        return $this;
    }

    public function removeSeguridad(SeguridadPersona $seguridad): self
    {
        if ($this->seguridad->contains($seguridad)) {
            $this->seguridad->removeElement($seguridad);
        }

        return $this;
    }

    public function getVehiculoConducidoAccidente(): ?VehiculoAccidente
    {
        return $this->vehiculoConducidoAccidente;
    }

    public function setVehiculoConducidoAccidente(?VehiculoAccidente $vehiculoConducidoAccidente): self
    {
        $this->vehiculoConducidoAccidente = $vehiculoConducidoAccidente;

        return $this;
    }

    public function getCalidadPersonaAccidente(): ?string
    {
        if ($this->getAccidente()) return 'Peatón';

        if ($this->getVehiculoAccidente()) return 'Pasajero';

        if ($this->getVehiculoConducidoAccidente()) return 'Conductor';
    }

    public function getParticipacionPersonaAccidente(): ?Accidente
    {
        if ($this->getAccidente()) return $this->getAccidente();

        if ($this->getVehiculoAccidente()) return $this->getVehiculoAccidente()->getAccidente();

        if ($this->getVehiculoConducidoAccidente()) return $this->getVehiculoConducidoAccidente()->getAccidente();

        return NULL;
    }

    public function getParticipacionPersonaVehiculoAccidente(): ?VehiculoAccidente
    {
        if ($this->getVehiculoAccidente()) return $this->getVehiculoAccidente();

        if ($this->getVehiculoConducidoAccidente()) return $this->getVehiculoConducidoAccidente();

        return NULL;
    }

}
