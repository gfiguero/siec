<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Comuna
 *
 * @ORM\Table(name="Comuna", uniqueConstraints={@ORM\UniqueConstraint(name="UQ_Comuna_Codigo", columns={"Codigo"})}, indexes={@ORM\Index(name="IDX_Comuna_Provincia", columns={"Provincia"})})
 * @ORM\Entity(repositoryClass="App\Repository\ComunaRepository")
 * @UniqueEntity("codigo")
 */
class Comuna
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
     * @var \Provincia
     *
     * @ORM\ManyToOne(targetEntity="Provincia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Provincia", referencedColumnName="Id")
     * })
     */
    private $provincia;

    /**
     * @var \Cuadrantes
     *
     * @ORM\OneToMany(targetEntity="Cuadrante", mappedBy="comuna")
     * @ORM\OrderBy({"codigo" = "ASC"})
     */
    private $cuadrantes;

    /**
     * @var \Unidades
     *
     * @ORM\OneToMany(targetEntity="Unidad", mappedBy="comuna")
     * @ORM\OrderBy({"codigo" = "ASC"})
     */
    private $unidades;

    /**
     * @var \Accidentes
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Accidente", mappedBy="comuna")
     */
    private $accidentes;

    public function __construct()
    {
        $this->cuadrantes = new ArrayCollection();
        $this->unidades = new ArrayCollection();
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

    public function getProvincia(): ?Provincia
    {
        return $this->provincia;
    }

    public function setProvincia(?Provincia $provincia): self
    {
        $this->provincia = $provincia;

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
     * @return Collection|Cuadrante[]
     */
    public function getCuadrantes(): Collection
    {
        return $this->cuadrantes;
    }

    public function addCuadrante(Cuadrante $cuadrante): self
    {
        if (!$this->cuadrantes->contains($cuadrante)) {
            $this->cuadrantes[] = $cuadrante;
            $cuadrante->setComuna($this);
        }

        return $this;
    }

    public function removeCuadrante(Cuadrante $cuadrante): self
    {
        if ($this->cuadrantes->contains($cuadrante)) {
            $this->cuadrantes->removeElement($cuadrante);
            // set the owning side to null (unless already changed)
            if ($cuadrante->getComuna() === $this) {
                $cuadrante->setComuna(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Unidad[]
     */
    public function getUnidades(): Collection
    {
        return $this->unidades;
    }

    public function addUnidade(Unidad $unidade): self
    {
        if (!$this->unidades->contains($unidade)) {
            $this->unidades[] = $unidade;
            $unidade->setComuna($this);
        }

        return $this;
    }

    public function removeUnidade(Unidad $unidade): self
    {
        if ($this->unidades->contains($unidade)) {
            $this->unidades->removeElement($unidade);
            // set the owning side to null (unless already changed)
            if ($unidade->getComuna() === $this) {
                $unidade->setComuna(null);
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
            $accidente->setComuna($this);
        }

        return $this;
    }

    public function removeAccidente(Accidente $accidente): self
    {
        if ($this->accidentes->contains($accidente)) {
            $this->accidentes->removeElement($accidente);
            // set the owning side to null (unless already changed)
            if ($accidente->getComuna() === $this) {
                $accidente->setComuna(null);
            }
        }

        return $this;
    }


}
