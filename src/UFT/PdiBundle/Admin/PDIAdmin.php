<?php

namespace UFT\PdiBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PDIAdmin extends AbstractAdmin
{

	protected $translationDomain = 'PdiBundle';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('titulo')
            ->add('descricao')
            ->add('anoInicio')
            ->add('anoFim')
            ->add('anoVigente')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
	        ->add('id')
            ->add('titulo',null,[
	            'label' => 'label.is_valid',
            ])
            ->add('descricao')
            ->add('anoInicio')
            ->add('anoFim')
            ->add('anoVigente')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                ),
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
	    $subject = $this->getSubject();

        $formMapper
            ->add('titulo')
            ->add('descricao')
	        ->ifFalse($subject->getId()==null)
		        ->add('anoInicio')
		        ->add('anoFim')
		        ->add('anoVigente')
	        ->ifEnd()
	        ->ifTrue($subject->getId()==null)
	            ->add('anoInicio', null, [
	                'data' => date("Y")
	            ])
	            ->add('anoFim', null, [
		            'data' => (date("Y")+5)
	            ])
	            ->add('anoVigente', null, [
		            'data' => date("Y")
	            ])
	        ->ifEnd()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('titulo')
            ->add('descricao')
            ->add('anoInicio')
            ->add('anoFim')
            ->add('anoVigente')
        ;
    }
}
