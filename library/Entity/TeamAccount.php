<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TeamAccount
 *
 * @ORM\Table(name="team", indexes={@ORM\Index(name="team_account_id_team_idx", columns={"id_team"}), @ORM\Index(name="team_account_id_account_idx", columns={"id_account"})})
 * @ORM\Entity(repositoryClass="Repository\TeamAccountRepository")
 */
class TeamAccount
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
     * @var \Entity\Account
     *
     * @ORM\ManyToOne(targetEntity="Entity\Account")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_account", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $Account;


    /**
     * Set start
     *
     * @param \DateTime $start
     *
     * @return TeamAccount
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
     * @return TeamAccount
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
     * @return TeamAccount
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
     * Set account
     *
     * @param \Entity\Account $account
     *
     * @return TeamAccount
     */
    public function setAccount(\Entity\Account $account = null)
    {
        $this->Account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \Entity\Account
     */
    public function getAccount()
    {
        return $this->Account;
    }
}
