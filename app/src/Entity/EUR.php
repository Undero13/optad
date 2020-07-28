<?php

namespace App\Entity;

use App\Repository\EURRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EURRepository::class)
 */
class EUR
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $urls;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tags;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     */
    private $estimated_revenue;

    /**
     * @ORM\Column(type="integer")
     */
    private $ad_impressions;

    /**
     * @ORM\Column(type="float")
     */
    private $ad_ecpm;

    /**
     * @ORM\Column(type="integer")
     */
    private $clicks;

    /**
     * @ORM\Column(type="float")
     */
    private $ad_ctr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrls(): ?string
    {
        return $this->urls;
    }

    public function setUrls(string $urls): self
    {
        $this->urls = $urls;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(string $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEstimatedRevenue(): ?float
    {
        return $this->estimated_revenue;
    }

    public function setEstimatedRevenue(float $estimated_revenue): self
    {
        $this->estimated_revenue = $estimated_revenue;

        return $this;
    }

    public function getAdImpressions(): ?int
    {
        return $this->ad_impressions;
    }

    public function setAdImpressions(int $ad_impressions): self
    {
        $this->ad_impressions = $ad_impressions;

        return $this;
    }

    public function getAdEcpm(): ?float
    {
        return $this->ad_ecpm;
    }

    public function setAdEcpm(float $ad_ecpm): self
    {
        $this->ad_ecpm = $ad_ecpm;

        return $this;
    }

    public function getClicks(): ?int
    {
        return $this->clicks;
    }

    public function setClicks(int $clicks): self
    {
        $this->clicks = $clicks;

        return $this;
    }

    public function getAdCtr(): ?float
    {
        return $this->ad_ctr;
    }

    public function setAdCtr(float $ad_ctr): self
    {
        $this->ad_ctr = $ad_ctr;

        return $this;
    }
}
