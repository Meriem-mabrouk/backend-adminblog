<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BlogRepository;

/**
 * @ORM\Entity(repositoryClass=BlogRepository::class)
 */
class Blog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message=" titre doit etre non vide")
     * @Assert\Length(
     *   min = 5,
     *   minMessage=" Entrer un titre au minimum de 5 caracteres"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * * @Assert\NotBlank(message=" contenu doit etre non vide")
     * @Assert\Length(
     *   min = 5,
     *   max = 100,
     *   minMessage=" Entrer un contenu au minimum de 5 caracteres et maximun de 100 caracteres"
     * )
     * @ORM\Column(type="string", length=800)
     */
    private $contenu;

    /**
     * * @Assert\NotBlank(message=" auteur doit etre non vide")
     * @Assert\Length(
     *   min = 5,
     *   minMessage=" Entrer un auteur au minimum de 5 caracteres"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $auteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }
}
