<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
            'https://anthonykgross.fr',
            'https://anthonykgross.fr/cv',
            'https://anthonykgross.fr/blog',
            'https://anthonykgross.fr/evenements',
            'https://anthonykgross.fr/projets',
            'https://anthonykgross.fr',
            'https://anthonykgross.fr/cv',
            'https://anthonykgross.fr/blog',
            'https://anthonykgross.fr/evenements',
            'https://anthonykgross.fr/projets',
            'https://anthonykgross.fr',
            'https://anthonykgross.fr/cv',
            'https://anthonykgross.fr/blog',
            'https://anthonykgross.fr/evenements',
            'https://anthonykgross.fr/projets',
            'https://anthonykgross.fr',
            'https://anthonykgross.fr/cv',
            'https://anthonykgross.fr/blog',
            'https://anthonykgross.fr/evenements',
            'https://anthonykgross.fr/projets',
            'https://anthonykgross.fr',
            'https://anthonykgross.fr/cv',
            'https://anthonykgross.fr/blog',
            'https://anthonykgross.fr/evenements',
            'https://anthonykgross.fr/projets',
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

    /**
     * @Route("/redis_endpoint", name="redis_endpoint")
     */
    public function redisEndpoint()
    {
        $client = new \Predis\Client([
            'host'   => 'redis',
            'port'   => 6379,
            'password' => 'fake_password'
        ]);

        $titles = [];
        foreach($client->keys("*") as $key) {
            $titles[$key] = $client->get($key);
        }
        ksort($titles);
        return new JsonResponse(array_values($titles));
    }
}
