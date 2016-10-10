<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tournament
 *
 * @ORM\Table(name="tournament", indexes={@ORM\Index(name="tournament_name_idx", columns={"name"}), @ORM\Index(name="tournament_id_game_idx", columns={"id_game"}), @ORM\Index(name="tournament_id_winner_team_idx", columns={"id_winner_team"})})
 * @ORM\Entity(repositoryClass="Repository\TournamentRepository")
 */
class Tournament
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="datetime", nullable=true)
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="datetime", nullable=true)
     */
    private $end;

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
     * @var \Entity\Team
     *
     * @ORM\ManyToOne(targetEntity="Entity\Team")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_winner_team", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $WinnerTeam;


    /**
     * Set start
     *
     * @param \DateTime $start
     *
     * @return Tournament
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     *
     * @return Tournament
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Tournament
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
     * @return Tournament
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

    /**
     * Set winnerTeam
     *
     * @param \Entity\Team $winnerTeam
     *
     * @return Tournament
     */
    public function setWinnerTeam(\Entity\Team $winnerTeam = null)
    {
        $this->WinnerTeam = $winnerTeam;

        return $this;
    }

    /**
     * Get winnerTeam
     *
     * @return \Entity\Team
     */
    public function getWinnerTeam()
    {
        return $this->WinnerTeam;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Entity\TournamentTeam", mappedBy="TournamentTeam", cascade={"all"})
     */
    private $TournamentTeams;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->TournamentTeams = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tournamentTeam
     *
     * @param \Entity\TournamentTeam $tournamentTeam
     *
     * @return Tournament
     */
    public function addTournamentTeam(\Entity\TournamentTeam $tournamentTeam)
    {
        $this->TournamentTeams[] = $tournamentTeam;

        return $this;
    }

    /**
     * Remove tournamentTeam
     *
     * @param \Entity\TournamentTeam $tournamentTeam
     */
    public function removeTournamentTeam(\Entity\TournamentTeam $tournamentTeam)
    {
        $this->TournamentTeams->removeElement($tournamentTeam);
    }

    /**
     * Get tournamentTeams
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTournamentTeams()
    {
        return $this->TournamentTeams;
    }
}
