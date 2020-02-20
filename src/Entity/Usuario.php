<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\GroupInterface;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Usuario
 *
 * @ORM\Table(name="Usuario")
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 */
class Usuario extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Grupo")
     * @ORM\JoinTable(name="Usuario_Grupo",
     *      joinColumns={@ORM\JoinColumn(name="usuario", referencedColumnName="Id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="grupo", referencedColumnName="Id")}
     * )
     */
    protected $groups;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity="Funcionario", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(referencedColumnName="Id")
     * })
     */
    private $funcionario;

    public function __construct()
    {
        parent::__construct();
        $this->groups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Grupo[]
     */
    public function getGroups(): Collection
    {
        return parent::getGroups();
    }

    public function addGroup(GroupInterface $group): self
    {
        return parent::addGroup($group);
    }

    public function removeGroup(GroupInterface $group): self
    {
        return parent::removeGroup($group);
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

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

}