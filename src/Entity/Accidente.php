<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Accidente
 *
 * @ORM\Table(name="Accidente", uniqueConstraints={
 * @ORM\UniqueConstraint(name="UQ_Ubicacion", columns={"Ubicacion"})}, indexes={
 * @ORM\Index(name="IDX_Accidente_Causa_Basal", columns={"Causa_Basal"}),
 * @ORM\Index(name="IDX_Accidente_Clase_Accidente", columns={"Clase_Accidente"}),
 * @ORM\Index(name="IDX_Accidente_Comuna", columns={"Comuna"}),
 * @ORM\Index(name="IDX_Accidente_Condicion_Pavimento_Calzada", columns={"Condicion_Pavimento_Calzada"}),
 * @ORM\Index(name="IDX_Accidente_Cuadrante", columns={"Cuadrante"}),
 * @ORM\Index(name="IDX_Accidente_Estado_Atmosferico", columns={"Estado_Atmosferico"}),
 * @ORM\Index(name="IDX_Accidente_Estado_Accidente", columns={"Estado_Accidente"}),
 * @ORM\Index(name="IDX_Accidente_Estado_Luz_Artificial", columns={"Estado_Luz_Artificial"}),
 * @ORM\Index(name="IDX_Accidente_Estado_Pavimento_Calzada", columns={"Estado_Pavimento_Calzada"}),
 * @ORM\Index(name="IDX_Accidente_Funcionario", columns={"Funcionario"}),
 * @ORM\Index(name="IDX_Accidente_Funcionario_Responsable", columns={"Funcionario_Responsable"}),
 * @ORM\Index(name="IDX_Accidente_Tipo_Calzada", columns={"Tipo_Calzada"}),
 * @ORM\Index(name="IDX_Accidente_Tipo_Accidente", columns={"Tipo_Accidente"}),
 * @ORM\Index(name="IDX_Accidente_Tipo_Direccion", columns={"Tipo_Direccion"}),
 * @ORM\Index(name="IDX_Accidente_Tipo_Luminosidad", columns={"Tipo_Luminosidad"}),
 * @ORM\Index(name="IDX_Accidente_Tipo_Pavimento_Calzada", columns={"Tipo_Pavimento_Calzada"}),
 * @ORM\Index(name="IDX_Accidente_Tipo_Ubicacion_Relativa_Accidente", columns={"Tipo_Ubicacion_Relativa_Accidente"}),
 * @ORM\Index(name="IDX_Accidente_Tipo_Zona_Accidente", columns={"Tipo_Zona_Accidente"}),
 * @ORM\Index(name="IDX_Accidente_Tribunal", columns={"Tribunal"}),
 * @ORM\Index(name="IDX_Accidente_Unidad", columns={"Unidad"}),
 * @ORM\Index(name="IDX_Accidente_Demarcacion_Linea_Calzada", columns={"Demarcacion_Linea_Calzada"}),
 * @ORM\Index(name="IDX_Accidente_Demarcacion_Prioridad_Calzada", columns={"Demarcacion_Prioridad_Calzada"})})
 * @ORM\Entity(repositoryClass="App\Repository\AccidenteRepository")
 */
class Accidente
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
     * @var \Date
     *
     * @ORM\Column(name="Fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var \Time
     *
     * @ORM\Column(name="Hora", type="time", nullable=false)
     */
    private $hora;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Concurre_Siat", type="boolean", nullable=true)
     */
    private $concurreSiat;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Es_Mensaje", type="boolean", nullable=true)
     */
    private $esMensaje;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Cantidad_Fallecidos", type="integer", nullable=true)
     */
    private $cantidadFallecidos;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Cantidad_Pistas_Ida", type="integer", nullable=true)
     */
    private $cantidadPistasIda;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Cantidad_Pistas_Regreso", type="integer", nullable=true)
     */
    private $cantidadPistasRegreso;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Numero_Parte", type="string", length=255, nullable=true)
     */
    private $numeroParte;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Aclaratoria", type="text", nullable=true)
     */
    private $aclaratoria;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Numero_Formulario", type="integer", nullable=true)
     */
    private $numeroFormulario;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="Creado", type="datetime")
     */
    private $creado;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="Actualizado", type="datetime")
     */
    private $actualizado;

    /**
     * @ORM\Column(name="Cerrado", type="datetime", nullable=true)
     */
    private $cerrado;

    /**
     * @var \PeatonesAccidente
     *
     * @ORM\OneToMany(targetEntity="PersonaAccidente", mappedBy="accidente", orphanRemoval=true, cascade={"persist", "remove", "merge"}, fetch="EXTRA_LAZY")
     */
    private $peatonesAccidente;

    /**
     * @var \VehiculosAccidente
     *
     * @Assert\Valid
     * @ORM\OneToMany(targetEntity="VehiculoAccidente", mappedBy="accidente", orphanRemoval=true, cascade={"persist", "remove", "merge"}, fetch="EXTRA_LAZY")
     */
    private $vehiculosAccidente;

    /**
     * @var \Incoherencia
     *
     * @ORM\OneToMany(targetEntity="Incoherencia", mappedBy="accidente", orphanRemoval=true, cascade={"persist", "remove", "merge"}, fetch="EXTRA_LAZY")
     */
    private $incoherencias;

    /**
     * @var \Causa
     *
     * @ORM\ManyToOne(targetEntity="Causa", inversedBy="accidentesBasales")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Causa_Basal", referencedColumnName="Id", nullable=true)
     * })
     */
    private $causaBasal;

    /**
     * @var \ClaseAccidente
     *
     * @ORM\ManyToOne(targetEntity="ClaseAccidente", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Clase_Accidente", referencedColumnName="Id", nullable=true)
     * })
     */
    private $claseAccidente;

    /**
     * @var \Comuna
     *
     * @ORM\ManyToOne(targetEntity="Comuna", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Comuna", referencedColumnName="Id", nullable=true)
     * })
     */
    private $comuna;

    /**
     * @var \CondicionPavimentoCalzada
     *
     * @ORM\ManyToOne(targetEntity="CondicionPavimentoCalzada", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Condicion_Pavimento_Calzada", referencedColumnName="Id", nullable=true)
     * })
     */
    private $condicionPavimentoCalzada;

    /**
     * @var \Cuadrante
     *
     * @ORM\ManyToOne(targetEntity="Cuadrante", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Cuadrante", referencedColumnName="Id", nullable=true)
     * })
     */
    private $cuadrante;

    /**
     * @var \EstadoAccidente
     *
     * @ORM\ManyToOne(targetEntity="EstadoAccidente", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Estado_Accidente", referencedColumnName="Id", nullable=true)
     * })
     */
    private $estadoAccidente;

    /**
     * @var \EstadoAtmosferico
     *
     * @ORM\ManyToOne(targetEntity="EstadoAtmosferico", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Estado_Atmosferico", referencedColumnName="Id", nullable=true)
     * })
     */
    private $estadoAtmosferico;

    /**
     * @var \EstadoLuzArtificial
     *
     * @ORM\ManyToOne(targetEntity="EstadoLuzArtificial", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Estado_Luz_Artificial", referencedColumnName="Id", nullable=true)
     * })
     */
    private $estadoLuzArtificial;

    /**
     * @var \EstadoPavimentoCalzada
     *
     * @ORM\ManyToOne(targetEntity="EstadoPavimentoCalzada", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Estado_Pavimento_Calzada", referencedColumnName="Id", nullable=true)
     * })
     */
    private $estadoPavimentoCalzada;

    /**
     * @var \Funcionario
     *
     * @ORM\ManyToOne(targetEntity="Funcionario", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Funcionario", referencedColumnName="Id", nullable=true)
     * })
     */
    private $funcionario;

    /**
     * @var \Funcionario
     *
     * @ORM\ManyToOne(targetEntity="Funcionario", inversedBy="accidentesResponsable")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Funcionario_Responsable", referencedColumnName="Id", nullable=true)
     * })
     */
    private $funcionarioResponsable;

    /**
     * @var \TipoAccidente
     *
     * @ORM\ManyToOne(targetEntity="TipoAccidente", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipo_Accidente", referencedColumnName="Id", nullable=true)
     * })
     */
    private $tipoAccidente;

    /**
     * @var \TipoDireccion
     *
     * @ORM\ManyToOne(targetEntity="TipoDireccion", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipo_Direccion", referencedColumnName="Id", nullable=true)
     * })
     */
    private $tipoDireccion;

    /**
     * @var \TipoCalzada
     *
     * @ORM\ManyToOne(targetEntity="TipoCalzada", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipo_Calzada", referencedColumnName="Id", nullable=true)
     * })
     */
    private $tipoCalzada;

    /**
     * @var \TipoLuminosidad
     *
     * @ORM\ManyToOne(targetEntity="TipoLuminosidad", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipo_Luminosidad", referencedColumnName="Id", nullable=true)
     * })
     */
    private $tipoLuminosidad;

    /**
     * @var \TipoPavimentoCalzada
     *
     * @ORM\ManyToOne(targetEntity="TipoPavimentoCalzada", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipo_Pavimento_Calzada", referencedColumnName="Id", nullable=true)
     * })
     */
    private $tipoPavimentoCalzada;

    /**
     * @var \TipoUbicacionRelativaAccidente
     *
     * @ORM\ManyToOne(targetEntity="TipoUbicacionRelativaAccidente", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipo_Ubicacion_Relativa_Accidente", referencedColumnName="Id", nullable=true)
     * })
     */
    private $tipoUbicacionRelativaAccidente;

    /**
     * @var \TipoZonaAccidente
     *
     * @ORM\ManyToOne(targetEntity="TipoZonaAccidente", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipo_Zona_Accidente", referencedColumnName="Id", nullable=true)
     * })
     */
    private $tipoZonaAccidente;

    /**
     * @var \Tribunal
     *
     * @ORM\ManyToOne(targetEntity="Tribunal", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tribunal", referencedColumnName="Id", nullable=true)
     * })
     */
    private $tribunal;

    /**
     * @var \Unidad
     *
     * @ORM\ManyToOne(targetEntity="Unidad", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Unidad", referencedColumnName="Id", nullable=true)
     * })
     */
    private $unidad;

    /**
     * @ORM\ManyToOne(targetEntity="DemarcacionLineaCalzada", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Demarcacion_Linea_Calzada", referencedColumnName="Id", nullable=true)
     * })
     */
    private $demarcacionLineaCalzada;

    /**
     * @ORM\ManyToOne(targetEntity="DemarcacionPrioridadCalzada", inversedBy="accidentes")
     * @ORM\OrderBy({"codigo" = "ASC"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Demarcacion_Prioridad_Calzada", referencedColumnName="Id", nullable=true)
     * })
     */
    private $demarcacionPrioridadCalzada;

    /**
     * @ORM\ManyToMany(targetEntity="ElementoCalzada", inversedBy="accidentes", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(
     *   name="Elemento_Calzada_Accidente",
     *   joinColumns={@ORM\JoinColumn(name="Accidente", referencedColumnName="Id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="Elemento_Calzada", referencedColumnName="Id")}
     * )
     */
    private $elementosCalzada;

    /**
     * @var \Causas
     *
     * @ORM\ManyToMany(targetEntity="Causa", inversedBy="accidentes", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(
     *   name="Causa_Accidente",
     *   joinColumns={@ORM\JoinColumn(name="Accidente", referencedColumnName="Id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="Causa", referencedColumnName="Id")}
     * )
     */
    private $causas;

    /**
     * @var \RegistroEtapas
     *
     * @ORM\ManyToMany(targetEntity="RegistroEtapa", inversedBy="accidentes", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(
     *   name="Registro_Etapa_Accidente",
     *   joinColumns={@ORM\JoinColumn(name="Accidente", referencedColumnName="Id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="Registro_Etapa", referencedColumnName="Id")}
     * )
     */
    private $registroEtapas;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\UbicacionAccidente", inversedBy="accidente", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Ubicacion", referencedColumnName="Id", nullable=true)
     * })
     */
    private $ubicacion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCantidadPistasIda(): ?int
    {
        return $this->cantidadPistasIda;
    }

    public function setCantidadPistasIda(?int $cantidadPistasIda): self
    {
        $this->cantidadPistasIda = $cantidadPistasIda;

        return $this;
    }

    public function getCantidadPistasRegreso(): ?int
    {
        return $this->cantidadPistasRegreso;
    }

    public function setCantidadPistasRegreso(?int $cantidadPistasRegreso): self
    {
        $this->cantidadPistasRegreso = $cantidadPistasRegreso;

        return $this;
    }

    public function getNumeroParte(): ?int
    {
        return $this->numeroParte;
    }

    public function setNumeroParte(?int $numeroParte): self
    {
        $this->numeroParte = $numeroParte;

        return $this;
    }

    public function getAclaratoria(): ?string
    {
        return $this->aclaratoria;
    }

    public function setAclaratoria(?string $aclaratoria): self
    {
        $this->aclaratoria = $aclaratoria;

        return $this;
    }

    public function getNumeroFormulario(): ?int
    {
        return $this->numeroFormulario;
    }

    public function setNumeroFormulario(?int $numeroFormulario): self
    {
        $this->numeroFormulario = $numeroFormulario;

        return $this;
    }

    public function getCausaBasal(): ?Causa
    {
        return $this->causaBasal;
    }

    public function setCausaBasal(?Causa $causaBasal): self
    {
        $this->causaBasal = $causaBasal;

        return $this;
    }

    public function getTipoCausa(): ?TipoCausa
    {
        return $this->getCausaBasal() ? $this->getCausaBasal()->getTipoCausa() : NULL;
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

    public function getComuna(): ?Comuna
    {
        return $this->comuna;
    }

    public function getProvincia(): ?Provincia
    {
        if ($this->getComuna()) {
            return $this->getComuna()->getProvincia();
        } else {
            return null;
        }
    }

    public function getRegion(): ?Region
    {
        if ($this->getProvincia()) {
            return $this->getProvincia()->getRegion();
        } else {
            return null;
        }
    }

    public function setComuna(?Comuna $comuna): self
    {
        $this->comuna = $comuna;

        return $this;
    }

    public function getCondicionPavimentoCalzada(): ?CondicionPavimentoCalzada
    {
        return $this->condicionPavimentoCalzada;
    }

    public function setCondicionPavimentoCalzada(?CondicionPavimentoCalzada $condicionPavimentoCalzada): self
    {
        $this->condicionPavimentoCalzada = $condicionPavimentoCalzada;

        return $this;
    }

    public function getCuadrante(): ?Cuadrante
    {
        return $this->cuadrante;
    }

    public function setCuadrante(?Cuadrante $cuadrante): self
    {
        $this->cuadrante = $cuadrante;

        return $this;
    }

    public function getEstadoAtmosferico(): ?EstadoAtmosferico
    {
        return $this->estadoAtmosferico;
    }

    public function setEstadoAtmosferico(?EstadoAtmosferico $estadoAtmosferico): self
    {
        $this->estadoAtmosferico = $estadoAtmosferico;

        return $this;
    }

    public function getEstadoLuzArtificial(): ?EstadoLuzArtificial
    {
        return $this->estadoLuzArtificial;
    }

    public function setEstadoLuzArtificial(?EstadoLuzArtificial $estadoLuzArtificial): self
    {
        $this->estadoLuzArtificial = $estadoLuzArtificial;

        return $this;
    }

    public function getEstadoPavimentoCalzada(): ?EstadoPavimentoCalzada
    {
        return $this->estadoPavimentoCalzada;
    }

    public function setEstadoPavimentoCalzada(?EstadoPavimentoCalzada $estadoPavimentoCalzada): self
    {
        $this->estadoPavimentoCalzada = $estadoPavimentoCalzada;

        return $this;
    }

    public function getFuncionario(): ?Funcionario
    {
        return $this->funcionario;
    }

    public function setFuncionario(?Funcionario $funcionario): self
    {
        $this->funcionario = $funcionario;

        return $this;
    }

    public function getFuncionarioResponsable(): ?Funcionario
    {
        return $this->funcionarioResponsable;
    }

    public function setFuncionarioResponsable(?Funcionario $funcionarioResponsable): self
    {
        $this->funcionarioResponsable = $funcionarioResponsable;

        return $this;
    }

    public function getTipoAccidente(): ?TipoAccidente
    {
        return $this->tipoAccidente;
    }

    public function setTipoAccidente(?TipoAccidente $tipoAccidente): self
    {
        $this->tipoAccidente = $tipoAccidente;

        return $this;
    }

    public function getTipoDireccion(): ?TipoDireccion
    {
        return $this->tipoDireccion;
    }

    public function setTipoDireccion(?TipoDireccion $tipoDireccion): self
    {
        $this->tipoDireccion = $tipoDireccion;

        return $this;
    }

    public function getTipoLuminosidad(): ?TipoLuminosidad
    {
        return $this->tipoLuminosidad;
    }

    public function setTipoLuminosidad(?TipoLuminosidad $tipoLuminosidad): self
    {
        $this->tipoLuminosidad = $tipoLuminosidad;

        return $this;
    }

    public function getTipoPavimentoCalzada(): ?TipoPavimentoCalzada
    {
        return $this->tipoPavimentoCalzada;
    }

    public function setTipoPavimentoCalzada(?TipoPavimentoCalzada $tipoPavimentoCalzada): self
    {
        $this->tipoPavimentoCalzada = $tipoPavimentoCalzada;

        return $this;
    }

    public function getTipoUbicacionRelativaAccidente(): ?TipoUbicacionRelativaAccidente
    {
        return $this->tipoUbicacionRelativaAccidente;
    }

    public function setTipoUbicacionRelativaAccidente(?TipoUbicacionRelativaAccidente $tipoUbicacionRelativaAccidente): self
    {
        $this->tipoUbicacionRelativaAccidente = $tipoUbicacionRelativaAccidente;

        return $this;
    }

    public function getTipoZonaAccidente(): ?TipoZonaAccidente
    {
        return $this->tipoZonaAccidente;
    }

    public function setTipoZonaAccidente(?TipoZonaAccidente $tipoZonaAccidente): self
    {
        $this->tipoZonaAccidente = $tipoZonaAccidente;

        return $this;
    }

    public function getTribunal(): ?Tribunal
    {
        return $this->tribunal;
    }

    public function setTribunal(?Tribunal $tribunal): self
    {
        $this->tribunal = $tribunal;

        return $this;
    }

    public function getUnidad(): ?Unidad
    {
        return $this->unidad;
    }

    public function setUnidad(?Unidad $unidad): self
    {
        $this->unidad = $unidad;

        return $this;
    }

    public function __construct() {
        $this->causas = new ArrayCollection();
        $this->peatonesAccidente = new ArrayCollection();
        $this->vehiculosAccidente = new ArrayCollection();
        $this->registroEtapas = new ArrayCollection();
        $this->elementosCalzada = new ArrayCollection();
        $this->incoherencias = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getId();
    }

    /**
     * @return Collection|Causa[]
     */
    public function getCausas(): Collection
    {
        return $this->causas;
    }

    public function addCausa(Causa $causa): self
    {
        if (!$this->causas->contains($causa)) {
            $this->causas[] = $causa;
        }

        return $this;
    }

    public function removeCausa(Causa $causa): self
    {
        if ($this->causas->contains($causa)) {
            $this->causas->removeElement($causa);
        }

        return $this;
    }

    /**
     * @return Collection|PersonaAccidente[]
     */
    public function getPeatonesAccidente(): Collection
    {
        return $this->peatonesAccidente;
    }

    public function addPeatonesAccidente(PersonaAccidente $peatonesAccidente): self
    {
        if (!$this->peatonesAccidente->contains($peatonesAccidente)) {
            $this->peatonesAccidente[] = $peatonesAccidente;
            $peatonesAccidente->setAccidente($this);
        }

        return $this;
    }

    public function removePeatonesAccidente(PersonaAccidente $peatonesAccidente): self
    {
        if ($this->peatonesAccidente->contains($peatonesAccidente)) {
            $this->peatonesAccidente->removeElement($peatonesAccidente);
            // set the owning side to null (unless already changed)
            if ($peatonesAccidente->getAccidente() === $this) {
                $peatonesAccidente->setAccidente(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|VehiculoAccidente[]
     */
    public function getVehiculosAccidente(): Collection
    {
        return $this->vehiculosAccidente;
    }

    public function addVehiculosAccidente(VehiculoAccidente $vehiculoAccidente): self
    {
        if (!$this->vehiculosAccidente->contains($vehiculoAccidente)) {
            $this->vehiculosAccidente[] = $vehiculoAccidente;
            $vehiculoAccidente->setAccidente($this);
        }

        return $this;
    }

    public function removeVehiculosAccidente(VehiculoAccidente $vehiculosAccidente): self
    {
        if ($this->vehiculosAccidente->contains($vehiculosAccidente)) {
            $this->vehiculosAccidente->removeElement($vehiculosAccidente);
            // set the owning side to null (unless already changed)
            if ($vehiculosAccidente->getAccidente() === $this) {
                $vehiculosAccidente->setAccidente(null);
            }
        }

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getHora(): ?\DateTimeInterface
    {
        return $this->hora;
    }

    public function setHora(\DateTimeInterface $hora): self
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * @return Collection|RegistroEtapa[]
     */
    public function getRegistroEtapas(): Collection
    {
        return $this->registroEtapas;
    }

    public function addRegistroEtapa(RegistroEtapa $registroEtapa): self
    {
        if (!$this->registroEtapas->contains($registroEtapa)) {
            $this->registroEtapas[] = $registroEtapa;
        }

        return $this;
    }

    public function removeRegistroEtapa(RegistroEtapa $registroEtapa): self
    {
        if ($this->registroEtapas->contains($registroEtapa)) {
            $this->registroEtapas->removeElement($registroEtapa);
        }

        return $this;
    }

    public function getConcurreSiat(): ?bool
    {
        return $this->concurreSiat;
    }

    public function setConcurreSiat(?bool $concurreSiat): self
    {
        $this->concurreSiat = $concurreSiat;

        return $this;
    }

    public function getDemarcacionLineaCalzada(): ?DemarcacionLineaCalzada
    {
        return $this->demarcacionLineaCalzada;
    }

    public function setDemarcacionLineaCalzada(?DemarcacionLineaCalzada $demarcacionLineaCalzada): self
    {
        $this->demarcacionLineaCalzada = $demarcacionLineaCalzada;

        return $this;
    }

    public function getDemarcacionPrioridadCalzada(): ?DemarcacionPrioridadCalzada
    {
        return $this->demarcacionPrioridadCalzada;
    }

    public function setDemarcacionPrioridadCalzada(?DemarcacionPrioridadCalzada $demarcacionPrioridadCalzada): self
    {
        $this->demarcacionPrioridadCalzada = $demarcacionPrioridadCalzada;

        return $this;
    }

    /**
     * @return Collection|ElementoCalzada[]
     */
    public function getElementosCalzada(): Collection
    {
        return $this->elementosCalzada;
    }

    public function getElementosCalzadaToString(): ?string
    {
        $array = array();
        foreach ($this->elementosCalzada as $elementoCalzada) {
            $array[] = $elementoCalzada->getNombre();
        }
        return implode(', ', $array);
    }

    public function addElementosCalzada(ElementoCalzada $elementosCalzada): self
    {
        if (!$this->elementosCalzada->contains($elementosCalzada)) {
            $this->elementosCalzada[] = $elementosCalzada;
        }

        return $this;
    }

    public function removeElementosCalzada(ElementoCalzada $elementosCalzada): self
    {
        if ($this->elementosCalzada->contains($elementosCalzada)) {
            $this->elementosCalzada->removeElement($elementosCalzada);
        }

        return $this;
    }

    public function getCreado(): ?\DateTimeInterface
    {
        return $this->creado;
    }

    public function setCreado(\DateTimeInterface $creado): self
    {
        $this->creado = $creado;

        return $this;
    }

    public function getActualizado(): ?\DateTimeInterface
    {
        return $this->actualizado;
    }

    public function setActualizado(\DateTimeInterface $actualizado): self
    {
        $this->actualizado = $actualizado;

        return $this;
    }

    /**
     * @return Collection|Incoherencia[]
     */
    public function getIncoherencias(): Collection
    {
        return $this->incoherencias;
    }

    public function addIncoherencia(Incoherencia $incoherencia): self
    {
        if (!$this->incoherencias->contains($incoherencia)) {
            $this->incoherencias[] = $incoherencia;
            $incoherencia->setAccidente($this);
        }

        return $this;
    }

    public function removeIncoherencia(Incoherencia $incoherencia): self
    {
        if ($this->incoherencias->contains($incoherencia)) {
            $this->incoherencias->removeElement($incoherencia);
            // set the owning side to null (unless already changed)
            if ($incoherencia->getAccidente() === $this) {
                $incoherencia->setAccidente(null);
            }
        }

        return $this;
    }

    private function eliminarIncoherencias(): void
    {
        // Eliminar todas las incoherencias para comprobarlas nuevamente
        foreach ($this->getIncoherencias() as $incoherencia) {
            $this->removeIncoherencia($incoherencia);
        }
    }

    private function verificarAtropello(): void
    {
        // Incoherencia de atropello: Debe tener al menos un peaton
        if ($this->getTipoAccidente() && in_array($this->getTipoAccidente()->getCodigo(), ['10'])) {
            if ($this->getPeatonesAccidente()->count() < 1) {
                $this->addIncoherencia(new Incoherencia($this, 'Un atropello debe tener registrado al menos un peatón'));
            }
        }
    }

    private function verificarColision(): void
    {
        // Incoherencia de colisión: Debe tener al menos dos vehiculos
        if ($this->getTipoAccidente() && in_array($this->getTipoAccidente()->getCodigo(), ['30', '31', '32', '33', '34'])) {
            if ($this->getVehiculosAccidente()->count() < 2) {
                $this->addIncoherencia(new Incoherencia($this, 'Una colisión debe tener registrado al menos dos vehículos'));
            }
        }
    }

    private function verificarCalzada(): void
    {
        // Incoherencia de calzada: Una calzada debe ser coherente con el numero de pistas
        if ($this->getTipoCalzada() && in_array($this->getTipoCalzada()->getCodigo(), ['01'])) {
            if ($this->getCantidadPistasRegreso() > 0) {
                $this->addIncoherencia(new Incoherencia($this, 'Una calzada unidireccional no puede tener pistas de regreso'));
            }
        }

        // Incoherencia de calzada: Una calzada debe ser coherente con el numero de pistas
        if ($this->getTipoCalzada() && in_array($this->getTipoCalzada()->getCodigo(), ['02', '03'])) {
            if ($this->getCantidadPistasRegreso() == 0) {
                $this->addIncoherencia(new Incoherencia($this, 'Una calzada bidireccional debe tener al menos una pista de regreso'));
            }
        }
    }

    private function verificarFallecidos(): void
    {
        if($this->getCantidadFallecidos() != $this->getFallecidosAccidente()->count()) {
            if($this->getEsMensaje()){
                $this->addIncoherencia(new Incoherencia($this, 'La candidad de fallecidos no coincide con el mensaje'));
            } else {
                $this->addIncoherencia(new Incoherencia($this, 'Accidente con fallecidos: El registro requiere un mensaje adjunto para ser válido'));
            }
        }
    }

    private function verificarPersonas(): void
    {
        foreach ($this->getVehiculosAccidente() as $k => $vehiculo) {
            foreach ($vehiculo->getPasajerosAccidente() as $j => $pasajero) {
                if ($pasajero->getPersona()->estaVacio()) {
                    $this->addIncoherencia(new Incoherencia($this, 'Los datos personales de un pasajero están totalmente en blanco'));
                }
            }
            foreach ($vehiculo->getConductorAccidente() as $j => $conductor) {
                if ($conductor->getPersona()->estaVacio()) {
                    $this->addIncoherencia(new Incoherencia($this, 'Los datos personales de un conductor están totalmente en blanco'));
                }
            }
        }
        foreach ($this->getPeatonesAccidente() as $peaton) {
            if ($peaton->getPersona()->estaVacio()) {
                $this->addIncoherencia(new Incoherencia($this, 'Los datos personales de un peatón están totalmente en blanco'));
            }
        }
    }

    public function comprobarIncoherencia(): self
    {
        $this->eliminarIncoherencias();
        $this->verificarAtropello();
        $this->verificarColision();
        $this->verificarCalzada();
        $this->verificarPersonas();
        $this->verificarFallecidos();

        return $this;
    }

    public function getConductoresAccidente(): ArrayCollection
    {
        $conductoresAccidente = new ArrayCollection();

        foreach ($this->getVehiculosAccidente() as $vehiculo) {
            foreach ($vehiculo->getConductorAccidente() as $conductor) {
                $conductoresAccidente->add($conductor);
            }
        }

        return $conductoresAccidente;
    }

    public function getPasajerosAccidente(): ArrayCollection
    {
        $pasajerosAccidente = new ArrayCollection();

        foreach ($this->getVehiculosAccidente() as $vehiculo) {
            foreach ($vehiculo->getPasajerosAccidente() as $pasajero) {
                $pasajerosAccidente->add($pasajero);
            }
        }

        return $pasajerosAccidente;
    }

    public function getPersonasAccidente(): ArrayCollection
    {
        $personasAccidente = new ArrayCollection();

        foreach ($this->getPasajerosAccidente() as $pasajero) {
            $personasAccidente->add($pasajero);
        }

        foreach ($this->getConductoresAccidente() as $conductor) {
            $personasAccidente->add($conductor);
        }

        foreach ($this->getPeatonesAccidente() as $peaton) {
            $personasAccidente->add($peaton);
        }

        return $personasAccidente;
    }

    public function getFallecidosAccidente(): ArrayCollection
    {
        $fallecidosAccidente = new ArrayCollection();

        foreach ($this->getPersonasAccidente() as $persona) {
            if ($persona->getConsecuenciaPersona() && in_array($persona->getConsecuenciaPersona()->getCodigo(), ['01'])) {
                $fallecidosAccidente->add($persona);
            }
        }

        return $fallecidosAccidente;
    }

    public function getGravesAccidente(): ArrayCollection
    {
        $gravesAccidente = new ArrayCollection();

        foreach ($this->getPersonasAccidente() as $persona) {
            if ($persona->getConsecuenciaPersona() && in_array($persona->getConsecuenciaPersona()->getCodigo(), ['02'])) {
                $gravesAccidente->add($persona);
            }
        }

        return $gravesAccidente;
    }

    public function getMenosGravesAccidente(): ArrayCollection
    {
        $menosGravesAccidente = new ArrayCollection();

        foreach ($this->getPersonasAccidente() as $persona) {
            if ($persona->getConsecuenciaPersona() && in_array($persona->getConsecuenciaPersona()->getCodigo(), ['03'])) {
                $menosGravesAccidente->add($persona);
            }
        }

        return $menosGravesAccidente;
    }

    public function getLevesAccidente(): ArrayCollection
    {
        $levesAccidente = new ArrayCollection();

        foreach ($this->getPersonasAccidente() as $persona) {
            if ($persona->getConsecuenciaPersona() && in_array($persona->getConsecuenciaPersona()->getCodigo(), ['04'])) {
                $levesAccidente->add($persona);
            }
        }

        return $levesAccidente;
    }

    public function getIlesosAccidente(): ArrayCollection
    {
        $ilesosAccidente = new ArrayCollection();

        foreach ($this->getPersonasAccidente() as $persona) {
            if ($persona->getConsecuenciaPersona() && in_array($persona->getConsecuenciaPersona()->getCodigo(), ['05'])) {
                $ilesosAccidente->add($persona);
            }
        }

        return $ilesosAccidente;
    }

    public function getSeIgnoraAccidente(): ArrayCollection
    {
        $seIgnoraAccidente = new ArrayCollection();

        foreach ($this->getPersonasAccidente() as $persona) {
            if ($persona->getConsecuenciaPersona() && in_array($persona->getConsecuenciaPersona()->getCodigo(), ['99'])) {
                $seIgnoraAccidente->add($persona);
            }
        }

        return $seIgnoraAccidente;
    }

    public function getTipoCalzada(): ?TipoCalzada
    {
        return $this->tipoCalzada;
    }

    public function setTipoCalzada(?TipoCalzada $tipoCalzada): self
    {
        $this->tipoCalzada = $tipoCalzada;

        return $this;
    }

    public function getEsMensaje(): ?bool
    {
        return $this->esMensaje;
    }

    public function setEsMensaje(bool $esMensaje): self
    {
        $this->esMensaje = $esMensaje;

        return $this;
    }

    public function getCantidadFallecidos(): ?int
    {
        return $this->cantidadFallecidos;
    }

    public function setCantidadFallecidos(?int $cantidadFallecidos): self
    {
        $this->cantidadFallecidos = $cantidadFallecidos;

        return $this;
    }

    public function getEstadoAccidente(): ?EstadoAccidente
    {
        return $this->estadoAccidente;
    }

    public function setEstadoAccidente(?EstadoAccidente $estadoAccidente): self
    {
        $this->estadoAccidente = $estadoAccidente;

        return $this;
    }

    public function getCerrado(): ?\DateTimeInterface
    {
        return $this->cerrado;
    }

    public function setCerrado(\DateTimeInterface $cerrado): self
    {
        $this->cerrado = $cerrado;

        return $this;
    }

    public function getUbicacion(): ?UbicacionAccidente
    {
        return $this->ubicacion;
    }

    public function setUbicacion(UbicacionAccidente $ubicacion): self
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

}
