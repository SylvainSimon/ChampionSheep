<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="tag", indexes={@ORM\Index(name="tag_id_account_idx", columns={"id_account"})})
 * @ORM\Entity(repositoryClass="Repository\TagRepository")
 */
class Tag
{
    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string")
     */
    private $libelle = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * Set type
     *
     * @param integer $type
     *
     * @return Tag
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Tag
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
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
     * Set account
     *
     * @param \Entity\Account $account
     *
     * @return Tag
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
