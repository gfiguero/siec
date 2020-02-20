<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Causa
 *
 * @ORM\Table(name="Causa", uniqueConstraints={@ORM\UniqueConstraint(name="UQ_Causa_Codigo", columns={"Codigo"})}, indexes={@ORM\Index(name="IDX_Causa_Tipo_Causa", columns={"Tipo_Causa"})})
 * @ORM\Entity(repositoryClass="App\Repository\CausaRepository")
 * @UniqueEntity("codigo")
 */
class Causa
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
     * @var \TipoCausa
     *
     * @ORM\ManyToOne(targetEntity="TipoCausa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipo_Causa", referencedColumnName="Id")
     * })
     */
    private $tipoCausa;

    /**
     * @var \CausaConaset
     *
     * @ORM\ManyToOne(targetEntity="CausaConaset")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CausaConaset", referencedColumnName="Id")
     * })
     */
    private $causaConaset;

    /**
     * @var \Accidentes
     *
     * @ORM\ManyToMany(targetEntity="Accidente", mappedBy="causas")
     */
    private $accidentes;

    /**
     * @var \AccidentesBasales
     *
     * @ORM\OneToMany(targetEntity="Accidente", mappedBy="causaBasal")
     */
    private $accidentesBasales;

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

    public function getTipoCausa(): ?TipoCausa
    {
        return $this->tipoCausa;
    }

    public function setTipoCausa(?TipoCausa $tipoCausa): self
    {
        $this->tipoCausa = $tipoCausa;

        return $this;
    }

    public function __construct() {
        $this->accidentes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->accidentesBasales = new ArrayCollection();
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
            $accidente->addCausa($this);
        }

        return $this;
    }

    public function removeAccidente(Accidente $accidente): self
    {
        if ($this->accidentes->contains($accidente)) {
            $this->accidentes->removeElement($accidente);
            $accidente->removeCausa($this);
        }

        return $this;
    }

    /**
     * @return Collection|Accidente[]
     */
    public function getAccidentesBasales(): Collection
    {
        return $this->accidentesBasales;
    }

    public function addAccidentesBasale(Accidente $accidentesBasale): self
    {
        if (!$this->accidentesBasales->contains($accidentesBasale)) {
            $this->accidentesBasales[] = $accidentesBasale;
            $accidentesBasale->setCausaBasal($this);
        }

        return $this;
    }

    public function removeAccidentesBasale(Accidente $accidentesBasale): self
    {
        if ($this->accidentesBasales->contains($accidentesBasale)) {
            $this->accidentesBasales->removeElement($accidentesBasale);
            // set the owning side to null (unless already changed)
            if ($accidentesBasale->getCausaBasal() === $this) {
                $accidentesBasale->setCausaBasal(null);
            }
        }

        return $this;
    }

    public function getCausaConaset(): ?CausaConaset
    {
        return $this->causaConaset;
    }

    public function setCausaConaset(?CausaConaset $causaConaset): self
    {
        $this->causaConaset = $causaConaset;

        return $this;
    }

}
