<?php

namespace edcBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ficheros
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ficheros
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descFichero", type="string", length=100)
     */
    private $descFichero;

    /**
     * @var string
     *
     * @ORM\Column(name="nomFichero", type="string", length=50)
     */
    private $nomFichero;


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
     * Set descFichero
     *
     * @param string $descFichero
     *
     * @return ficheros
     */
    public function setDescFichero($descFichero)
    {
        $this->descFichero = $descFichero;

        return $this;
    }

    /**
     * Get descFichero
     *
     * @return string
     */
    public function getDescFichero()
    {
        return $this->descFichero;
    }

    /**
     * Set nomFichero
     *
     * @param string $nomFichero
     *
     * @return ficheros
     */
    public function setNomFichero($nomFichero)
    {
        $this->nomFichero = $nomFichero;

        return $this;
    }

    /**
     * Get nomFichero
     *
     * @return string
     */
    public function getNomFichero()
    {
        return $this->nomFichero;
    }
}

