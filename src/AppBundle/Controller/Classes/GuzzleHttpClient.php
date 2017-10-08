<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12. 9. 2017
 * Time: 17:54
 */

namespace AppBundle\Controller\Classes;

use GuzzleHttp\Client;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GuzzleHttpClient
{
    /**
     * @var GuzzleHttpClient
     */
    private $guzzle;

    /**
     * @var ContainerInterface
     */
    protected $serviceContainer;

    /**
     * Constructor
     * @param ContainerInterface $serviceContainer
     */
    public function __construct(ContainerInterface $serviceContainer) {
        $this->guzzle = new Client();
        $this->serviceContainer = $serviceContainer;
    }

    public function send($request, $region, $param = null) {
        if($param == null) {
            $param = array();
        }
        $url = $this->serviceContainer->getParameter('urls')[$region];
        $param['api_key'] = $this->getKey();
        $response = $this->guzzle->get($url.$request, array('query' => $param));
        switch($response->getStatusCode()) {
            case 400:
                throw new BadRequestHttpException();
                break;
            case 401:
                throw new UnauthorizedHttpException('');
                break;
            case 403:
                throw new AccessDeniedHttpException();
                break;
            case 429:
                throw new TooManyRequestsHttpException();
                break;
            case 500:
                throw new InternalErrorException();
                break;
            case 503:
                throw new ServiceUnavailableHttpException();
                break;
        }

        return json_decode($response->getBody());
    }

    private function getKey()
    {
        return $this->serviceContainer->getParameter('key');
    }
}