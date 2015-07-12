<?php

namespace Dadamssg\DemoApp\Bundle\AppBundle\Form;

use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;

final class ErrorExtractor
{
    /**
     * Get all the errors from the form.
     *
     * @param FormInterface $form
     * @return string[]
     */
    public function extract(FormInterface $form)
    {
        $errors = array();

        /** @var FormError $error */
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors = array_merge($errors, $this->extract($child));
            }
        }

        return $errors;
    }
}