<?php

namespace PMI\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PMI\TestBundle\Entity\Order;
use PMI\TestBundle\Form\OrderType;
use PMI\TestBundle\Entity\ProductOrder;
use PMI\TestBundle\Form\ProductOrderType;


/**
 * Order controller.
 *
 * @Route("/order")
 */
class OrderController extends Controller
{

    /**
     * Lists all Order entities.
     *
     * @Route("/", name="test_order")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('PMITestBundle:Order')->findAll();

        return array( 'entities' => $entities );
    }

    /**
     * Finds and displays a Order entity.
     *
     * @Route("/{id}/show", name="test_order_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PMITestBundle:Order')->find($id);

        if(!$entity)
        {
            throw $this->createNotFoundException('Unable to find Order entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity ,
            'delete_form' => $deleteForm->createView() , );
    }

    /**
     * Displays a form to create a new Order entity.
     *
     * @Route("/new", name="test_order_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Order();
        $form   = $this->createForm(new OrderType() , $entity);

        return array(
            'entity' => $entity ,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Order entity.
     *
     * @Route("/create", name="test_order_create")
     * @Method("post")
     * @Template("PMITestBundle:Order:new.html.twig")
     */
    public function createAction()
    {
        $order   = new Order();
        $request = $this->getRequest();
        $form    = $this->createForm(new OrderType() , $order);
        $form->bindRequest($request);

        $em = $this->getDoctrine()->getEntityManager();

        if($form->isValid())
        {

            $em->persist($order);
            $em->flush();

            return $this->redirect($this->generateUrl('test_order_show' , array( 'id' => $order->getId() )));
        }

        return array(
            'entity' => $order ,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Order entity.
     *
     * @Route("/{id}/edit", name="test_order_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PMITestBundle:Order')->find($id);

        if(!$entity)
        {
            throw $this->createNotFoundException('Unable to find Order entity.');
        }


        $editForm = $this->createForm(new OrderType() , $entity , array( 'em' => $em ));

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity ,
            'edit_form'   => $editForm->createView() ,
            'delete_form' => $deleteForm->createView() ,
        );
    }

    /**
     * Edits an existing Order entity.
     *
     * @Route("/{id}/update", name="test_order_update")
     * @Method("post")
     * @Template("PMITestBundle:Order:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        /* @var $entity Order */
        $entity = $em->getRepository('PMITestBundle:Order')->find($id);

        if(!$entity)
        {
            throw $this->createNotFoundException('Unable to find Order entity.');
        }

        $editForm   = $this->createForm(new OrderType() , $entity);
        $deleteForm = $this->createDeleteForm($id);

        $previousCollections = $entity->getPo();
        $previousCollections = $previousCollections->toArray();

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        foreach($previousCollections as $po)
        {
            $entity->removePo($po);
        }

        if($editForm->isValid())
        {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('test_order_edit' , array( 'id' => $id )));
        }

        return array(
            'entity'      => $entity ,
            'edit_form'   => $editForm->createView() ,
            'delete_form' => $deleteForm->createView() ,
        );
    }

    /**
     * Deletes a Order entity.
     *
     * @Route("/{id}/delete", name="test_order_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form    = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if($form->isValid())
        {
            $em     = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('PMITestBundle:Order')->find($id);

            if(!$entity)
            {
                throw $this->createNotFoundException('Unable to find Order entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('test_order'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array( 'id' => $id ))
                        ->add('id' , 'hidden')
                        ->getForm()
        ;
    }


}
