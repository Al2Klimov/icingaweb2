<?php

namespace Icinga\Module\Dashboards\Form;

use Icinga\Module\Dashboards\Common\Database;
use ipl\Html\Html;
use ipl\Web\Compat\CompatForm;

class DeleteDashletForm extends CompatForm
{
    use Database;

    /** @var object|null $dashlet Public dashlet from the given dashboard */
    protected $dashlet;

    /**
     * Create a dashlet remove Form
     *
     * @param object|null $dashlet The dashlet that can be deleted by any user
     */
    public function __construct($dashlet)
    {
        $this->dashlet = $dashlet;
    }

    protected function assemble()
    {
        $this->add(
            Html::tag(
                'h1',
                null,
                Html::sprintf(
                    'Please confirm deletion of dashlet \'%s\'',
                    $this->dashlet->name
                )
            )
        );

        $this->addElement('input', 'btn_submit', [
            'type' => 'submit',
            'value' => 'Confirm Removal',
            'class' => 'btn-primary autofocus'
        ]);
    }

    protected function onSuccess()
    {
        $this->getDb()->delete('dashlet', ['id = ?' => $this->dashlet->id]);
    }
}
