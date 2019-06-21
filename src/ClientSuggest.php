<?php

namespace Fomvasss\Dadata;

/**
 * Class ClientHint
 *
 * @package \Fomvasss\Dadata
 */
class ClientSuggest
{
    protected $token;

    protected $config;

    protected $baseUrl = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/';

    /**
     * ClientHint constructor.
     */
    public function __construct()
    {
        $this->config = config('dadata');
        $this->token = $this->config['token'];
    }

    /**
     * @param string $type
     * @param array $fields
     * @return bool|mixed|string
     */
    public function suggest($type, $fields)
    {
        return $this->request('suggest', $type, $fields);
    }

    /**
     * @param string $type
     * @param array $fields
     * @return bool|mixed|string
     */
    public function findById($type, $fields)
    {
        return $this->request('findById', $type, $fields);
    }

    /**
     * @param string $url
     * @param string $type
     * @param array $fields
     * @return bool|mixed|string
     */
    private function request($url, $type, $fields)
    {
        $result = false;
        if ($ch = curl_init($this->baseUrl.$url.'/'.$type)) {
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Token '.$this->token
            ));
            curl_setopt($ch, CURLOPT_POST, 1);
            // json_encode
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            $result = json_decode($result, true);
            curl_close($ch);
        }

        return $result;
    }
}
