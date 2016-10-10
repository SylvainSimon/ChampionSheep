<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="Repository\TeamRepository")
 */
class Team
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
     * @ORM\OneToMany(targetEntity="Entity\TeamAccount", mappedBy="TeamAccount", cascade={"all"})
     */
    private $TeamAccounts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->TeamAccounts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Team
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
     * Add teamAccount
     *
     * @param \Entity\TeamAccount $teamAccount
     *
     * @return Team
     */
    public function addTeamAccount(\Entity\TeamAccount $teamAccount)
    {
        $this->TeamAccounts[] = $teamAccount;

        return $this;
    }

    /**
     * Remove teamAccount
     *
     * @param \Entity\TeamAccount $teamAccount
     */
    public function removeTeamAccount(\Entity\TeamAccount $teamAccount)
    {
        $this->TeamAccounts->removeElement($teamAccount);
    }

    /**
     * Get teamAccounts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeamAccounts()
    {
        return $this->TeamAccounts;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Entity\Tournament", mappedBy="Tournament")
     */
    private $Tournaments;


    /**
     * Add tournament
     *
     * @param \Entity\Tournament $tournament
     *
     * @return Team
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Entity\TournamentTeam", mappedBy="TournamentTeam", cascade={"all"})
     */
    private $TournamentTeams;


    /**
     * Add tournamentTeam
     *
     * @param \Entity\TournamentTeam $tournamentTeam
     *
     * @return Team
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
