<?php
/**
 * @file
 * Contains Drupal\multi_step\Form\MultiStepForm2.
 */

namespace Drupal\multi_step\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class MultiStepForm2 extends MultiStepForm {

  
  public function getFormId() {
    return 'multi_step_fo';
  }

  
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);

    $form['age'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Your age'),
      //'#default_value' => $this->store->get('age') ? $this->store->get('age') : '',
    );

    $form['location'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Your location'),
      //'#default_value' => $this->store->get('location') ? $this->store->get('location') : '',
    );

    $form['actions']['previous'] = array(
      '#type' => 'link',
      '#title' => $this->t('Previous'),
      '#attributes' => array(
        'class' => array('button'),
      ),
      '#weight' => 0,
      //'#url' => Url::fromRoute('demo.multistep_one'),
    );

    return $form;
  }

  
  public function submitForm(array &$form, FormStateInterface $form_state) {
    //$this->store->set('age', $form_state->getValue('age'));
    //$this->store->set('location', $form_state->getValue('location'));
    
   //dpm($form_state);
    print "htre";
    // Save the data
   // parent::saveData();
    //$form_state->setRedirect('some_route');
  }
}