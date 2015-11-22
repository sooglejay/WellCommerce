<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\AppBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use WellCommerce\AppBundle\Helper\Translator\TranslatorHelperInterface;

/**
 * Class AbstractContainerAware
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
abstract class AbstractContainerAware extends ContainerAware
{
    /**
     * Returns true if the service id is defined.
     *
     * @param string $id The service id
     *
     * @return bool true if the service id is defined, false otherwise
     */
    public function has($id)
    {
        return $this->container->has($id);
    }

    /**
     * Gets a service by id.
     *
     * @param string $id The service id
     *
     * @return object Service
     */
    public function get($id)
    {
        return $this->container->get($id);
    }

    /**
     * Translates a string using the translation service
     *
     * @param string $id Message to translate
     *
     * @return string The message
     */
    public function trans($id, $params = [], $domain = TranslatorHelperInterface::DEFAULT_TRANSLATION_DOMAIN)
    {
        return $this->getTranslatorHelper()->trans($id, $params, $domain);
    }

    /**
     * Shortcut to get param from current route
     *
     * @param string $index
     *
     * @return int|string|null
     */
    public function getParam($index)
    {
        if ($this->container->isScopeActive('request')) {
            return $this->container->get('request')->attributes->get($index);
        }

        return null;
    }

    /**
     * Returns themes directory path
     * If theme folder name is passed, full directory path pointing to it will be returned
     *
     * @param string $themeFolder
     *
     * @return string
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     */
    public function getThemeDir($themeFolder = '')
    {
        $kernelDir = $this->getKernel()->getRootDir();
        $webDir    = $kernelDir . '/../web';

        if (strlen($themeFolder)) {
            $dir = $webDir . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . $themeFolder;
        } else {
            $dir = $webDir . DIRECTORY_SEPARATOR . 'themes';
        }

        if (!is_dir($dir)) {
            throw new FileException(sprintf('Directory "%s" not found.', $dir));
        }

        return $dir;
    }

    /**
     * @return \Symfony\Component\HttpKernel\KernelInterface
     */
    public function getKernel()
    {
        return $this->get('kernel');
    }

    /**
     * @return \WellCommerce\AppBundle\Helper\Translator\TranslatorHelperInterface
     */
    public function getTranslatorHelper()
    {
        return $this->get('translator.helper');
    }

    /**
     * @return \WellCommerce\AppBundle\Helper\Flash\FlashHelperInterface
     */
    public function getFlashHelper()
    {
        return $this->get('flash.helper');
    }

    /**
     * @return \WellCommerce\AppBundle\Helper\Doctrine\DoctrineHelperInterface
     */
    public function getDoctrineHelper()
    {
        return $this->get('doctrine.helper');
    }

    /**
     * @return \WellCommerce\AppBundle\Helper\Request\RequestHelperInterface
     */
    public function getRequestHelper()
    {
        return $this->get('request.helper');
    }

    /**
     * @return \WellCommerce\AppBundle\Helper\Router\RouterHelperInterface
     */
    public function getRouterHelper()
    {
        return $this->get('router.helper');
    }

    /**
     * @return \WellCommerce\AppBundle\Helper\Image\ImageHelperInterface
     */
    public function getImageHelper()
    {
        return $this->get('image.helper');
    }

    /**
     * @return \WellCommerce\AppBundle\Entity\Locale[]
     */
    public function getLocales()
    {
        return $this->get('locale.repository')->findAll();
    }

    /**
     * @return \WellCommerce\AppBundle\Helper\CurrencyHelperInterface
     */
    public function getCurrencyHelper()
    {
        return $this->get('currency.helper');
    }

    /**
     * @return \WellCommerce\AppBundle\Helper\Security\SecurityHelperInterface
     */
    public function getSecurityHelper()
    {
        return $this->get('security.helper');
    }

    /**
     * @return \WellCommerce\AppBundle\Helper\Mailer\MailerHelperInterface
     */
    public function getMailerHelper()
    {
        return $this->get('mailer.helper');
    }

    /**
     * @return \WellCommerce\AppBundle\Helper\Templating\TemplatingHelperInterface
     */
    public function getTemplatingelper()
    {
        return $this->get('templating.helper');
    }

    /**
     * @return \WellCommerce\AppBundle\Helper\Validator\ValidatorHelperInterface
     */
    public function getValidatorHelper()
    {
        return $this->get('validator.helper');
    }

    /**
     * @return \WellCommerce\AppBundle\Helper\ProductLayeredNavigationHelperInterface
     */
    public function getLayeredNavigationHelper()
    {
        return $this->get('product_layered_navigation.helper');
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    public function getEntityManager()
    {
        return $this->getDoctrineHelper()->getEntityManager();
    }

    /**
     * @return object|null
     */
    public function getUser()
    {
        return $this->getSecurityHelper()->getUser();
    }
}