<?php

/*
 * This file is part of BookmarkIt.
 *
 * (c) Loïc Frémont
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form\Type;

use App\Entity\Bookmark;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookmarkType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('title', TextType::class, [
                'label' => 'sylius.ui.title',
            ])
            ->add('url', TextType::class, [
                'label' => 'app.ui.url',
            ])
            ->add('authorName', TextType::class, [
                'label' => 'sylius.ui.author',
            ])
            ->add('width', NumberType::class, [
                'label' => 'app.ui.width',
            ])
            ->add('height', NumberType::class, [
                'label' => 'app.ui.height',
            ])
            ->add('duration', NumberType::class, [
                'label' => 'app.ui.duration',
            ])
            ->add('tags', CollectionType::class, [
                'label' => 'app.ui.tags',
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'validation_groups' => function (Options $options) {
                return Bookmark::validationGroups($options['data']);
            }
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_bookmark';
    }

}
