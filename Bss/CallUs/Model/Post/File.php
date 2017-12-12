<?php

namespace Bss\CallUs\Model\Post;

class File
{
    protected $_subDir = 'bss/callus/post';
    protected $_urlBuilder;
    protected $_fileSystem;
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\Filesystem $fileSystem
    )
    {
        $this->_urlBuilder = $urlBuilder;
        $this->_fileSystem = $fileSystem;
    }
    public function getBaseUrl()
    {
        return $this->_urlBuilder->getBaseUrl(['_type' => \Magento\Framework\UrlInterface::URL_TYPE_MEDIA]).$this->_subDir.'/file';
    }
    public function getBaseDir()
    {
        return $this->_fileSystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)->getAbsolutePath($this->_subDir.'/file');
    }
}
