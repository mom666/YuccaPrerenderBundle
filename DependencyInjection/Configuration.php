<?php
/*
 * This file was delivered to you as part of the YuccaPrerenderBundle package.
 *
 * (c) Rémi JANOT <r.janot@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yucca\PrerenderBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    protected $defaultIgnoredExtensions=array(
        '.js',
        '.css',
        '.less',
        '.png',
        '.jpg',
        '.jpeg',
        '.gif',
        '.pdf',
        '.doc',
        '.txt',
        '.zip',
        '.mp3',
        '.rar',
        '.exe',
        '.wmv',
        '.doc',
        '.avi',
        '.ppt',
        '.mpg',
        '.mpeg',
        '.tif',
        '.wav',
        '.mov',
        '.psd',
        '.ai',
        '.xls',
        '.mp4',
        '.m4a',
        '.swf',
        '.dat',
        '.dmg',
        '.iso',
        '.flv',
        '.m4v',
        '.torrent',
    );

    // googlebot, yahoo, and bingbot are not in this list because
    // we support _escaped_fragment_ instead of checking user
    // agent for those crawlers
    protected $defaultCrawlerUserAgents = array(
        // 'googlebot',
        // 'yahoo',
        // 'bingbot',
        'baiduspider',
        'facebookexternalhit'
    );

    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('yucca_prerender');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
            ->children()
                ->scalarNode('backend_url')
                    ->defaultValue('http://prerender.herokuapp.com')
                    ->info('url of the prerender backend')
                    ->example('http://prerender.herokuapp.com')
                ->end()
                ->arrayNode('crawler_user_agents')
                    ->defaultValue($this->defaultCrawlerUserAgents)
                    ->prototype('scalar')->end()
                    ->info('which user agents are considered as crawlers')
                    ->example('[googlebot,yahoo,bingbot,baiduspider]')
                ->end()
                ->arrayNode('ignored_extensions')
                    ->defaultValue($this->defaultIgnoredExtensions)
                    ->prototype('scalar')->end()
                    ->info('extensions that are not forwarded to prerender backend')
                    ->example('[.css,.js]')
                ->end()
                ->arrayNode('whitelist_urls')
                    ->defaultValue(array())
                    ->prototype('scalar')->end()
                    ->info('whitelisted urls. Not routing keys, but urls')
                    ->example('[]')
                ->end()
                ->arrayNode('blacklist_urls')
                    ->defaultValue($this->defaultIgnoredExtensions)
                    ->prototype('scalar')->end()
                    ->info('whitelisted urls. Not routing keys, but urls')
                    ->example('[.css,.js]')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
