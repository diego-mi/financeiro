<?php

namespace Base\Message;

/**
 * Class MessageTrait
 */
trait MessageTrait
{
    /**
     * Mensagem para campos que nao podem ser vazios
     * @var string
     */
    protected $strMsgErrorNotEmpty = 'O campo não pode ser vazio.';
}
