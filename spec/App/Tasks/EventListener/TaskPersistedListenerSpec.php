<?php

namespace spec\App\Tasks\EventListener;

use App\Tasks\EventListener\TaskPersistedListener;
use PhpSpec\ObjectBehavior;

class TaskPersistedListenerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TaskPersistedListener::class);
    }
}
