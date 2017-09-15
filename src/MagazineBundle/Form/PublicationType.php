<?php
namespace MagazineBundle\Form;
require_once __DIR__.'/../../../vendor/autoload.php';

// setup Propel
require_once __DIR__.'/../Controller/config.php';
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use MagazineBundle\MagazineBundle\Base\Publication;
use MagazineBundle\MagazineBundle\Base\PublicationQuery;
use MagazineBundle\Form\PublicationType;

class PublicationType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
        ;
    }
   

    /**
     * @return string
     */
    public function getName()
    {
        return 'magazinebundle_publication';
    }
}
