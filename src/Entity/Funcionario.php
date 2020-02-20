<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Funcionario
 *
 * @ORM\Table(name="Funcionario", uniqueConstraints={@ORM\UniqueConstraint(name="UQ_Funcionario_Codigo", columns={"Codigo"})}, indexes={@ORM\Index(name="IDX_Funcionario_Grado_Carabinero", columns={"Grado_Carabinero"}),@ORM\Index(name="IDX_Funcionario_Unidad", columns={"Unidad"})})
 * @ORM\Entity(repositoryClass="App\Repository\FuncionarioRepository")
 * @UniqueEntity("codigo")
 */
class Funcionario
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
     * @ORM\Column(name="Codigo", type="string", length=20, nullable=false)
     */
    private $codigo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Nombres", type="string", length=255, nullable=true)
     */
    private $nombres;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Apellido_Paterno", type="string", length=255, nullable=true)
     */
    private $apellidoPaterno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Apellido_Materno", type="string", length=255, nullable=true)
     */
    private $apellidoMaterno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Telefono", type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @var \GradoCarabinero
     *
     * @ORM\ManyToOne(targetEntity="GradoCarabinero", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Grado_Carabinero", referencedColumnName="Id")
     * })
     */
    private $gradoCarabinero;

    /**
     * @var \Unidad
     *
     * @ORM\ManyToOne(targetEntity="Unidad", inversedBy="funcionarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Unidad", referencedColumnName="Id")
     * })
     */
    private $unidad;

    /**
     * @var \Accidentes
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Accidente", mappedBy="funcionario")
     */
    private $accidentes;

    /**
     * @var \AccidentesResponsable
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Accidente", mappedBy="funcionarioResponsable")
     */
    private $accidentesResponsable;

    public function __construct()
    {
        $this->accidentes = new ArrayCollection();
        $this->accidentesResponsable = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNombres(): ?string
    {
        return $this->nombres;
    }

    public function setNombres(?string $nombres): self
    {
        $this->nombres = $nombres;

        return $this;
    }

    public function getApellidoPaterno(): ?string
    {
        return $this->apellidoPaterno;
    }

    public function setApellidoPaterno(?string $apellidoPaterno): self
    {
        $this->apellidoPaterno = $apellidoPaterno;

        return $this;
    }

    public function getApellidoMaterno(): ?string
    {
        return $this->apellidoMaterno;
    }

    public function setApellidoMaterno(?string $apellidoMaterno): self
    {
        $this->apellidoMaterno = $apellidoMaterno;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getGradoCarabinero(): ?GradoCarabinero
    {
        return $this->gradoCarabinero;
    }

    public function setGradoCarabinero(?GradoCarabinero $gradoCarabinero): self
    {
        $this->gradoCarabinero = $gradoCarabinero;

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

    public function __toString(): string
    {
        return $this->getCodigoNombre();
    }

    public function getCodigoNombre(): string
    {
        return $this->getCodigo() . ' - ' . $this->getGradoCarabinero() . ' ' . $this->getNombres() . ' ' . $this->getApellidoPaterno();
    }

    public function getNombreCompleto(): string
    {
        return $this->getNombres() . ' ' . $this->getApellidoPaterno();
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
            $accidente->setFuncionario($this);
        }

        return $this;
    }

    public function removeAccidente(Accidente $accidente): self
    {
        if ($this->accidentes->contains($accidente)) {
            $this->accidentes->removeElement($accidente);
            // set the owning side to null (unless already changed)
            if ($accidente->getFuncionario() === $this) {
                $accidente->setFuncionario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Accidente[]
     */
    public function getAccidentesResponsable(): Collection
    {
        return $this->accidentesResponsable;
    }

    public function addAccidentesResponsable(Accidente $accidentesResponsable): self
    {
        if (!$this->accidentesResponsable->contains($accidentesResponsable)) {
            $this->accidentesResponsable[] = $accidentesResponsable;
            $accidentesResponsable->setFuncionarioResponsable($this);
        }

        return $this;
    }

    public function removeAccidentesResponsable(Accidente $accidentesResponsable): self
    {
        if ($this->accidentesResponsable->contains($accidentesResponsable)) {
            $this->accidentesResponsable->removeElement($accidentesResponsable);
            // set the owning side to null (unless already changed)
            if ($accidentesResponsable->getFuncionarioResponsable() === $this) {
                $accidentesResponsable->setFuncionarioResponsable(null);
            }
        }

        return $this;
    }

}
