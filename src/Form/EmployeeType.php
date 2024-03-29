<?php
namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
//use Symfony\Component\Expression\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
//use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;



class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fio', TextType::class, ['label' => 'Ф.И.О'])
            ->add('bdate', BirthdayType::class, ['label' => 'Дата рождения'])
            ->add('imageFile', FileType::class, ['label' => 'Фото'])             
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
