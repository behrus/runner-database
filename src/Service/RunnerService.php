<?php

namespace App\Service;


use App\Entity\RunnerModel;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class RunnerService
{
    /** @var ObjectNormalizer $normalizer */
    private ObjectNormalizer $normalizer;
    private string $rootPath;

    public function __construct(string $rootPath)
    {
        $this->rootPath = $rootPath;
    }

    public function getRunnersData(): array
    {
        $data = json_decode($this->getJsonData(), true);

        $result = [];
        foreach ($data as [
                 'id' => $id,
                 'name' => $name,
                 'running_time' => $runningTime,
                 'distance' => $distance,
                 'distance_unit' => $distanceUnit,
                 'last_training' => $lastTraining,]) {
            if (!isset($result[$id]) || $result[$id]['last_training'] < $lastTraining) {
                $result[$id] = [
                    'id' => $id,
                    'name' => $name,
                    'running_time' => $runningTime,
                    'distance' => $distance,
                    'distance_unit' => $distanceUnit,
                    'last_training' => $lastTraining
                ];
            }
        }

        return $result;
    }

    public function getRunnerData(int $id): array
    {
        $data = json_decode($this->getJsonData(), true);

        return array_filter($data, function ($var) use ($id) {
            return ($var['id'] == $id);
        });
    }

    private function getNormalizer(): Serializer
    {
        return new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );
    }

    private function getJsonData(): string
    {
        $data = @file_get_contents($this->rootPath . '/runnersJsonData/data.json');
        if ($data === false) {
            throw new FileNotFoundException();
        }

        return $data;
    }
}