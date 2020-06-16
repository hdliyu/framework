<?php
namespace hdliyu\framework\route;

class Route{
    use Setting,Compile,Execute;

    public function bootstrap()
    {
        $this->load();
        $this->format();
        $content = $this->exec();
        echo $content;
    }

}