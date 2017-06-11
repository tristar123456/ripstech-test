<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Statistic
 *
 * @ORM\Table(name="statistic")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatisticRepository")
 */
class Statistic
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     * @Assert\NotBlank()
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="product_id", type="string")
     * @Assert\NotBlank()
     */
    private $product_id;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string")
     * @Assert\NotBlank()
     * @Assert\Regex(
     *  pattern="/\b([A-Z]{2})\b/",
     *  message="Country muss be a valid country code"
     * )
     */
    private $country;

    /**
     * @var float
     *
     * @ORM\Column(name="net", type="float")
     * @Assert\NotBlank()
     */
    private $net;

    /**
     * @var float
     *
     * @ORM\Column(name="gross", type="float")
     * @Assert\NotBlank()
     */
    private $gross;

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
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return Statistic
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get product id
     *
     * @return string
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Set product id
     *
     * @param string $product_id
     *
     * @return Statistic
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Statistic
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get net value
     *
     * @return float
     */
    public function getNet()
    {
        return $this->net;
    }

    /**
     * Set net value
     *
     * @param float $net
     *
     * @return Statistic
     */
    public function setNet($net)
    {
        $this->net = $net;

        return $this;
    }

    /**
     * Get gross value
     *
     * @return float
     */
    public function getGross()
    {
        return $this->gross;
    }

    /**
     * Set gross value
     *
     * @param float $gross
     *
     * @return Statistic
     */
    public function setGross($gross)
    {
        $this->gross = $gross;

        return $this;
    }

    /**
     * Get created at date
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set created at time
     *
     * @param \DateTime $createdAt
     *
     * @return Statistic
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
