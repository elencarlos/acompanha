<?php

namespace UFT\UserBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\UserBundle\Admin\Model\GroupAdmin as BaseGroupAdmin;

class GroupAdmin extends BaseGroupAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        // NEXT_MAJOR: Keep FQCN when bumping Symfony requirement to 2.8+.
        $securityRolesType = method_exists('Symfony\Component\Form\AbstractType', 'getBlockPrefix')
            ? 'Sonata\UserBundle\Form\Type\SecurityRolesType'
            : 'sonata_security_roles';

        $formMapper
            ->tab('Group')
            ->with('General', array('class' => 'col-md-6'))
            ->add('name')
            ->end()
            ->end()
            ->tab('Security')
            ->with('Roles', array('class' => 'col-md-12'))
            ->add('roles', $securityRolesType, array(
                'expanded' => true,
                'multiple' => true,
                'required' => false,
            ))
            ->end()
            ->end()
        ;
    }
}
