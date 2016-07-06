<?php

namespace Thruster\Bundle\SymfonyJsonBodyParserBundle;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class ThrusterSymfonyJsonBodyParserBundle
 *
 * @package Thruster\Bundle\SymfonyJsonBodyParserBundle
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 * @codeCoverageIgnore
 */
class ThrusterSymfonyJsonBodyParserBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(
            new class implements CompilerPassInterface
            {
                /**
                 * @inheritDoc
                 */
                public function process(ContainerBuilder $container)
                {
                    $definition = new Definition('Thruster\Bundle\SymfonyJsonBodyParserBundle\RequestListener');
                    $definition->addTag('kernel.event_subscriber');

                    $container->setDefinition('thruster_json_body_parser', $definition);
                }
            }
        );
    }

}
