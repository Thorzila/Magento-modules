<?php
namespace OmniPro\Blog\Block\Adminhtml\Blog\Edit;

class GenericButton
{
    /**
     * @param \Magento\Backend\Block\Widget\Context
     */
    private $context;

    /**
     * Registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry
    ) {
        $this->context = $context;
        $this->registry = $registry;
    }

    public function getId()
    {
        $blog = $this->registry->registry('blog');
        return $blog ? $blog->getId() : null;
    }

    public function getBackUrl() {
        return $this->getUrl('*/blog/');
    }

    public function getUrl($route = '', $params = []) {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}