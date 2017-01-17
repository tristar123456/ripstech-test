<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Point
 *
 * @ORM\Table(name="point")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PointRepository")
 */
class Point
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
     * @var float
     *
     * @ORM\Column(name="lat", type="float")
     * @Assert\NotBlank()
     * @Assert\Range(
     *  min = -90,
     *  max = 90,
     *  minMessage = "Latitude range cannot be less than {{ limit }} degrees",
     *  maxMessage = "Latitude range cannot be greater than {{ limit }} degrees"
     * )
     */
    private $lat;

    /**
     * @var float
     *
     * @ORM\Column(name="long", type="float")
     * @Assert\NotBlank()
     * @Assert\Range(
     *  min = -180,
     *  max = 180,
     *  minMessage = "Longitude range cannot be less than {{ limit }} degrees",
     *  maxMessage = "Longitude range cannot be greater than {{ limit }} degrees"
     * )
     */
    private $long;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


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
     * Set lat
     *
     * @param float $lat
     *
     * @return Point
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set long
     *
     * @param float $long
     *
     * @return Point
     */
    public function setLong($long)
    {
        $this->long = $long;

        return $this;
    }

    /**
     * Get long
     *
     * @return float
     */
    public function getLong()
    {
        return $this->long;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Point
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
