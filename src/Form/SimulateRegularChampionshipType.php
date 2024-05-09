<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SimulateRegularChampionshipType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('simulate_regular_championship', SubmitType::class, [
                'label' => 'Simulate Regular Championship',
                'attr' => ['class' => 'btn btn-primary'],
            ])
            ->setMethod('POST')
            ->setAction('/championship/simulate-regular');
    }
}