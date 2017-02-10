<?php

namespace AppBundle\Form;

use AppBundle\Entity\Contract;
use JMS\TranslationBundle\Model\Message;
use JMS\TranslationBundle\Translation\TranslationContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContractCustomerType extends AbstractType implements TranslationContainerInterface
{
    /**
     * Returns an array of messages.
     *
     * @return array<Message>
     */
    public static function getTranslationMessages()
    {
        return [
            new Message('contract.name', 'forms'),
            new Message('contract.desc', 'forms'),
            new Message('contract.startDate', 'forms'),
            new Message('contract.endDate', 'forms'),
            new Message('contract.active', 'forms'),
            new Message('contract.token', 'forms'),
            new Message('contract.interval', 'forms'),
            new Message('contract.paymentInterval', 'forms'),
            new Message('contract.totalAmount', 'forms'),
            new Message('contract.paymentAmount', 'forms'),
            new Message('interval.onetime', 'forms'),
            new Message('interval.month', 'forms'),
            new Message('interval.quarter', 'forms'),
            new Message('interval.year', 'forms')
        ];
    }

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
            ->add('totalAmount', null, ['label' => 'contract.totalAmount'])
            ->add('totalInterval', ChoiceType::class, [
                'multiple' => false,
                'expanded' => false,
                'label' => 'contract.interval',
                'choices' => [
                    'interval.onetime' => Contract::INTERVAL_ONETIME,
                    'interval.month' => Contract::INTERVAL_MONTH,
                    'interval.quarter' => Contract::INTERVAL_QUARTER,
                    'interval.year' => Contract::INTERVAL_YEAR
                ]

            ])
            ->add('paymentAmount', null, ['label' => 'contract.paymentAmount'])
            ->add('paymentInterval', ChoiceType::class, [
                'multiple' => false,
                'expanded' => false,
                'label' => 'contract.paymentInterval',
                'choices' => [
                    'interval.onetime' => Contract::INTERVAL_ONETIME,
                    'interval.month' => Contract::INTERVAL_MONTH,
                    'interval.quarter' => Contract::INTERVAL_QUARTER,
                    'interval.year' => Contract::INTERVAL_YEAR
                ]

            ])
            ->add('active', null, ['required' => false, 'label' => 'contract.active'])
            ;
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
}
