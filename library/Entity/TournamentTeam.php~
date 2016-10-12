<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TournamentTeam
 *
 * @ORM\Table(name="tournament_team", indexes={@ORM\Index(name="tournament_team_id_tournament_idx", columns={"id_tournament"}), @ORM\Index(name="tournament_team_id_team_idx", columns={"id_team"})})
 * @ORM\Entity(repositoryClass="Repository\TournamentTeamRepository")
 */
class TournamentTeam
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Entity\Team
     *
     * @ORM\ManyToOne(targetEntity="Entity\Team")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_team", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $Team;

    /**
     * @var \Entity\Tournament
     *
     * @ORM\ManyToOne(targetEntity="Entity\Tournament")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tournament", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $Tournament;


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
     * Set team
     *
     * @param \Entity\Team $team
     *
     * @return TournamentTeam
     */
    public function setTeam(\Entity\Team $team = null)
    {
        $this->Team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \Entity\Team
     */
    public function getTeam()
    {
        return $this->Team;
    }

    /**
     * Set tournament
     *
     * @param \Entity\Tournament $tournament
     *
     * @return TournamentTeam
     */
    public function setTournament(\Entity\Tournament $tournament = null)
    {
        $this->Tournament = $tournament;

        return $this;
    }

    /**
     * Get tournament
     *
     * @return \Entity\Tournament
     */
    public function getTournament()
    {
        return $this->Tournament;
    }
}
