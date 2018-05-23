<?php

/**
 * @file
 * Contains Drupal\multi_step\Form\MultiStepForm.
 */

namespace Drupal\multi_step\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\DrupalKernel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\AlertCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Ajax\UpdateBuildIdCommand;
use Symfony\Component\HttpFoundation\Session\Session;

class MultiStepForm extends ConfigFormBase
 {

  protected $step = 1;
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {}

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'multi_step_form';
  }


 

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
   dpm($form_id);
     $config = $this->config('multi_step.multi_step_form_config');

    if($this->step == 1) {
      // $form['model'] = [
      //   '#type' => 'select',
      //   '#title' => $this->t('Model'),
      //   '#description' => $this->t(''),
      //         '#options' => array('1997', '1998', '1999', '2000', '2001', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015'),
      //         '#default_value' => $config->get('model'),
      // ];

 $form['combo'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Email and Username'),
        '#description' => $this->t(''),
        '#required' => TRUE,
        
            
              //'#default_value' => $config->get('body_style'),
      ];


    }
  
 
    


    if($this->step == 2) {

//       $form['body_style'] = [
//         '#type' => 'checkboxes',
//         '#title' => $this->t('Body Style'),
//         '#description' => $this->t(''),
//               '#options' => array('Coupe', 'Sedan', 'Convertible', 'Hatchbac', 'Station wagon', 'SUV', 'Minivan', 'Full-size van', 'Pick-up'),
//               '#default_value' => $config->get('body_style'),
//       ];
// //       $fb = $this->formBuilder();
// // $rc['login'] = $fb->getForm("user_login_form");
//      return $form;
      //if($var[input]=='sumit')

$value= $form_state->getValue($res);
//ksm($value);
//echo "<pre>";
//print_r($value);
 print $value['res']['name']; 


      //if($res['name']== 'TRUE')
 if($value['res']['name']=='exist')
 {
$form = \Drupal::formBuilder()->getForm('Drupal\user\Form\UserLoginForm');
//ksm($form);
$value = $form_state->getValue();
$form['name']['#value']=$value['combo'];
//$form['pass']['#value']=''; 

 
    //print_r($combovalue);
    //kint($combovalue);

// $form['login_form']=$form;
// return array(
//       '#theme' => 'multi_step',
//       '#test_var' =>$form['login_form'],


//     );
}

else
{

global $base_url; 
//$form_state->setRedirect('multi_step.multi_step_form_two');
//drupal_set_message(t('You have been redirected because...'), 'status', TRUE);
//$response = new RedirectResponse(hostsite_get_url('/user/register', $params));
//$response->send();
$tempstore = \Drupal::service('user.private_tempstore')->get('multi_step');
$tempstore->set('combovalue',$value['combo']);
$_SESSION['regValue'] = 're';
$session = new Session();
    $session->set('key', 'value');

    $key= $session->get("key");
    var_dump($_SESSION);
  $response = new RedirectResponse($base_url.'/user/register');
  $response->send();
  exit;
// $entity = \Drupal::entityTypeManager()->getStorage('user')->create(array());
// $formObject = \Drupal::entityTypeManager()
//   ->getFormObject('user', 'register')
//   ->setEntity($entity);
// //$form = \Drupal::formBuilder()->getForm($formObject);
//   //$form = \Drupal::formBuilder()->getForm('Drupal\resume\Form\ResumeForm');
// //ksm($form);
//  $value = $form_state->getValue();

//  $form_state->setRedirect('multi_step.multi_step_form_two');

// You need a block_id! to get it just click configure in the desire block and you'll get url like this /admin/structure/block/manage/bartik_search   the last part of the parameter is the block id
// $block = \Drupal\block\Entity\Block::load('UserRegisterBlock');
// $block_content = \Drupal::entityManager()
//   ->getViewBuilder('block')
//   ->view($block);

// return array('#markup' => drupal_render($block_content));


// $values = array(
//   // A unique ID for the block instance.
//   'id' => 'register',
//   // The plugin block id as defined in the class.
//   'plugin' => 'formblock_user_register',
//   // The machine name of the theme region.
//   'region' => 'content',
//   'settings' => array(
//     'label' => 'Execute PHP',
//   ),
//   // The machine name of the theme.  
//   'theme' => 'bartik',
//   'visibility' => array(),
//   'weight' => 100,
// );
// $block = \Drupal\block\Entity\Block::create($values);
// $block->save();


// $block_manager = \Drupal::service('plugin.manager.block');
// $block_config = [];
// $block_plugin = $block_manager->createInstance('<block_id>', $block_config);
// $block_build = $block_plugin->build();
// $block_content = render($block_build);
//$form['account']['mail']['#value']='tets';
//$form['account']['mail']['#default_value']='ffff';
//dpm($form);
//ksm($value);
//ksm($form);

// For "mymodule_name is multi_step," any unique namespace will do.

//$form['#submit'][] = 'bakingo_user_register_submit_core';
//$form['actions']['submit']['#submit'][] = 'Drupal\multi_step\Form\MultiStepForm::bakingo_user_register_submit_core';
 //      $form['#submit'][] = 'bakingo_custom_profile_form_register_submit';
//  if (strpos($value['combo'],"@") == true) {
// $form['account']['mail']['#value']=$value[combo];
// }
// else{
// $form['account']['name']['#value']=$value[combo];
// }

//print render($form);
// $form=  \Drupal::service('renderer')->render($form);
//  $build = [
//     '#theme' => 'multi_step'
//     '#test_var' => \Drupal::service('renderer')->render($form),
//   ];
//   $form['#theme'] = 'multi_step';

 


// return array(
//        '#theme' => 'multi_step',
//       '#test_var' =>\Drupal::service('renderer')->render($form),
      
      
//  );
   

// $entity = \Drupal::entityManager()
//     ->getStorage('user')
//     ->create(array());

//   $formObject = \Drupal::entityManager()
//     ->getFormObject('user', 'register')
//     ->setEntity($entity);

//   $form = \Drupal::formBuilder()->getForm($formObject);
//   $variables['register_form'] = $form;


//return $rc;

}
    }



    // if($this->step == 3) {
    //   $form['gas_mileage'] = [
    //     '#type' => 'radios',
    //     '#title' => $this->t('Gas Mileage'),
    //     '#description' => $this->t(''),
    //           '#options' => array('20 mpg or less', '21 mpg or more', '26 mpg or more', '31 mpg or more', '36 mpg or more', '41 mpg or more'),
    //           '#default_value' => $config->get('gas_mileage'),
    //   ];
    // }

      

    if($this->step < 2) {
      $button_label = $this->t('Next');
    //   $form['go'] = [
    //   '#type' => 'submit',
    //   '#value' => $this->t('Go'),
 
    //   // Modifications below.
    //   '#ajax' => [
    //     'callback' => 'Drupal\multi_step\Form\MultiStepForm::respondToAjax',
    //     'event' => 'click',
    //     'progress' => ['type' => 'throbber', 'message' => NULL],
    //   ],
    // ];   
    }
     else {
        $button_label = $this->t('Log in');
      }
  $form['actions']['submit']['#value'] = $button_label;

//ksm($form);
 // $form_state[complete_form]['#value']='hhh';
    return $form;
  
  }


public static function respondToAjax(array $form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $message = 'Your phone number is ' . $form_state->getValue('phone');
    $submit_selector = 'form:has(input[name=form_build_id][value='
      . $form['#build_id'] . '])';
 
    $response->addCommand(new AlertCommand($message));
    $response->addCommand(new UpdateBuildIdCommand($form['#build_id_old'], $form['#build_id']));
    $response->addCommand(new InvokeCommand($submit_selector, 'submit'));
 
    return $response;
  }


  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    //return parent::validateForm($form, $form_state);
      //if($this->step==1)
      //{
  //kint($form_state); 
 
$storage = $form_state->getStorage($this->step);
$str=$form_state->setStorage($storage);
//ksm($str);
$ss=$str->step;
//dpm($this->step);

    $combovalue = $form_state->getValue();
    //print_r($combovalue);
    //kint($combovalue);
    print $combovalue[combo]; 


 $name = '';
  $valid = TRUE;
  $query = \Drupal::database()->select('users_field_data', 'u');
  $query->fields('u', ['name']);
  $query->fields('u', ['mail']);
  //$query->condition('u.name', $combovalue[combo]);
  //$or=db_or()->condition('u.name', $combovalue[combo])->condition('u.mail', $combovalue[combo]);
  $or = $query->orConditionGroup()
    ->condition('u.name', $combovalue[combo])->condition('u.mail', $combovalue[combo]);

  //$results = $query->execute()->fetchAll();
  $results = $query->condition($or)->execute()->fetchAll();
   
   if(!$results)
   {
      $name = 'notexist';
    }
    else{
       $name = 'exist';
    }

   $res = array('valid'=>$valid,'name'=>$name);
   //ksm($res);
   $ddd=$form_state->setValue('res');
   $form_state->setValue('res', array('valid'=>$valid,'name'=>$name));
   //ksm($ddd);
  return $ddd;  


    //$response = validate_step_1($combovalue[combo]);  
  //}
    // $storage = &$form_state->getStorage();
    // $form_state->setStorage($storage);
    // print_r($storage);
    // ksm($storage);  

  }

 // function validate_step_1($combo){  
 //  $name = '';
 //  $valid = TRUE;
 //  $query = \Drupal::database()->select('users_field_data', 'u');
 //  $query->fields('u', ['name']);
 //  $query->condition('u.name', $combo);
 //  $results = $query->execute()->fetchAll();
   
 //   if(!$results)
 //   {
 //   $valid = true;
 //    }
 //    else{
 //      $name = $query['name'];
 //    }

 //   $res = array('valid'=>$valid,'name'=>$name);
 //   ksm($res);
 //  return $res;  

 // }


  /**
   * {@inheritdoc}
   */

public static function multi_loginform_validate(&$form, FormStateInterface $form_state) {
   drupal_set_message('It works!');
   //ksm($form_state);
   // $response = $form_state->getResponse();
   // $form_state->setResponse($response);
   //dpm($form_state);
   //kint($form_state);
   
    $loginvalue= $form_state->getValues();
    $input = &$form_state->getUserInput();


     dpm($input);
    // ksm($loginvalue);
    //dpm($loginvalue);
    $name=$input['name'];
    $password=$input['pass'];

    if (strpos($name,"@") == true) {
     
  $query = \Drupal::database()->select('users_field_data', 'u');
  //$query->fields('u', ['name']);
  $query->fields('u', ['mail']);
  $query->condition('u.mail', $name,'=');
  //$or=db_or()->condition('u.name', $combovalue[combo])->condition('u.mail', $combovalue[combo]);
  //$or = $query->orConditionGroup()
   // ->condition('u.name', $combovalue[combo])->condition('u.mail', $combovalue[combo]);

  $results = $query->execute()->fetchAssoc();
  //$results = $query->condition($or)->execute()->fetchAll();
   
   //dpm($results);
   if (!$results || !isset($results['mail'])) {
      // User could not be found with this email address
      //form_set_error('combo',t("The email address provided could not be found"));
       $form_state->setErrorByName('name', t('The email address provided could not be found'));
    } else {
      $name = $results['mail'];


      $users = \Drupal::entityTypeManager()->getStorage('user')
  ->loadByProperties(['mail' => $name]);
     $user = reset($users);
     //dpm($user);
     //ksm($user);
      //$us = user_load_by_mail($name);
            //$form_state->setValue('name', $user->getUsername());
       // dpm($us);
      $username= $user->getUsername(); 
     //$username=$user->values['name']['x-default'];
   // dpm($username);
   if ($user) {
  
  $uid = $user->id();
  $uid = \Drupal::service('user.auth')->authenticate($username,$password);
  $rids = $user->getRoles();
}
    }



    }
  else
{

$query = \Drupal::database()->select('users_field_data', 'u');
  $query->fields('u', ['name']);
 
  $query->condition('u.name', $name,'=');
  //$or=db_or()->condition('u.name', $combovalue[combo])->condition('u.mail', $combovalue[combo]);
  //$or = $query->orConditionGroup()
   // ->condition('u.name', $combovalue[combo])->condition('u.mail', $combovalue[combo]);

  $results = $query->execute()->fetchAssoc();
  if (!$results || !isset($results['name'])) {
      // User could not be found with this email address
      //form_set_error('combo',t("The email address provided could not be found"));
       $form_state->setErrorByName('name', t('The username provided could not be found'));
    } else {
      $name = $results['name'];



$uid = \Drupal::service('user.auth')->authenticate($name,$password);
//dpm($uids);
}


}
//dpm($uid);
 //dpm($pass);
 //$account = $this->userStorage->load($form_state->get('uid'));

$user = \Drupal\user\Entity\User::load($uid);
//ksm($user);
if(isset($user))
{
$form_state->setRedirect(
        'entity.user.canonical',
        array('user' => $user->id())
      );
user_login_finalize($user);
}
else{
  $form_state->setErrorByName('pass', t('Please Enter Valid Password'));
  //$form_state->setErrorByName('pass', t('The e-mail address is already registered. <a href="@password">Have you forgotten your password?</a>', array('@password' => url('user-login'))));
  

}



  }


// public static function multi_registerform_submit(&$form, FormStateInterface $form_state) {

//  drupal_set_message('register works!');
//   $registervalue = $form_state->getValue();
//   //kint($registervalue);
//   //dpm($form_state);
//   $mail=$registervalue['mail'];

//  $query = \Drupal::database()->select('users_field_data', 'u');
//   //$query->fields('u', ['name']);
//   $query->fields('u', ['mail']);
//   $query->condition('u.mail', $mail,'=');
//   //$or=db_or()->condition('u.name', $combovalue[combo])->condition('u.mail', $combovalue[combo]);
//   //$or = $query->orConditionGroup()
//    // ->condition('u.name', $combovalue[combo])->condition('u.mail', $combovalue[combo]);

//   $results = $query->execute()->fetchAssoc();
//   //$results = $query->condition($or)->execute()->fetchAll();
//    $form_state->setErrorByName('name', t('The email address provided could not be found'));
//    dpm($results);
//    // if (($results['mail'])) {
//    //    // User could not be found with this email address
//    //    //form_set_error('combo',t("The email address provided could not be found"));
//    //     $form_state->setErrorByName('name', t('The email address provided could not be found'));
//    //  }


//   }


  public function submitForm(array &$form, FormStateInterface $form_state) {
    // kint($form_state); 
    // $combovalue = $form_state->getValue();
    // print_r($combovalue);
    // kint($combovalue);
    // print $combovalue[combo];
    // $response = validate_step_1($combovalue[combo],$form_state);
    //print $form_state[complete_form]['#value'];

    if($this->step < 2) {
      $form_state->setRebuild();

      $this->step++;
    }
  $button_clicked = $form_state->getTriggeringElement()['#value'];
  //dpm($button_clicked);
  //print $button_clicked;
  //$aa=drupal_render($button_clicked);
  //print $aa;

// if($button_clicked=='Next')
// {
 
// $this->multi_loginform_validate($form,$form_state);

// }


  $value= $form_state->getValue($res);
if($this->step == 2 && $value['res']['name']=='class_exists(class_name)') {
 print $value['res']['name'];

if($button_clicked=='Log in')
{
 
$this->multi_loginform_validate($form,$form_state);

}


  

 } 


//parent::submitForm($form, $form_state);
    //else {
      //parent::submitForm($form, $form_state);

      /*$this->config('multi_step.multi_step_form_config')
            ->set('model', $form_state->getValue('model'))
            ->set('body_style', $form_state->getValue('body_style'))
            ->set('gas_mileage', $form_state->getValue('gas_mileage'))
          ->save();*/
    //}
  }



// /**
//  * Submit callback for the user profile form to save the contact page setting.
//  */
// function contact_user_profile_form_submit($form, FormStateInterface $form_state) {
//   $account = $form_state->getFormObject()->getEntity();
//   if ($account->id() && $form_state->hasValue('contact')) {
//     \Drupal::service('user.data')->set('contact', $account->id(), 'enabled', (int) $form_state->getValue('contact'));
//   }
// }




}
