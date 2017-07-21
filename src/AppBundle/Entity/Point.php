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
     * @var string
     *
     * @ORM\Column(name="icon", type="string")
     * @Assert\NotBlank()
     * @Assert\Regex(
     *  pattern="/^[a-z](-?[a-z]+)*$/i",
     *  message="Icon must be a valid Font-Aesome icon name, and may only contain letters and '-'"
     * )
     */
    private $icon = 'chevron-down';

    /**
     * @var string
     *
     * @ORM\Column(name="point_name", type="string")
     */
    private $point_name;

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
     * Set icon
     *
     * @param string $icon
     *
     * @return Point
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     *
     * Set point_name
     *
     * @param string $point_name
     *
     * @return Point
     *
     */
    public function setPointName($point_name)
    {
        if($point_name==null){
            $this->point_name == "";
        }else {
            $this->point_name = $point_name;
        }
        return $this;
    }

    /**
     * Get point_name
     *
     * @return string
     */
    public function getPointName()
    {
        return $this->point_name;
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
