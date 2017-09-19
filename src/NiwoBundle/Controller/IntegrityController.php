<?php

namespace NiwoBundle\Controller;

use NiwoBundle\Entity\Integrity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Integrity controller.
 *
 * @Route("integrity")
 */
class IntegrityController extends Controller
{
    /**
     * Lists all integrity entities.
     *
     * @Route("/", name="integrity_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $integrities = $em->getRepository('NiwoBundle:Integrity')->findAll();

        return $this->render('integrity/index.html.twig', array(
            'integrities' => $integrities,
        ));
    }

    /**
     * Creates a new integrity entity.
     *
     * @Route("/new", name="integrity_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $integrity = new Integrity();
        $form = $this->createForm('NiwoBundle\Form\IntegrityType', $integrity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $integrity->setCert(hash("sha256", uniqid()));
            $em->persist($integrity);
            $em->flush();

            return $this->redirectToRoute('integrity_show', array('id' => $integrity->getId()));
        }

        return $this->render('integrity/new.html.twig', array(
            'integrity' => $integrity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a integrity entity.
     *
     * @Route("/{id}", name="integrity_show")
     * @Method("GET")
     */
    public function showAction(Integrity $integrity)
    {
        $deleteForm = $this->createDeleteForm($integrity);

        return $this->render('integrity/show.html.twig', array(
            'integrity' => $integrity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing integrity entity.
     *
     * @Route("/{id}/edit", name="integrity_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Integrity $integrity)
    {
        $deleteForm = $this->createDeleteForm($integrity);
        $editForm = $this->createForm('NiwoBundle\Form\IntegrityType', $integrity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('integrity_edit', array('id' => $integrity->getId()));
        }

        return $this->render('integrity/edit.html.twig', array(
            'integrity' => $integrity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a integrity entity.
     *
     * @Route("/{id}", name="integrity_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Integrity $integrity)
    {
        $form = $this->createDeleteForm($integrity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($integrity);
            $em->flush();
        }

        return $this->redirectToRoute('integrity_index');
    }

    /**
     * Creates a form to delete a integrity entity.
     *
     * @param Integrity $integrity The integrity entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Integrity $integrity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('integrity_delete', array('id' => $integrity->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
