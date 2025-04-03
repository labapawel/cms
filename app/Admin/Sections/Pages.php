<?php

namespace App\Admin\Sections;

use AdminColumn;
use AdminColumnFilter;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\SaveAndCreate;
use SleepingOwl\Admin\Section;

/**
 * Class Pages
 *
 * @property \App/Models/Page $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Pages extends Section implements Initializable
{
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $alias;

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation()->setPriority(100)->setIcon('fa fa-lightbulb-o');
    }

    /**
     * @param array $payload
     *
     * @return DisplayInterface
     */
    public function onDisplay($payload = [])
    {
        $columns = [
            AdminColumn::text('id', '#')->setWidth('50px')->setHtmlAttribute('class', 'text-center'),
            AdminColumn::link('title', 'Tytul', 'created_at')
                ->setSearchCallback(function($column, $query, $search){
                    return $query
                        ->orWhere('name', 'like', '%'.$search.'%')
                        ->orWhere('created_at', 'like', '%'.$search.'%')
                    ;
                })
                ->setOrderable(function($query, $direction) {
                    $query->orderBy('created_at', $direction);
                })
            ,
            \AdminColumnEditable::checkbox('active', 'Aktywna')
               
        ];

        $display = AdminDisplay::datatablesAsync()
            ->setName('firstdatatables')
            ->setOrder([[0, 'asc']])
            ->setDisplaySearch(true)
            ->paginate(25)
            ->setColumns($columns)
            ->setHtmlAttribute('class', 'table-primary table-hover th-center')
        ;


        return $display;
    }

    /**
     * @param int|null $id
     * @param array $payload
     *
     * @return FormInterface
     */
    public function onEdit($id = null, $payload = [])
    {
        $pola = [
            \AdminFormElement::text('title', 'Tytul')
                ->required()
                ->setValidationRules(['required'])
                ->setHtmlAttribute('placeholder', 'Tytul')
                ->setHtmlAttribute('maxlength', 255),
            \AdminFormElement::wysiwyg('content', 'Treść'),
            \AdminFormElement::checkbox('active', 'Aktywność')->setDefaultValue(1),
            \AdminFormElement::checkbox('is_menu', 'Czy w menu'),
            \AdminFormElement::checkbox('new_window', 'Otwieranie w nowym oknie'),
            \AdminFormElement::text('meta_title', 'Meta title')
                ->setHtmlAttribute('placeholder', 'Meta title')
                ->setHtmlAttribute('maxlength', 255),
            \AdminFormElement::textarea('meta_description', 'Meta description')
                ->setHtmlAttribute('placeholder', 'Meta description'),
            \AdminFormElement::text('meta_keywords', 'Meta keywords')
                ->setHtmlAttribute('placeholder', 'Meta keywords')
                ->setHtmlAttribute('maxlength', 255),
        ];
        return \AdminForm::panel()->addBody($pola);
    }

    /**
     * @return FormInterface
     */
    public function onCreate($payload = [])
    {
        return $this->onEdit(null, $payload);
    }

    /**
     * @return bool
     */
    public function isDeletable(Model $model)
    {
        return true;
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // remove if unused
    }
}
