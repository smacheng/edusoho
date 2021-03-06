<?php

namespace Biz\Marketing\Service\Impl;

use Biz\Course\Service\Impl\MemberServiceImpl;

class MarketingMemberServiceImpl extends MemberServiceImpl
{
    protected function createOrder($courseId, $userId, $data)
    {
        $courseProduct = $this->getOrderFacadeService()->getOrderProduct(
            'course',
            array(
                'targetId' => $courseId,
            )
        );

        $courseProduct->originPrice = $data['originPrice'];
        $data['targetType'] = 'course';
        $params = array(
            'created_reason' => $data['remark'],
            'source' => $data['source'],
            'create_extra' => $data,
            'deducts' => empty($data['deducts']) ? array() : $data['deducts'],
        );

        return $this->getOrderFacadeService()->createSpecialOrder($courseProduct, $userId, $params);
    }
}
