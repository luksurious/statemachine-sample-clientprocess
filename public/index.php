<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Client;
use App\ClientProcess;
use Fhaculty\Graph\Graph;
use Graphp\GraphViz\GraphViz;
use Metabor\Statemachine\Graph\GraphBuilder;
use Metabor\Statemachine\Statemachine;

$client = new Client();
$process = new ClientProcess();
$statemachine = new Statemachine($client, $process);


try {

    $graph = new Graph();
    $builder = new GraphBuilder($graph);
    $builder->addStateCollection($process);
    $viz = new GraphViz();
    $viz->setFormat('svg');
    echo file_get_contents($viz->createImageFile($graph));
} catch (Exception $e) {
    echo $e->getMessage();
}
