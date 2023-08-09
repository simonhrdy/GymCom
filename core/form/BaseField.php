<?php

namespace app\core\form;

use app\core\Model;

abstract class BaseField
{

    public Model $model;
    public string $attribute;
    public string $type;


    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf(
            '<div class="input-group">
                %s
                <label class="user-label">%s</label>
                <div class="invalid-feedback">
                    %s
                </div>
            </div>',
            $this->renderInput(),
            $this->model->getLabel($this->attribute),
            $this->model->getFirstError($this->attribute)
        );
    }

    abstract public function renderInput();
}
