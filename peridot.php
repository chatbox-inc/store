<?php

use Evenement\EventEmitterInterface;
use Peridot\Core\Test;

return function(EventEmitterInterface $emitter) {
    $emitter->on('peridot.start', function ($env,$app) {
        \Peridot\Plugin\Lumen\register(require __DIR__ . '/sample/app.php');
    });
};
