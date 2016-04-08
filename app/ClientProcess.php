<?php

namespace App;

use Metabor\Statemachine\Condition\SymfonyExpression;
use Metabor\Statemachine\Process;
use Metabor\Statemachine\State;
use Metabor\Statemachine\Util\SetupHelper;

class ClientProcess extends Process
{
    protected $initialState;

    public function __construct()
    {
        $this->initialState = new State('new');
        parent::__construct('Client Process', $this->initialState);

        $this->initStates();
    }

    protected function initStates()
    {
        $helper = new SetupHelper($this->getStateCollectionMerger()->getTargetCollection());
        $helper->findOrCreateTransition('new', 'testing period', 'Start testing period');

        $helper->findOrCreateTransition('new', 'signed before start', 'Signed contract');
        $helper->findOrCreateTransition('testing period', 'signed before start', 'Signed contract');

        $helper->findOrCreateTransition(
            'signed before start',
            'active contract',
            null,
            new SymfonyExpression('subject.isContractActive()')
        );

        $helper->findOrCreateTransition(
            'active contract',
            'closed',
            'client inactive',
            new SymfonyExpression('not subject.isContractActive()')
        );

        $helper->findOrCreateTransition(
            'closed',
            'active contract',
            'recovered client',
            new SymfonyExpression('subject.isContractActive()')
        );
    }

}
