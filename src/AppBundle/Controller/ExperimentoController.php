<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Experimento;
use AppBundle\Form\ExperimentoType;

/**
 * Experimento controller.
 *
 * @Route("/experimento")
 */
class ExperimentoController extends Controller
{

    /**
     * Lists all Experimento entities.
     *
     * @Route("/", name="experimento")
     * @Method("GET")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $entities = $em->getRepository('AppBundle:Experimento')->findByInvestigador($user);

        return $this->render('experimento/index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Experimento entity.
     *
     * @Route("/", name="experimento_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $entity = new Experimento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if($this->get('security.authorization_checker' ) ->isGranted('IS_AUTHENTICATED_FULLY' )) {
            $user = $this->getUser();
            if(in_array('ROLE_INVESTIGADOR',$user->getRoles(),true)){
                $entity->setInvestigador($user);
                if ($form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($entity);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('info', 'Se creo correctamente el Experimento');
                    return $this->redirect($this->generateUrl('experimento', array('id' => $entity->getId())));
                }
            }
        }

        return $this->render('experimento/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Experimento entity.
     *
     * @param Experimento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Experimento $entity)
    {
        $form = $this->createForm(new ExperimentoType(), $entity, array(
            'action' => $this->generateUrl('experimento_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Experimento entity.
     *
     * @Route("/new", name="experimento_new")
     * @Method("GET")
     *
     */
    public function newAction()
    {
        $entity = new Experimento();
        $form   = $this->createCreateForm($entity);

        return $this->render('experimento/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Experimento entity.
     *
     * @Route("/{id}", name="experimento_show")
     * @Method("GET")
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Experimento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Experimento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('experimento/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Experimento entity.
     *
     * @Route("/{id}/edit", name="experimento_edit")
     * @Method("GET")
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Experimento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Experimento entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('experimento/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Experimento entity.
    *
    * @param Experimento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Experimento $entity)
    {
        $form = $this->createForm(new ExperimentoType(), $entity, array(
            'action' => $this->generateUrl('experimento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Experimento entity.
     *
     * @Route("/{id}", name="experimento_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Experimento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Experimento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se edito correctamente el Experimento');
            return $this->redirect($this->generateUrl('experimento', array('id' => $id)));
        }

        return $this->render('experimento/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Experimento entity.
     *
     * @Route("/{id}", name="experimento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Experimento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Experimento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('experimento'));
    }

    /**
     * Creates a form to delete a Experimento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('experimento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr'=>array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
