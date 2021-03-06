<?php

namespace DCS\AddressComponent\TextualBundle;

use DCS\AddressComponent\TextualBundle\DependencyInjection\Compiler\AddressTextualComponentCompilerPass;
use Doctrine\Bundle\CouchDBBundle\DependencyInjection\Compiler\DoctrineCouchDBMappingsPass;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Doctrine\Bundle\MongoDBBundle\DependencyInjection\Compiler\DoctrineMongoDBMappingsPass;
use Doctrine\Bundle\PHPCRBundle\DependencyInjection\Compiler\DoctrinePhpcrMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DCSAddressComponentTextualBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AddressTextualComponentCompilerPass());

        $modelDir = realpath(__DIR__.'/Resources/config/doctrine/model');
        $mappings = array(
            $modelDir => 'DCS\AddressComponent\TextualBundle\Model',
        );

        $ormCompilerClass = 'Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass';
        if (class_exists($ormCompilerClass)) {
            $container->addCompilerPass(
                DoctrineOrmMappingsPass::createXmlMappingDriver($mappings)
            );
        }

        /* Not yet implemented */

//        $mongoCompilerClass = 'Doctrine\Bundle\MongoDBBundle\DependencyInjection\Compiler\DoctrineMongoDBMappingsPass';
//        if (class_exists($mongoCompilerClass)) {
//            $container->addCompilerPass(
//                DoctrineMongoDBMappingsPass::createXmlMappingDriver($mappings)
//            );
//        }
//
//        $couchCompilerClass = 'Doctrine\Bundle\CouchDBBundle\DependencyInjection\Compiler\DoctrineCouchDBMappingsPass';
//        if (class_exists($couchCompilerClass)) {
//            $container->addCompilerPass(
//                DoctrineCouchDBMappingsPass::createXmlMappingDriver($mappings)
//            );
//        }
//
//        $phpcrCompilerClass = 'Doctrine\Bundle\PHPCRBundle\DependencyInjection\Compiler\DoctrinePhpcrMappingsPass';
//        if (class_exists($phpcrCompilerClass)) {
//            $container->addCompilerPass(
//                DoctrinePhpcrMappingsPass::createXmlMappingDriver($mappings)
//            );
//        }
    }
}
