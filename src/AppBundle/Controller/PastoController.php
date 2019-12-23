<?php

namespace AppBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Pasto;
use AppBundle\Form\PastoType;
use AppBundle\Entity\AnalisisMuestra;
use AppBundle\ViewModel\PastoView;
use AppBundle\ViewModel\PastoViewType;

/**
 * Pasto controller.
 *
 * @Route("/pasto")
 */
class PastoController extends Controller
{

    /**
     * Lists all Pasto entities.
     *
     * @Route("/", name="pasto")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Pasto')->findAll();

        return $this->render('pasto/index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Pasto entity.
     *
     * @Route("/", name="pasto_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $entity = new PastoView();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $muestra = new Pasto();
            foreach($entity->getTratamientos() as $tratamiento)   {
                $muestra->addTratamiento($tratamiento);
            }
            foreach($entity->getAnalisis() as $analisis)   {
                $analisisMuestra = new AnalisisMuestra();
                $analisisMuestra->setAnalisis($analisis);
                $analisisMuestra->setAprobado(false);
                $analisisMuestra->setMuestra($muestra);
                $muestra->addAnalisisMuestra($analisisMuestra);
            }
            $muestra->setExperimento($entity->getExperimento());
            $muestra->setEspecie($entity->getEspecie());
            $muestra->setDias($entity->getDias());
            $muestra->setEpoca($entity->getEpoca());
            $muestra->setTipoEstudio($entity->getTipoEstudio());
            $muestra->setInvestigador($this->getUser());
            $muestra->setEstado('Enviada');


            $em->persist($muestra);

            $message = \Swift_Message::newInstance()
                ->setSubject('Muestra: Confimación de recibida')
                ->setFrom($this->container->getParameter('bundle.email'))
                ->setTo($this->getUser()->getEmail())
                ->setBody($this->renderView('emails/muestra.nueva.txt.twig'));

            $this->get('mailer')->send($message);

            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'Su muestra ha sido enviada correctamente!');

            return $this->redirect($this->generateUrl('muestras_por_investigador', array('id' => $entity->getId())));
        }

        return $this->render('pasto/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Pasto entity.
     *
     * @param PastoView $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PastoView $entity)
    {
        $form = $this->createForm(new PastoViewType($this->getUser()), $entity, array(
            'action' => $this->generateUrl('pasto_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Pasto entity.
     * @Route("/new", name="pasto_new")
     * @Method("GET")
     */
    public function newAction()
    {
        $entity = new PastoView();
        $form   = $this->createCreateForm($entity);

        return $this->render('pasto/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pasto entity.
     *
     * @Route("/{id}", name="pasto_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Pasto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pasto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('pasto/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pasto entity.
     *
     *
     * @Route("/{id}/edit", name="pasto_edit")
     * @Method("GET")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Pasto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pasto entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('pasto/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Pasto entity.
    *
    * @param Pasto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pasto $entity)
    {
        $form = $this->createForm(new PastoType(), $entity, array(
            'action' => $this->generateUrl('pasto_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Pasto entity.
     *
     *
     * @Route("/{id}", name="pasto_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Pasto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pasto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pasto_edit', array('id' => $id)));
        }

        return $this->render('pasto/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Pasto entity.
     *
     * @Route("/{id}", name="pasto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Pasto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pasto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pasto'));
    }

    /**
     * Creates a form to delete a Pasto entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pasto_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
