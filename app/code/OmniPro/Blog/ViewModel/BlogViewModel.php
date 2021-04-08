<?php
namespace OmniPro\Blog\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class BlogViewModel implements ArgumentInterface
{
    protected \OmniPro\Blog\Model\Blog $_postModel;
    protected \OmniPro\Blog\Model\ResourceModel\Blog\Collection $_postCollection;
    protected \Magento\Framework\UrlInterface $_urlInterface;

    public function __construct(
        \OmniPro\Blog\Model\Blog $postModel,
        \OmniPro\Blog\Model\ResourceModel\Blog\Collection $postCollection,
        \Magento\Framework\UrlInterface $urlInterface
    )
    {
        $this->_postModel = $postModel;
        $this->_postCollection = $postCollection;
        $this->_urlInterface = $urlInterface;
    }

    public function getPostCollection(): \OmniPro\Blog\Model\ResourceModel\Blog\Collection
    {
        return $this->_postCollection;
    }

    public function savePost(): string
    {
        return $this->_urlInterface->getUrl('module/blog/save');
    }
}
