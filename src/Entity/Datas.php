<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\DatasRepository")
 */
class Datas
{
    /**
     * @Assert\File(
     *     maxSize = "50M",
     *     maxSizeMessage = "Votre fichier ({{ size }} {{ suffix }}) dépasse la limite autorisée de {{ limit }} {{ suffix }}."
     * )
     */
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameFile;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $sizeFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="files")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameFile()
    {
        return $this->nameFile;
    }

    public function setNameFile($nameFile): self
    {
        $this->nameFile = $nameFile;

        return $this;
    }

    public function getSizeFile()
    {
        return $this->sizeFile;
    }

    public function setSizeFile($sizeFile): self
    {
        $this->sizeFile = $sizeFile;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeInterface $create_at): self
    {
        $this->create_at = $create_at;

        return $this;
    }

    public function getIdUser(): ?Users
    {
        return $this->idUser;
    }

    public function setIdUser(?Users $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }
}
