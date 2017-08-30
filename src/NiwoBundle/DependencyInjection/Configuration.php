<?php

/**
 * 读取你我后台配置
 * @author renshan<1005110700@qq.com>
 */

namespace NiwoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder    = new TreeBuilder;
        $rootNode       = $treeBuilder->root('niwo');

        $rootNode->children()
            ->arrayNode('chain')->children()
            ->scalarNode("register_api")->isRequired()->end()
            ->scalarNode("status_api")->isRequired()->end();

        return $treeBuilder;
    }
}