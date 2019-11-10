<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;


class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index($producer)
    {
        $urls = [
            'http://localhost',
        ];

        foreach($urls as $url) {
            $producer->publish($url);
//            $client = HttpClient::create();
//            $response = $client->request('GET', $url);
//            dump($response->getStatusCode());
        }
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
