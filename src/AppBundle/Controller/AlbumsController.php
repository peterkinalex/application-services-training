<?php

namespace AppBundle\Controller;

use Chinook\DigitalMedia\Application\Album\ChangeNameCommand;
use Chinook\DigitalMedia\Application\Album\CreateAlbumCommand;
use Chinook\DigitalMedia\Application\Album\DeleteAlbumCommand;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AlbumsController extends Controller
{
    /**
     * @Route("/")
     * @Route("/albums")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('albums/index.html.twig', [
            'albums' => $this->getDoctrine()->getRepository('DigitalMedia:Album\Album')->findAll()
        ]);
    }

    /**
     * @Route("/albums")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $this->get('tactician.commandbus.transactional')->handle(
            new CreateAlbumCommand(
                $request->request->get('title'),
                $request->request->get('artist_id')
            )
        );

        $this->addFlash('notice', 'Album created successfully!');
        return $this->redirectToRoute('app_albums_index');
    }

    /**
     * @Route("/albums/{id}")
     * @Method("DELETE")
     */
    public function removeAction($id)
    {
        $this->get('tactician.commandbus.transactional')->handle(
            new DeleteAlbumCommand($id)
        );

        $this->addFlash('notice', 'Album removed successfully!');
        return $this->redirectToRoute('app_albums_index');
    }

    /**
     * @Route("/albums/{id}")
     * @Method("PUT")
     */
    public function updateAction($id, Request $request)
    {
        $this->get('tactician.commandbus.queued')->handle(
            new ChangeNameCommand(
                $id,
                $request->request->get('title')
            )
        );

        $this->addFlash(
            'notice',
            'The album update has been queued successfully!'
        );

        return $this->redirectToRoute('app_albums_index');
    }
}