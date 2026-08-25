===source===
<?php
class WithAdaptations
{
    /**
     * Resolve conflicting methods.
     */
    use BehaviorA, BehaviorB {
        BehaviorA::foo insteadof BehaviorB;
        BehaviorB::bar as protected;
    }
}
===print===
<?php
class WithAdaptations
{
    /**
    * Resolve conflicting methods.
    */
    use BehaviorA, BehaviorB {
        BehaviorA::foo insteadof BehaviorB;
        BehaviorB::bar as protected;
    }
}
