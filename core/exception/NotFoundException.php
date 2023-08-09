<?php

namespace app\core\exception;

class NotFoundException extends \Exception
{
    protected $message = 'Omlouváme se, ale stránka, kterou hledáte, neexistuje. Prosím, ujistěte se, že jste zadali aktuální URL.';
    protected $code = 404;
}
