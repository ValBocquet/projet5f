<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @UniqueEntity(
 *     fields = {"email"},
 *     message = "Adresse email déjà utilisée"
 * )
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Longueur du mot de passe minimum : 8 caractères")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Datas", mappedBy="idUser", orphanRemoval=true)
     */
    private $files;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sizeUpload;

    /**
     * @ORM\Column(type="boolean")
     */
    private $premium;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_admin;


    public function __construct()
    {
        $this->files = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
        return $this->getPseudo();
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getRoles()
    {
        // TODO: Implement getRoles() method.{
        $roles = ['ROLE_USER'];
         if ($this->is_admin) {
             $roles[] = 'ROLE_ADMIN';
         }
        return $roles;

    }

    /**
     * @return Collection|Datas[]
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function addFile(Datas $file): self
    {
        if (!$this->files->contains($file)) {
            $this->files[] = $file;
            $file->setIdUser($this);
        }

        return $this;
    }

    public function removeFile(Datas $file): self
    {
        if ($this->files->contains($file)) {
            $this->files->removeElement($file);
            // set the owning side to null (unless already changed)
            if ($file->getIdUser() === $this) {
                $file->setIdUser(null);
            }
        }

        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getSizeUpload()
    {
        return $this->sizeUpload;
    }

    public function setSizeUpload($sizeUpload): self
    {
        $this->sizeUpload = $sizeUpload;

        return $this;
    }

    public function getPremium(): ?bool
    {
        return $this->premium;
    }

    public function setPremium(bool $premium): self
    {
        $this->premium = $premium;

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getPseudo();
    }

    public function getIsAdmin(): ?bool
    {
        return $this->is_admin;
    }

    public function setIsAdmin(bool $is_admin): self
    {
        $this->is_admin = $is_admin;

        return $this;
    }
}
