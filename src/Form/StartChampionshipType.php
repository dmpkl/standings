<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StartChampionshipType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start_championship', SubmitType::class, [
                'label' => 'Start Championship',
                'attr' => ['class' => 'btn btn-primary'],
            ])
            ->setMethod('POST')
            ->setAction('/standings/refresh');
    }
}