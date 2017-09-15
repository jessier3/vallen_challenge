<?php
namespace MagazineBundle\Controller;

// setup the autoloading
require_once __DIR__.'/../../../vendor/autoload.php';

// setup Propel
require_once __DIR__.'/config.php';
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MagazineBundle\MagazineBundle\Base\Publication;



class DefaultController extends Controller
{
	
	 /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
	    $publication = new Publication();
		$publication->setName('Home and Garden');
		$publication->save();
        return $this->render('MagazineBundle:Default:index.html.twig', array('name' => $name));
    }
}
