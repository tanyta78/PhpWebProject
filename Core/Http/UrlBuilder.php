<?php


namespace Core\Http;


class UrlBuilder implements UrlBuilderInterface
{
    /** @var RequestContextInterface */
    private $request;

    /**
     * UrlBuilder constructor.
     * @param RequestContextInterface $request
     */
    public function __construct(RequestContextInterface $request)
    {
        $this->request = $request;
    }

    public function build(string $controller = null,
                          string $action = null,
                          ...$params)
    {
        $url = "//"
            .$this->request->getHost()
            .$this->request->getExecutingPath();
        if (null=== $controller){
            return $url;
        }

        $url .= $controller;

        if (null===$action) {
            return $url;
        }

        $url.='/'.$action;

        foreach ($params[0] as $param){
            $url.='/'.$param;
        }

        return $url;
    }
}