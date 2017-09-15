<?php
namespace MagazineBundle\Form;
require_once __DIR__.'/../../../vendor/autoload.php';

// setup Propel
require_once __DIR__.'/../Controller/config.php';
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use MagazineBundle\MagazineBundle\Base\Issue;
use MagazineBundle\MagazineBundle\Base\IssueQuery;
use MagazineBundle\Form\IssueType;
use MagazineBundle\MagazineBundle\Base\PublicationQuery;
use MagazineBundle\MagazineBundle\Base\Publication;

class IssueType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    $publications = PublicationQuery::create()->find();
	    $pubChoice = [];
	    foreach($publications as $p) {
		  $pubChoice[$p->getId()] = $p->getName();
		}
		
        $builder
            ->add('number')
            ->add('datePublication', 'date', array(
                'years' => range(date('Y'), date('Y', strtotime('-50 years'))),
                'required' => TRUE,
            ))
            ->add('publication_id', 'choice', array(
				'choices'  =>$pubChoice
			))
        ;
    }
    
     public function getName()
    {
        return 'magazinebundle_issue';
    }
    
    public function getDatePublication()
    {
        return 'magazinebundle_issue';
    }
    
    public function getPublication()
    {
        return 'magazinebundle_issue';
    }
}
