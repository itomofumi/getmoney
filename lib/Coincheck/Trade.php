<?php
namespace Coincheck;

class Trade
{
    /** @var Coincheck */
    private $client;

    public function __construct(\Coincheck\Coincheck $client)
    {
        $this->client = $client;
    }

    /**
     * 最新の取引履歴を取得できます。
     *
     * @param  mixed
     * @return Json Array
     */
    public function all($params = array())
    {
        $arr = ['pair' => 'btc_jpy'];
        $rawResponse = $this->client->request('get', 'api/trades', $arr);
        return $rawResponse;
    }

}
