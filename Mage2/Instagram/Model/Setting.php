<?php

namespace Mage2\Instagram\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Setting
{
    const Mage2_INSTAGRAM_ENABLE = 'instagramsection/instagramgroup/active';
    const Mage2_INSTAGRAM_MODE = 'instagramsection/instagramgroup/mode';
    const Mage2_INSTAGRAM_USERID = 'instagramsection/instagramgroup/userid';
    const Mage2_INSTAGRAM_TOKEN = 'instagramsection/instagramgroup/accesstoken';
    const Mage2_INSTAGRAM_RESOLUTION = 'instagramsection/instagramgroup/resolution';
    const Mage2_INSTAGRAM_IMAGENUMBER = 'instagramsection/instagramgroup/image-number';

    /**
     * @var \Magento\Framework\Encryption\EncryptorInterface
     */
    protected $encryptor;

    /**
     * Setting constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\Encryption\EncryptorInterface $encryptor
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Encryption\EncryptorInterface $encryptor
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->encryptor = $encryptor;
    }

    /**
     * @param $config_path
     * @return mixed
     */
    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return boolean
     *
     */
    public function isEnable()
    {
        return $this->getConfig(self::Mage2_INSTAGRAM_ENABLE);
    }

    /**
     * @return boolean
     *
     */
    public function isMode()
    {
        return $this->getConfig(self::Mage2_INSTAGRAM_MODE);
    }

    /**
     * Retrive UserID of InstagramApp
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->encryptor->decrypt($this->getConfig(self::Mage2_INSTAGRAM_USERID));
    }

    /**
     * Retrive Accesstoken of InstagramApp
     *
     * @return string
     */
    public function getAccessToken()
    {
        return  $this->encryptor->decrypt($this->getConfig(self::Mage2_INSTAGRAM_TOKEN));
    }

    /**
     * Retrive Image Resoution value
     *
     * @return string
     */
    public function getImageResultion()
    {
        return  $this->getConfig(self::Mage2_INSTAGRAM_RESOLUTION);
    }

    /**
     * Retrive Number of images need to retrive
     *
     * @return string
     */
    public function getImageNumber()
    {
        return  $this->getConfig(self::Mage2_INSTAGRAM_IMAGENUMBER);
    }
}
