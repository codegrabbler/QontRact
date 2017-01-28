<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AbstractServer
 *
 * @ORM\Table(name="server")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AbstractServerRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap( {"minecraft" = "MinecraftServer", "bungee" = "BungeeServer"} )
 *
 */
abstract class AbstractServer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var integer
     *
     * @ORM\Column(name="port", type="integer", length=255)
     */
    private $port;

    /**
     * get a list of subclasses
     * @return array
     */
    public static function getDiscriminatorMap()
    {
        return [
            'minecraft' => MinecraftServer::class,
            'bungee' => BungeeServer::class
        ];
    }

    abstract public function getTypeName();


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * Set name
     *
     * @param string $name
     *
     * @return AbstractServer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return AbstractServer
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return AbstractServer
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get port
     *
     * @return integer
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set port
     *
     * @param integer $port
     *
     * @return AbstractServer
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }
}

