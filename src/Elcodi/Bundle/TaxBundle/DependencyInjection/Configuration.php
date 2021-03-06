<?php

/*
 * This file is part of the Elcodi package.
 *
 * Copyright (c) 2014 Elcodi.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author Aldo Chiecchia <zimage@tiscali.it>
 */

namespace Elcodi\Bundle\TaxBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

use Elcodi\Bundle\CoreBundle\DependencyInjection\Abstracts\AbstractConfiguration;

/**
 * This is the class that validates and merges configuration from your app/config files
 */
class Configuration extends AbstractConfiguration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root($this->extensionName);

        $rootNode
            ->children()
                ->arrayNode('mapping')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->append($this->addMappingNode(
                            'tax',
                            'Elcodi\Component\Tax\Entity\Tax',
                            '@ElcodiTaxBundle/Resources/config/doctrine/Tax.orm.yml',
                            'default',
                            true
                        ))
                        ->append($this->addMappingNode(
                            'tax_group',
                            'Elcodi\Component\Tax\Entity\TaxGroup',
                            '@ElcodiTaxBundle/Resources/config/doctrine/TaxGroup.orm.yml',
                            'default',
                            true
                        ))
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
