<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="game", indexes={@ORM\Index(name="game_name_idx", columns={"name"})})
 * @ORM\Entity(repositoryClass="Repository\GameRepository")
 */
class Game
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Entity\Tournament", mappedBy="Tournament")
     */
    private $Tournaments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Tournaments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Game
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
     * Add tournament
     *
     * @param \Entity\Tournament $tournament
     *
     * @return Game
     */
    public function addTournament(\Entity\Tournament $tournament)
    {
        $this->Tournaments[] = $tournament;

        return $this;
    }

    /**
     * Remove tournament
     *
     * @param \Entity\Tournament $tournament
     */
    public function removeTournament(\Entity\Tournament $tournament)
    {
        $this->Tournaments->removeElement($tournament);
    }

    /**
     * Get tournaments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTournaments()
    {
        return $this->Tournaments;
    }
}
