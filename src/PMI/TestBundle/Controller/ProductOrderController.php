<?php

namespace PMI\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PMI\TestBundle\Entity\ProductOrder;
use PMI\TestBundle\Form\ProductOrderType;

/**
 * ProductOrder controller.
 *
 * @Route("/po")
 */
class ProductOrderController extends Controller
{
    /**
     * Lists all ProductOrder entities.
     *
     * @Route("/", name="test_product_order")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('PMITestBundle:ProductOrder')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a ProductOrder entity.
     *
     * @Route("/{id}/show", name="test_product_order_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PMITestBundle:ProductOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductOrder entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new ProductOrder entity.
     *
     * @Route("/new", name="test_product_order_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ProductOrder();
        $form   = $this->createForm(new ProductOrderType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new ProductOrder entity.
     *
     * @Route("/create", name="test_product_order_create")
     * @Method("post")
     * @Template("PMITestBundle:ProductOrder:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new ProductOrder();
        $request = $this->getRequest();
        $form    = $this->createForm(new ProductOrderType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('test_product_order_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing ProductOrder entity.
     *
     * @Route("/{id}/edit", name="test_product_order_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PMITestBundle:ProductOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductOrder entity.');
        }

        $editForm = $this->createForm(new ProductOrderType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing ProductOrder entity.
     *
     * @Route("/{id}/update", name="test_product_order_update")
     * @Method("post")
     * @Template("PMITestBundle:ProductOrder:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PMITestBundle:ProductOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductOrder entity.');
        }

        $editForm   = $this->createForm(new ProductOrderType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('test_product_order_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a ProductOrder entity.
     *
     * @Route("/{id}/delete", name="test_product_order_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('PMITestBundle:ProductOrder')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductOrder entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('test_product_order'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
