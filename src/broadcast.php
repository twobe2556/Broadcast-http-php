<?php

namespace nclinic\crm;

use WebSocket\Client;

class broadcast
{
    private $client;

    public function __construct($websocketUrl)
    {
        $this->client = new Client($websocketUrl);
    }

    public function trigger($channel, $event, $data)
    {
        try {
            $message = [
                'channel' => $channel,
                'event' => $event,
                'data' => $data
            ];

            @$this->client->send(json_encode($message));
            $this->Close();
            return true;
        } catch (\Throwable $th) {
            // throw $th;
            //echo "Error: Disconnected from the server";
            return false;
        }
    }

    public function close()
    {
        @$this->client->close();
    }
}
