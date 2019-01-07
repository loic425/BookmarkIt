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
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BookmarkType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $options['validation_groups'] = Bookmark::validationGroups($options['data']);

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
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_bookmark';
    }

}
