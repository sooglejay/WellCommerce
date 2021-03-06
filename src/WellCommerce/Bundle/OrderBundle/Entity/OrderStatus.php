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
namespace WellCommerce\Bundle\OrderBundle\Entity;

use Knp\DoctrineBehaviors\Model\Blameable\Blameable;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Knp\DoctrineBehaviors\Model\Translatable\Translatable;
use WellCommerce\Bundle\CoreBundle\Behaviours\Enableable\EnableableTrait;
use WellCommerce\Bundle\CoreBundle\Entity\IdentifiableTrait;

/**
 * Class OrderStatus
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class OrderStatus implements OrderStatusInterface
{
    use IdentifiableTrait;
    use Timestampable;
    use Blameable;
    use Translatable;
    use EnableableTrait;
    
    /**
     * @var OrderStatusGroupInterface
     */
    protected $orderStatusGroup;
    
    /**
     * @var string
     */
    protected $colour;
    
    /**
     * {@inheritdoc}
     */
    public function getOrderStatusGroup() : OrderStatusGroupInterface
    {
        return $this->orderStatusGroup;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setOrderStatusGroup(OrderStatusGroupInterface $orderStatusGroup)
    {
        $this->orderStatusGroup = $orderStatusGroup;
    }
    
    /**
     * @return string
     */
    public function getColour()
    {
        return $this->colour;
    }
    
    /**
     * @param string $colour
     */
    public function setColour(string $colour)
    {
        $this->colour = $colour;
    }
}
