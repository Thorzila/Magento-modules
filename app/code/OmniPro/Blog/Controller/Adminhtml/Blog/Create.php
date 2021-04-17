<?php
namespace OmniPro\Blog\Controller\Adminhtml\Blog;
use OmniPro\Blog\Model\Blog as Blog;

class Create extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'OmniPro_Blog::create';

    const PAGE_TITLE = 'Crear nuevo blog';

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
       \Magento\Backend\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        $resultPage->setActiveMenu(static::ADMIN_RESOURCE);
        $resultPage->addBreadcrumb(__(static::PAGE_TITLE), __(static::PAGE_TITLE));
        $resultPage->getConfig()->getTitle()->prepend(__(static::PAGE_TITLE));
        
        $this->_view->loadLayout();
        $this->_view->renderLayout();

        $blogsData = $this->getRequest()->getParam('blog');
        if(is_array($blogsData)) {
            $blog = $this->_objectManager->create(Blog::class);
            $blog->setData($blogsData)->save();
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index');
        }
    }

    // /**
    //  * Is the user allowed to view the page.
    // *
    // * @return bool
    // */
    // protected function _isAllowed()
    // {
    //     return $this->_authorization->isAllowed(static::ADMIN_RESOURCE);
    // }
}
