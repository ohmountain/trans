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
        $rootNode       = $treeBuilder->root("niwo");

        $rootNode->children()
            ->arrayNode("chain")->children()
                    ->scalarNode("register_api")->isRequired()->end()
                    ->scalarNode("status_api")->isRequired()->end()
                    ->scalarNode("send_cert_api")->isRequired()->end()
                    ->scalarNode("block_info_api")->isRequired()->end()
                    ->integerNode("timeout")->min(1)->max(20)->end()
                ->end()
            ->end()
            ->arrayNode("sanbian")->children()
                ->scalarNode("land")->isRequired()->end()
                ->scalarNode("woodland")->isRequired()->end()
                ->scalarNode("housing")->isRequired()->end()
                ->scalarNode("credit")->isRequired()->end()
                ->scalarNode("discounts")->isRequired()->end()
                ->integerNode("timeout")->min(1)->max(20)->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}