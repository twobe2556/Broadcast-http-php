<?php
namespace nClinic;

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
                'message' => $data
            ];

            @$this->client->send(json_encode($message));
            $this->Close();
        } catch (\Throwable $th) {
            // throw $th;
            echo "Error: Disconnected from the server";
        }
    }

    public function close()
    {
        @$this->client->close();
    }
}
