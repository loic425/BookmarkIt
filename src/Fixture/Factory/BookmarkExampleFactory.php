<?php

/*
 * This file is part of BookmarkIt.
 *
 * (c) Loïc Frémont
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Fixture\Factory;

use App\Entity\Bookmark;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookmarkExampleFactory extends AbstractExampleFactory
{
    /**
     * @var FactoryInterface
     */
    private $bookMarkFactory;

    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * @var OptionsResolver
     */
    private $optionsResolver;

    /**
     * AdminUserExampleFactory constructor.
     *
     * @param FactoryInterface $bookMarkFactory
     */
    public function __construct(FactoryInterface $bookMarkFactory)
    {
        $this->bookMarkFactory = $bookMarkFactory;

        $this->faker = \Faker\Factory::create();
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions($this->optionsResolver);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefault('type', function (Options $options) {
                return $this->faker->randomElement([Bookmark::TYPE_VIDEO, Bookmark::TYPE_PHOTO]);
            })

            ->setDefault('title', function (Options $options) {
                return ucfirst($this->faker->words(3, true));
            })

            ->setDefault('url', function (Options $options) {
                if (Bookmark::TYPE_PHOTO === $options['type']) {
                    return $this->faker->imageUrl();
                }

                return $this->faker->url;
            })

            ->setDefault('author_name', function (Options $options) {
                return $this->faker->firstName.' '.$this->faker->lastName;
            })

            ->setDefault('added_at', function (Options $options) {
                return $this->faker->dateTimeBetween('-1 year', 'yesterday');
            })
            ->setAllowedTypes('added_at', ['null', 'string', \DateTimeInterface::class])
            ->setNormalizer('added_at', function (Options $options, $addedAt) {
                if (!is_string($addedAt)) {
                    return $addedAt;
                }

                return new \DateTime($addedAt);
            })

            ->setDefault('width', function (Options $options) {
                if (Bookmark::TYPE_PHOTO === $options['type']) {
                    $size = getimagesize($options['url']);

                    return $size[0];
                }

                return $this->faker->randomElement([1024, 1600, 1920]);
            })

            ->setDefault('height', function (Options $options) {
                if (Bookmark::TYPE_PHOTO === $options['type']) {
                    $size = getimagesize($options['url']);

                    return $size[1];
                }

                return $this->faker->randomElement([1024, 1600, 1920]);
            })

            ->setDefault('duration', function (Options $options) {
                if (Bookmark::TYPE_VIDEO === $options['type']) {
                    return $this->faker->numberBetween(90, 180);
                }

                return null;
            })
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $options = [])
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var Bookmark $bookMark */
        $bookMark = $this->bookMarkFactory->createNew();
        $bookMark->setType($options['type']);
        $bookMark->setTitle($options['title']);
        $bookMark->setUrl($options['url']);
        $bookMark->setAuthorName($options['author_name']);
        $bookMark->setAddedAt($options['added_at']);
        $bookMark->setWidth($options['width']);
        $bookMark->setHeight($options['height']);
        $bookMark->setDuration($options['duration']);

        return $bookMark;
    }
}
