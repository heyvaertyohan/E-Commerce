<?php

namespace ECommerce\UtilisateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UtilisateursAdressesType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rue')
            ->add('cp')
            ->add('ville')
            ->add('pays')
            ->add('complement',null,array('required' => false))
            //->add('utilisateur')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ECommerce\UtilisateurBundle\Entity\UtilisateurAdresse'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ecommerce_utilisateurbundle_utilisateursadresses';
    }
}
