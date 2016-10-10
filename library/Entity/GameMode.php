<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GameMode
 *
 * @ORM\Table(name="game_mode", indexes={@ORM\Index(name="game_mode_name_idx", columns={"name"}), @ORM\Index(name="game_mode_id_game_idx", columns={"id_game"})})
 * @ORM\Entity(repositoryClass="Repository\GameModeRepository")
 */
class GameMode
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Entity\Game
     *
     * @ORM\ManyToOne(targetEntity="Entity\Game")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_game", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $Game;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return GameMode
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set game
     *
     * @param \Entity\Game $game
     *
     * @return GameMode
     */
    public function setGame(\Entity\Game $game = null)
    {
        $this->Game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \Entity\Game
     */
    public function getGame()
    {
        return $this->Game;
    }
}

