<?php

namespace RestApis\Blockchain\BTC\TransactionApi;

use Common\Response;
use RestApis\Blockchain\BTC\Common;
use RestApis\Blockchain\BTC\Snippets\Fee;
use RestApis\Blockchain\BTC\Snippets\Input;
use RestApis\Blockchain\BTC\Snippets\Output;

class CreateTransaction extends Common {

    protected $network;

    /**
     * @param $network string
     * @param Input $inputs
     * @param Output $outputs
     * @param Fee $fee
     * @return \stdClass
     */

    public function create($network, Input $inputs, Output $outputs, Fee $fee)
    {
        $this->network = $network;
        return (new Response(
            $this->request([
                'method' => 'POST',
                'params' =>  [
                    'inputs' => $inputs->get(),
                    'outputs' => $outputs->get(),
                    'fee' => $fee->get()
                ]
            ])
        ))->get();
    }

    protected function getEndPoint()
    {
        return $this->endpoint . '/' . $this->network . '/txs/create';
    }

}