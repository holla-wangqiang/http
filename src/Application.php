<?php declare(strict_types=1);

namespace Hi\Http;

use Hi\Helpers\Json;
use Hi\Http\Runtime\BuiltIn;
use Hi\Server\ServerInterface;

class Application
{
    /**
     * @var ServerInterface
     */
    protected $server;

    public function __construct(array $config = [])
    {
    }

    public function listen(int $port = 8000, string $host = '0.0.0.0')
    {
        $type = '';

        $runtime = $this->withRuntime($type, $port, $host);
        $runtime->start(
            $this->createRequestHandle(),
            $this->createTaskHandle()
        );
    }

    protected function withRuntime(): ServerInterface
    {
        return new BuiltIn;
    }

    private function createRequestHandle()
    {
        return function (RequestInterface $request, ResponseInterface $response) {
            $response
                ->setContent(Json::encode($request->getServerRequest()->getServerParams()))
            ;
        };
    }

    private function createTaskHandle()
    {
        return function () {};
    }
}

