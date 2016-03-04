<?php

namespace ECommerce\ECommerceBundle\Controller\BackEnd;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ECommerce\ECommerceBundle\Entity\Commande;
use ECommerce\ECommerceBundle\Form\CommandeType;

/**
 * Commande controller.
 *
 */
class CommandeController extends Controller
{

    /**
     * Lists all Commande entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ECommerceECommerceBundle:Commande')->findAll();

        return $this->render('ECommerceECommerceBundle:BackEnd/Commande:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Commande entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Commande();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_commande_show', array('id' => $entity->getId())));
        }

        return $this->render('ECommerceECommerceBundle:BackEnd/Commande:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Commande entity.
     *
     * @param Commande $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Commande $entity)
    {
        $form = $this->createForm(new CommandeType(), $entity, array(
            'action' => $this->generateUrl('admin_commande_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Commande entity.
     *
     */
    public function newAction()
    {
        $entity = new Commande();
        $form   = $this->createCreateForm($entity);

        return $this->render('ECommerceECommerceBundle:BackEnd/Commande:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Commande entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ECommerceECommerceBundle:Commande')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commande entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ECommerceECommerceBundle:BackEnd/Commande:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Commande entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ECommerceECommerceBundle:Commande')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commande entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ECommerceECommerceBundle:BackEnd/Commande:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Commande entity.
    *
    * @param Commande $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Commande $entity)
    {
        $form = $this->createForm(new CommandeType(), $entity, array(
            'action' => $this->generateUrl('admin_commande_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Commande entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ECommerceECommerceBundle:Commande')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commande entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_commande_edit', array('id' => $id)));
        }

        return $this->render('ECommerceECommerceBundle:BackEnd/Commande:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Commande entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ECommerceECommerceBundle:Commande')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Commande entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_commande'));
    }

    /**
     * Creates a form to delete a Commande entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_commande_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}