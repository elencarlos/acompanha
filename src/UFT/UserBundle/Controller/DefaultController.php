<?php

namespace UFT\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UserBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function listUserAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('UserBundle:Usuario');
        $user = $repository->findAll();
        return $this->render('UserBundle:User:list.html.twig', array('entities' => $user));
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editUsersAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('UserBundle:Usuario');
        $entity = $repository->find($id);
        if (!$entity) {
            throw $this->createNotFoundException(
                'usuário não encontrado para o id: '.$id
            );
        }


        $form = $this->createFormBuilder($entity)
            ->add('username', 'text', array('disabled' => true))
            ->add(
                'roles',
                ChoiceType::class,
                array(
                    'expanded' => true,
                    'multiple' => true,
                    'choices' => array(
                        'Administrador' => 'ROLE_ADMIN',
                        'Aluno' => 'ROLE_ALUNO',
                        'Coordenador' => 'ROLE_COORDENADOR',
                        'Membro Externo' => 'ROLE_MEMBRO_EXTERNO',
                        'Professor' => 'ROLE_PROFESSOR',
                        'Técnico' => 'ROLE_TECNICO',
                        ($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN') ? 'Super Administrador': 'Usuário') =>
                            ($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN') ? 'ROLE_SUPER_ADMIN': 'ROLE_USER'),
                    ),
                    // *this line is important*
                    'choices_as_values' => true,
                )
            )
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('gpu_users_list');
        }

        $build['form'] = $form->createView();
        $build['msg'] = '';

        return $this->render('UserBundle:User:edit.html.twig', $build);
    }

}
