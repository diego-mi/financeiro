<?php

namespace Auth\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class FormLogin extends Form
{
    /**
     *
     */
    public function prepareElements()
    {
        parent::__construct('login', array());
        $this->setAttribute('method', 'POST');

        $this->add(array(
            'name' => 'login',
            'options' => array(
                'label' => 'Login',
            ),
            'type' => 'Text',
        ));

        $this->add(array(
            'name' => 'password',
            'options' => array(
                'label' => 'Password',
            ),
            'type' => 'Password',
        ));

        $this->add(array(
            'name' => 'send',
            'type'  => 'Submit',
            'attributes' => array(
                'value' => 'Submit',
            ),
        ));

    }
}
