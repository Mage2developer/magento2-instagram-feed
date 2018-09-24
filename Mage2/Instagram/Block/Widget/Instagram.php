<?php

namespace Mage2\Instagram\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Instagram extends Template implements BlockInterface
{

    /**
     * @var \Mage2\Instagram\Model\Setting
     */
    protected $extSetting;

    protected $curl;

    /**
     * Instagram constructor.
     * @param Template\Context $context
     * @param \Mage2\Instagram\Model\Setting $extSetting
     * @param array $data
     */

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Mage2\Instagram\Model\Setting $extSetting,
        \Magento\Framework\HTTP\Client\Curl $curl,
        array $data = []
    ) {
        $this->extSetting = $extSetting;
        $this->curl = $curl;
        parent::__construct($context, $data);
        $this->setTemplate('widget/instagram.phtml');
    }

    /**
     * Return extension enable or disable
     * @return boolean
     */
    public function isEnable()
    {
        return $this->extSetting->isEnable();
    }

    /**
     * Return User id of Instagram feed
     * @return string
     */

    public function getUserId()
    {
        return $this->extSetting->getUserId();
    }

    /**
     * Return Access token of Instagram feed
     * @return string
     */

    public function getAccessToken()
    {
        return $this->extSetting->getAccessToken();
    }

    /**
     * Return image numbers counter
     * @return mixed
     */
    public function getImageCount()
    {
        return $this->extSetting->getImageNumber();
    }

    /**
     * Return image numbers counter
     * @return mixed
     */
    public function getImageResultion()
    {
        return $this->extSetting->getImageResultion();
    }

    /**
     * Return Instagram feed
     * @return mixed
     */

    public function getInstagramFeed()
    {

        if($this->extSetting->isMode()) {
            $url = 'https://api.instagram.com/v1/users/' . $this->getUserId() . '/media/recent/?access_token=' . $this->getAccessToken().'&count='.$this->getImageCount();
        } else {
            $url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token='.$this->getAccessToken();
        }
        
        $this->curl->get($url);
        $response = $this->curl->getBody();

        $instagramFeeds = json_decode($response);

        if (isset($instagramFeeds->meta->code) && $instagramFeeds->meta->code == 200) {
            if (!empty($instagramFeeds->data)) {
                return $instagramFeeds->data;
            }
        }
    }
}
