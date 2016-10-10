<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attachment
 *
 * @ORM\Table(name="attachment")
 * @ORM\Entity(repositoryClass="Repository\AttachmentRepository")
 */
class Attachment
{
    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string")
     */
    private $filename = '';

    /**
     * @var binary
     *
     * @ORM\Column(name="bin", type="binary")
     */
    private $bin = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * Set filename
     *
     * @param string $filename
     *
     * @return Attachment
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set bin
     *
     * @param binary $bin
     *
     * @return Attachment
     */
    public function setBin($bin)
    {
        $this->bin = $bin;

        return $this;
    }

    /**
     * Get bin
     *
     * @return binary
     */
    public function getBin()
    {
        return $this->bin;
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
}

