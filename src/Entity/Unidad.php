<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Unidad
 *
 * @ORM\Table(name="Unidad", uniqueConstraints={@ORM\UniqueConstraint(name="UQ_Codigo", columns={"Codigo"})}, indexes={@ORM\Index(name="IDX_Unidad_Comuna", columns={"Comuna"}), @ORM\Index(name="IDX_Unidad_Clase_Unidad", columns={"Clase_Unidad"}), @ORM\Index(name="IDX_Unidad_Tipo_Unidad", columns={"Tipo_Unidad"})})
 * @ORM\Entity(repositoryClass="App\Repository\UnidadRepository")
 * @UniqueEntity("codigo")
 */
class Unidad
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
     * @ORM\Column(name="Codigo", type="string", length=255, nullable=false)
     */
    private $codigo;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $habilitada;

    /**
     * @var \ClaseUnidad
     *
     * @ORM\ManyToOne(targetEntity="ClaseUnidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Clase_Unidad", referencedColumnName="Id")
     * })
     */
    private $claseUnidad;

    /**
     * @var \Comuna
     *
     * @ORM\ManyToOne(targetEntity="Comuna", inversedBy="unidades")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Comuna", referencedColumnName="Id")
     * })
     */
    private $comuna;

    /**
     * @var \TipoUnidad
     *
     * @ORM\ManyToOne(targetEntity="TipoUnidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipo_Unidad", referencedColumnName="Id")
     * })
     */
    private $tipoUnidad;

    /**
     * @var \Funcionarios
     *
     * @ORM\OneToMany(targetEntity="Funcionario", mappedBy="unidad")
     */
    private $funcionarios;

    /**
     * @var \Accidentes
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Accidente", mappedBy="unidad")
     */
    private $accidentes;

    public function __construct()
    {
        $this->funcionarios = new ArrayCollection();
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

    public function getCodigo(): ?int
    {
        return $this->codigo;
    }

    public function setCodigo(int $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getInstitucion(): ?string
    {
        return $this->institucion;
    }

    public function setInstitucion(string $institucion): self
    {
        $this->institucion = $institucion;

        return $this;
    }

    public function getClaseUnidad(): ?ClaseUnidad
    {
        return $this->claseUnidad;
    }

    public function setClaseUnidad(?ClaseUnidad $claseUnidad): self
    {
        $this->claseUnidad = $claseUnidad;

        return $this;
    }

    public function getComuna(): ?Comuna
    {
        return $this->comuna;
    }

    public function setComuna(?Comuna $comuna): self
    {
        $this->comuna = $comuna;

        return $this;
    }

    public function getTipoUnidad(): ?TipoUnidad
    {
        return $this->tipoUnidad;
    }

    public function setTipoUnidad(?TipoUnidad $tipoUnidad): self
    {
        $this->tipoUnidad = $tipoUnidad;

        return $this;
    }

    public function getUnidadDominante(): ?self
    {
        return $this->unidadDominante;
    }

    public function setUnidadDominante(?self $unidadDominante): self
    {
        $this->unidadDominante = $unidadDominante;

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
     * @return Collection|Funcionario[]
     */
    public function getFuncionarios(): Collection
    {
        return $this->funcionarios;
    }

    public function addFuncionario(Funcionario $funcionario): self
    {
        if (!$this->funcionarios->contains($funcionario)) {
            $this->funcionarios[] = $funcionario;
            $funcionario->setUnidad($this);
        }

        return $this;
    }

    public function removeFuncionario(Funcionario $funcionario): self
    {
        if ($this->funcionarios->contains($funcionario)) {
            $this->funcionarios->removeElement($funcionario);
            // set the owning side to null (unless already changed)
            if ($funcionario->getUnidad() === $this) {
                $funcionario->setUnidad(null);
            }
        }

        return $this;
    }

    public function getHabilitada(): ?bool
    {
        return $this->habilitada;
    }

    public function setHabilitada(bool $habilitada): self
    {
        $this->habilitada = $habilitada;

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
            $accidente->setUnidad($this);
        }

        return $this;
    }

    public function removeAccidente(Accidente $accidente): self
    {
        if ($this->accidentes->contains($accidente)) {
            $this->accidentes->removeElement($accidente);
            // set the owning side to null (unless already changed)
            if ($accidente->getUnidad() === $this) {
                $accidente->setUnidad(null);
            }
        }

        return $this;
    }

}
