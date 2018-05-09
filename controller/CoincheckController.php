<?php

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

use lib\csvload\CsvLaodPer30;
use Tests\Functional\BaseTestCase;

class CoincheckController
{
    const BASE_URI = 'https://coincheck.com';
    const TICKER = '/api/ticker';
    const STATUS = 200;
    const LOGDIR = __DIR__ . '/../data/';
    private $app;

    public function __construct (Container $app)
    {
        $this->app = $app;
    }

    public function index (Request $request, Response $response)
    {
        $name = $request->getAttribute('name');
        $array = ['test' => "Hello, $name"];
        $response = $response->withJson($array, self::STATUS);
        return $response;
    }

    public function phpinfo (Request $request, Response $response)
    {
        phpinfo();
        $this->echoTest();
        return $response;
    }

    public function getPrice (Request $request, Response $response)
    {
        $res = $this->app->client->request('GET', self::TICKER);
        $body = $res->getBody();
        $arr = json_decode($body->getContents(), true);
        $arr['timestamp'] = date('Y-m-d H:i:s', $arr['timestamp']);
        //var_dump($arr);

        //csv
        $log_file = self::LOGDIR.date('Ymd');
        $fp = fopen($log_file.'.csv', 'a');
        fwrite($fp , date('Y/m/d H:i:s'.','));
        foreach ($arr as $k => $v) {
            fwrite($fp, $k.','.floor($arr[$k]).',' );
            break;
        }
        fwrite($fp, "\r\n");
        fclose($fp);

        return $this->app->renderer->render($response, 'cc/getprice', $arr);
    }

    public function close (Request $request, Response $response)
    {
        echo 'Test!';
        $args = ['name' => 'hoge'];
        // Render index view
        return $this->app->renderer->render($response, 'sample', $args);
    }


}
