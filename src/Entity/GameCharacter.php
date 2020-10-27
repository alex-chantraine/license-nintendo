<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GameCharacterRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=GameCharacterRepository::class)
 * @Vich\Uploadable
 */
class GameCharacter extends AbstractEntity
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Game
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="gameCharacters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

    /**
     * @var Character
     * @ORM\ManyToOne(targetEntity=Character::class, inversedBy="gameCharacters")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull
     */
    private $currentCharacter;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $thumbnail;

    /**
     * @Vich\UploadableField(mapping="game_characters_images", fileNameProperty="thumbnail")
     * @var File|null
     */
    private $imageFile;

    /**
     * Get id value
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get game value
     *
     * @return Game|null
     */
    public function getGame(): ?Game
    {
        return $this->game;
    }

    /**
     * Set game value
     *
     * @param Game $game
     * @return self
     */
    public function setGame(Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get character value
     *
     * @return Character|null
     */
    public function getCurrentCharacter(): ?Character
    {
        return $this->currentCharacter;
    }

    /**
     * Set character value
     *
     * @param Character $currentCharacter
     * @return self
     */
    public function setCurrentCharacter(Character $currentCharacter): self
    {
        $this->currentCharacter = $currentCharacter;

        return $this;
    }

    /**
     * Get thumbnail value
     *
     * @return string|null
     */
    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    /**
     * Set thumbnail value
     *
     * @param string|null $thumbnail
     * @return self
     */
    public function setThumbnail(?string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Set imega file value
     *
     * @param File|null $imageFile
     * @return void
     */
    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile;

        if($this->imageFile){
            $this->setUpdateAt(new \Datetime());
        }
    }

    /**
     * Get image file value
     *
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
}
