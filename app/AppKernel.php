<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel {

    public function registerBundles() {
	$bundles = array(
	    new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
	    new Symfony\Bundle\SecurityBundle\SecurityBundle(),
	    new Symfony\Bundle\TwigBundle\TwigBundle(),
	    new Symfony\Bundle\MonologBundle\MonologBundle(),
	    new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
	    new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
	    new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
	    new AppBundle\AppBundle(),
	    // These are the other bundles the SonataAdminBundle relies on
	    new Sonata\CoreBundle\SonataCoreBundle(),
	    new Sonata\BlockBundle\SonataBlockBundle(),
	    new Knp\Bundle\MenuBundle\KnpMenuBundle(),
	    // And finally, the storage and SonataAdminBundle
	    new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
	    new Sonata\AdminBundle\SonataAdminBundle(),
	    new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
	    // ...
	    // You have 2 options to initialize the SonataUserBundle in your AppKernel,
	    // you can select which bundle SonataUserBundle extends
	    // Most of the cases, you'll want to extend FOSUserBundle though ;)
	    // extend the ``FOSUserBundle``
	    new FOS\UserBundle\FOSUserBundle(),
	    new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
	    new Application\Sonata\UserBundle\ApplicationSonataUserBundle(),
	    new JMS\SerializerBundle\JMSSerializerBundle(),
	    new Sonata\MediaBundle\SonataMediaBundle(),
	    new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),
	    new Backend\PoiBundle\BackendPoiBundle(),
	    new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
	    new Sonata\ClassificationBundle\SonataClassificationBundle(),
	    new Application\Sonata\ClassificationBundle\ApplicationSonataClassificationBundle(),
	    new Backend\AdministracyjneBundle\BackendAdministracyjneBundle(),
	    new Backend\CommonBundle\BackendCommonBundle(),
	    new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
	    new Sonata\FormatterBundle\SonataFormatterBundle(),
	    new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
	    new A2lix\TranslationFormBundle\A2lixTranslationFormBundle(),
	);

	if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
	    $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
	    $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
	    $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
	    $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
	}

	return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader) {
	$loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
    }

}
