<?php
/**
* @file
* Contains Drupal\multi_step\Form\MultiStepForm.
*/
namespace Drupal\multi_step\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
class MultiStepForm extends ConfigFormBase
{
    protected $step = 1;
    /**
    *
    {
        @inheritdoc
    }
    */
    protected function getEditableConfigNames()
    {
    }
    /**
    *
    {
        @inheritdoc
    }
    */
    public function getFormID()
    {
        return 'multi_step_form';
    }
    /**
    *
    {
        @inheritdoc
    }
    */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form = parent::buildForm($form, $form_state);
        $config = $this->config('multi_step.multi_step_form_config');
        if($this->step == 1)
        {
            $form['combo'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Email and Username'),
            '#description' => $this->t(''),
            '#required' => TRUE,
            ];
        }
        if($this->step == 2)
        {
            $value= $form_state->getValue($res);
            if($value['res']['name']=='exist')
            {
                $form = \Drupal::formBuilder()->getForm('Drupal\user\Form\UserLoginForm');
                $value = $form_state->getValue();
                $form['name']['#value']=$value['combo'];
            }
            else
            {
                global $base_url;
                $tempstore = \Drupal::service('user.private_tempstore')->get('multi_step');
                $tempstore->set('combovalue',$value['combo']);
                $session = new Session();
                $session->set('key', 'value');
                $key= $session->get("key");
                $response = new RedirectResponse($base_url.'/user/register');
                $response->send();
                exit;
            }
        }
        if($this->step < 2)
        {
            $button_label = $this->t('Next');
        }
        else
        {
            $button_label = $this->t('Log in');
        }
        $form['actions']['submit']['#value'] = $button_label;
        return $form;
    }
    /**
    *
    {
        @inheritdoc
    }
    */
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        $storage = $form_state->getStorage($this->step);
        $str=$form_state->setStorage($storage);
        $ss=$str->step;
        $combovalue = $form_state->getValue();
        $name = '';
        $valid = TRUE;
        $query = \Drupal::database()->select('users_field_data', 'u');
        $query->fields('u', ['name']);
        $query->fields('u', ['mail']);
        $or = $query->orConditionGroup()
        ->condition('u.name', $combovalue['combo'])->condition('u.mail', $combovalue['combo']);
        $results = $query->condition($or)->execute()->fetchAll();
        if(!$results)
        {
            $name = 'notexist';
        }
        else
        {
            $name = 'exist';
        }
        $res = array('valid'=>$valid,'name'=>$name);
        $ddd=$form_state->setValue('res');
        $form_state->setValue('res', array('valid'=>$valid,'name'=>$name));
        return $ddd;
    }
    /**
    *
    {
        @inheritdoc
    }
    */
    public static function multi_loginform_validate(&$form, FormStateInterface $form_state)
    {
        $loginvalue= $form_state->getValues();
        $input = &$form_state->getUserInput();
        $name=$input['name'];
        $password=$input['pass'];
        if (strpos($name,"@") == true)
        {
            $query = \Drupal::database()->select('users_field_data', 'u');
            $query->fields('u', ['mail']);
            $query->condition('u.mail', $name,'=');
            $results = $query->execute()->fetchAssoc();
            if (!$results || !isset($results['mail']))
            {
                $form_state->setErrorByName('name', t('The email address provided could not be found'));
            }
            else
            {
                $name = $results['mail'];
                $users = \Drupal::entityTypeManager()->getStorage('user')
                ->loadByProperties(['mail' => $name]);
                $user = reset($users);
                $username= $user->getDisplayName();
                if ($user)
                {
                    $uid = $user->id();
                    $uid = \Drupal::service('user.auth')->authenticate($username,$password);
                    $rids = $user->getRoles();
                }
            }
        }
        /****** close if ****/
        else
        {
            $query = \Drupal::database()->select('users_field_data', 'u');
            $query->fields('u', ['name']);
            $query->condition('u.name', $name,'=');
            $results = $query->execute()->fetchAssoc();
            if (!$results || !isset($results['name']))
            {
                $form_state->setErrorByName('name', t('The username provided could not be found'));
            }
            else
            {
                $name = $results['name'];
                $uid = \Drupal::service('user.auth')->authenticate($name,$password);
            }
        }
        $user = \Drupal\user\Entity\User::load($uid);
        if(isset($user))
        {
            $form_state->setRedirect(
            'entity.user.canonical',
            array('user' => $user->id())
            );
            user_login_finalize($user);
        }
        else
        {
            $form_state->setErrorByName('pass', t('Please Enter Valid Password'));
        }
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        if($this->step < 2)
        {
            $form_state->setRebuild();
            $this->step++;
        }
        $button_clicked = $form_state->getTriggeringElement()['#value'];
        $value= $form_state->getValue($res);
        if($this->step == 2 && $value['res']['name']=='class_exists(class_name)' && $button_clicked=='Log in')
        {
            $this->multi_loginform_validate($form,$form_state);
        }
    }
}