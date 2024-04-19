<?php

namespace App\Entity;

class RunnerModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $running_time;

    /**
     * @var  int
     */
    private $distance;

    /**
     * @var string
     */
    private $last_training;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getRunningTime(): string
    {
        return $this->runningTime;
    }

    public function setRunningTime(string $runningTime): void
    {
        $this->runningTime = $runningTime;
    }

    public function getDistance(): int
    {
        return $this->distance;
    }

    public function setDistance(int $distance): void
    {
        $this->distance = $distance;
    }

    public function getLastTraining(): string
    {
        return $this->last_traing;
    }

    public function setLastTraining(string $last_traing): void
    {
        $this->last_traing = $last_traing;
    }
}