<?php
namespace MagazineBundle\Controller;
// setup the autoloading
require_once __DIR__.'/../../../vendor/autoload.php';

// setup Propel
require_once __DIR__.'/config.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MagazineBundle\MagazineBundle\Base\Publication;
use MagazineBundle\MagazineBundle\Base\PublicationQuery;
use MagazineBundle\Form\PublicationType;

/**
 * Publication controller.
 *
 * @Route("/publication")
 */
class PublicationController extends Controller
{

    /**
     * Lists all Publication entities.
     *
     * @Route("/", name="publication")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
		$entities = PublicationQuery::create()->find();
		return $this->render('MagazineBundle:Publication:index.html.twig', array('entities' => $entities));
    }
    /**
     * Creates a new Publication entity.
     *
     * @Route("/", name="publication_create")
     * @Method("POST")
     * @Template("MagazineBundle:Publication:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Publication();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
		
        if ($form->isValid()) 
        {
			$entity->save();

            return $this->redirect($this->generateUrl('publication_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Publication entity.
     *
     * @param Publication $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Publication $entity)
    {
        $form = $this->createForm(new PublicationType(), $entity, array(
            'action' => $this->generateUrl('publication_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Publication entity.
     *
     * @Route("/new", name="publication_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Publication();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Publication entity.
     *
     * @Route("/{id}", name="publication_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        
        $entity = PublicationQuery::create()->findPK($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Publication entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $data =  array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
        return $this->render('MagazineBundle:Publication:show.html.twig', $data);
    }

    /**
     * Displays a form to edit an existing Publication entity.
     *
     * @Route("/{id}/edit", name="publication_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $entity = PublicationQuery::create()->findPK($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Publication entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Publication entity.
    *
    * @param Publication $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Publication $entity)
    {
        $form = $this->createForm(new PublicationType(), $entity, array(
            'action' => $this->generateUrl('publication_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Publication entity.
     *
     * @Route("/{id}", name="publication_update")
     * @Method("PUT")
     * @Template("MagazineBundle:Publication:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $entity = PublicationQuery::create()->findPK($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Publication entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->save();

            return $this->redirect($this->generateUrl('publication_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Publication entity.
     *
     * @Route("/{id}", name="publication_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity = PublicationQuery::create()->findPK($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Publication entity.');
            }

            $entity->delete();
           
        }

        return $this->redirect($this->generateUrl('publication'));
    }

    /**
     * Creates a form to delete a Publication entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('publication_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
