<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Persona
 *
 * @ORM\Table(name="Persona")
 * @ORM\Entity
 */
class Persona
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
     * @ORM\Column(name="RUN", type="string", length=15, nullable=true)
     */
    private $run;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombres", type="string", length=255, nullable=true)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="Apellido_Paterno", type="string", length=255, nullable=true)
     */
    private $apellidoPaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="Apellido_Materno", type="string", length=255, nullable=true)
     */
    private $apellidoMaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="Ocupacion", type="string", length=255, nullable=true)
     */
    private $ocupacion;

    /**
     * @var string
     *
     * @ORM\Column(name="Genero", type="string", length=255, nullable=true)
     */
    private $genero;

    /**
     * @var string
     *
     * @ORM\Column(name="Estado_Civil", type="string", length=255, nullable=true)
     */
    private $estadoCivil;

    /**
     * @var string
     *
     * @ORM\Column(name="Nacionalidad", type="string", length=255, nullable=true)
     */
    private $nacionalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="Lugar_Nacimiento", type="string", length=255, nullable=true)
     */
    private $lugarNacimiento;

    /**
     * @ORM\Column(name="Fecha_Nacimiento", type="date", nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @var \PersonaAccidente
     *
     * @ORM\OneToOne(targetEntity="PersonaAccidente", mappedBy="persona")
     */
    private $personaAccidente;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="Registrado", type="datetime")
     */
    private $registrado;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRun(): ?string
    {
        return $this->run;
    }

    public function setRun(?string $run): self
    {
        $this->run = $run;

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

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(?string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getLugarNacimiento(): ?string
    {
        return $this->lugarNacimiento;
    }

    public function setLugarNacimiento(?string $lugarNacimiento): self
    {
        $this->lugarNacimiento = $lugarNacimiento;

        return $this;
    }

    public function getOcupacion(): ?string
    {
        return $this->ocupacion;
    }

    public function setOcupacion(?string $ocupacion): self
    {
        $this->ocupacion = $ocupacion;

        return $this;
    }

    public function getEstadoCivil(): ?string
    {
        return $this->estadoCivil;
    }

    public function setEstadoCivil(string $estadoCivil): self
    {
        $this->estadoCivil = $estadoCivil;

        return $this;
    }

    public function getNacionalidad(): ?string
    {
        return $this->nacionalidad;
    }

    public function setNacionalidad(string $nacionalidad): self
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    /**
     * @return Collection|PersonaAccidente[]
     */
    public function getPersonaAccidente(): Collection
    {
        return $this->personaAccidente;
    }

    public function setPersonaAccidente(?PersonaAccidente $personaAccidente): self
    {
        $this->personaAccidente = $personaAccidente;

        // set (or unset) the owning side of the relation if necessary
        $newPersona = $personaAccidente === null ? null : $this;
        if ($newPersona !== $personaAccidente->getPersona()) {
            $personaAccidente->setPersona($newPersona);
        }

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(\DateTimeInterface $fechaNacimiento): self
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function estaVacio(): bool
    {
        if ($this->getRun()) {
            return false;
        } elseif($this->getNombres()) {
            return false;
        } elseif($this->getApellidoPaterno()) {
            return false;
        } elseif($this->getApellidoMaterno()) {
            return false;
        } elseif($this->getOcupacion()) {
            return false;
        } elseif($this->getLugarNacimiento()) {
            return false;
        } else {
            return true;
        }
    }

    public function getRegistrado(): ?\DateTimeInterface
    {
        return $this->registrado;
    }

    public function setRegistrado(\DateTimeInterface $registrado): self
    {
        $this->registrado = $registrado;

        return $this;
    }

    public function getEdad(): ?\DateInterval
    {
        return $this->getFechaNacimiento() ? $this->getFechaNacimiento()->diff($this->getRegistrado()) : NULL;
    }

}
