<?php

/*
 * This file is part of BookmarkIt.
 *
 * (c) Loïc Frémont
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Fixture;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class BookmarkFixture extends AbstractResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'bookmark';
    }

    /**
     * {@inheritdoc}
     */
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode)
    {
        $resourceNode
            ->children()
                ->scalarNode('type')->cannotBeEmpty()->end()
                ->scalarNode('title')->cannotBeEmpty()->end()
                ->scalarNode('url')->cannotBeEmpty()->end()
                ->scalarNode('author_name')->cannotBeEmpty()->end()
                ->scalarNode('added_at')->cannotBeEmpty()->end()
                ->scalarNode('width')->cannotBeEmpty()->end()
                ->scalarNode('height')->cannotBeEmpty()->end()
                ->scalarNode('duration')->end()
        ;
    }
}
