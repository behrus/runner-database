<?php

namespace App\Controller;

use App\Service\RunnerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RunnerController extends AbstractController
{
    private RunnerService $runnerService;

    public function __construct(RunnerService $runnerService)
    {
        $this->runnerService = $runnerService;
    }

    /**
     * @Route("/runner", name="app_runner")
     */
    public function index(): Response
    {

        return $this->render(
            'runner/index.html.twig', [
                'runners' => $this->runnerService->getRunnersData()
            ]
        );
    }

    /**
     * @Route("/runner/{id}", name="runner")
     */
    public function get(string $id): Response
    {
        $data = $this->runnerService->getRunnerData($id);

        return $this->render(
            'runner/get.html.twig', [
                'runner' => $data,
                'name'   => $data[0]['name']
            ]
        );
    }
}
