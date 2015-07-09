<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AlbumsController extends Controller
{
    /**
     * @Route("/")
     * @Route("/albums")
     */
    public function indexAction()
    {
        return $this->render('albums/index.html.twig', [
            'albums' => $this->getDoctrine()->getRepository('DigitalMedia:Album\Album')->findAll()
        ]);
    }

    /**
     * @Route("/albums/create")
     */
    public function createAction(Request $request)
    {
        $title = 'Album test';
        $artistId = 1;

        $this->get('album_application_service')->createAlbum($title, $artistId);

        $this->addFlash(
            'notice',
            'Album created successfully!'
        );

        return $this->redirectToRoute('app_albums_index');
    }
}