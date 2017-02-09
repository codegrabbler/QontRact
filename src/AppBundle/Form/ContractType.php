<?php

namespace AppBundle\Form;

use JMS\TranslationBundle\Model\Message;
use JMS\TranslationBundle\Translation\TranslationContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContractType extends AbstractType implements TranslationContainerInterface
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => 'contract.name'])
            ->add('description', null, ['label' => 'contract.desc'])
            ->add('startDate', null, ['label' => 'contract.startDate'])
            ->add('endDate', null, ['required' => false, 'label' => 'contract.endDate'])
            ->add('active', null, ['required' => false, 'label' => 'contract.active'])
            ->add('token', null, ['label' => 'contract.token']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Contract',
            'translation_domain' => 'forms'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_contract';
    }


    /**
     * Returns an array of messages.
     *
     * @return array<Message>
     */
    public static function getTranslationMessages()
    {
        return [
            new Message('contract.name','forms'),
            new Message('contract.desc','forms'),
            new Message('contract.startDate','forms'),
            new Message('contract.endDate','forms'),
            new Message('contract.active','forms'),
            new Message('contract.token','forms')
        ];
    }
}
