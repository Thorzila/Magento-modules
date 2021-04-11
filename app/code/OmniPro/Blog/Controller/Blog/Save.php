<?php
namespace OmniPro\Blog\Controller\Blog;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_blogInterfaceFactory;

    protected $_blogRepository;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \OmniPro\Blog\Api\Data\BlogInterfaceFactory $blogInterfaceFactory,
       \OmniPro\Blog\Api\BlogRepositoryInterface $blogRepository
    )
    {
        $this->_blogRepository = $blogRepository;
        $this->_blogInterfaceFactory = $blogInterfaceFactory;
        return parent::__construct($context);
    }
   
    public function execute()
    {
        $params = $this->_request->getParams();
        /**
         * @var \OmniPro\Blog\Model\Blog $blog
         */
        try {
            $blog = $this->_blogInterfaceFactory->create();
            $blog->setTitle($params['post_title'] ?? '');
            $blog->setContent($params['post_content'] ?? '');
            $blog->setEmail($params['post_email'] ?? '');
            $blog->setImg($params['post_img'] ?? '');
            $this->_blogRepository->save($blog);
        } catch (\Throwable $th) {
            $th->getMessage();
        }
        return $this->_redirect('*/*/index');
    }
    
}