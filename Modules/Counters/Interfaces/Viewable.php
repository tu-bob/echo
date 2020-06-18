<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 19.06.2020
 */

namespace Modules\Counters\Interfaces;

/**
 * Ensures that Model has relation views
 */
interface Viewable
{
    /**
     * @return mixed
     */
    public function views();
}
