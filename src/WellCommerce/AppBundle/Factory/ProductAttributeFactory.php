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

namespace WellCommerce\AppBundle\Factory;

use WellCommerce\AppBundle\Entity\ProductAttribute;
use WellCommerce\AppBundle\Entity\DiscountablePrice;
use WellCommerce\AppBundle\Factory\AbstractFactory;

/**
 * Class ProductAttributeFactory
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class ProductAttributeFactory extends AbstractFactory
{
    /**
     * @return \WellCommerce\AppBundle\Entity\ProductAttributeInterface
     */
    public function create()
    {
        $productAttribute = new ProductAttribute();
        $productAttribute->setHierarchy(0);
        $productAttribute->setModifierType('%');
        $productAttribute->setModifierValue(100);
        $productAttribute->setSellPrice(new DiscountablePrice());
        $productAttribute->setAvailability(null);

        return $productAttribute;
    }
}