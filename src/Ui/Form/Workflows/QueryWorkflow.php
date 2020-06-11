<?php

namespace Anomaly\Streams\Platform\Ui\Form\Workflows;

use Anomaly\Streams\Platform\Workflow\Workflow;
use Anomaly\Streams\Platform\Ui\Support\Workflows\StartQuery;
use Anomaly\Streams\Platform\Ui\Form\Workflows\Query\FilterQuery;
use Anomaly\Streams\Platform\Ui\Form\Workflows\Query\FinishQuery;

/**
 * Class QueryWorkflow
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class QueryWorkflow extends Workflow
{

    /**
     * The build steps.
     *
     * @var array
     */
    protected $steps = [

        /**
         * Query dem results.
         */
        StartQuery::class,
        FinishQuery::class,
    ];
}