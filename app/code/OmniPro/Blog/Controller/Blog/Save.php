<?php
namespace OmniPro\Blog\Controller\Blog;

use Magento\Framework\App\Action\Context;
use OmniPro\Blog\Model\Blog;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_blogIntefaceFactory;
    protected $_blogRepository;

    public function __construct(
        Context $context,
        \OmniPro\Blog\Api\Data\BlogInterfaceFactory $blogInterfaceFactory,
        \OmniPro\Blog\Api\BlogRepositoryInterface $blogRepository
    )
    {
        $this->_blogIntefaceFactory = $blogInterfaceFactory;
        $this->_blogRepository = $blogRepository;
        return parent::__construct($context);
    }

    public function execute()
    {
        $params = $this->_request->getParams();
        /**
         * @var Blog $blog
         */
        $blog = $this->_blogIntefaceFactory->create();
        $blog->setData($params);
//        $blog->setTitle($params['post_title']);
//        $blog->setContent($params['post_content']);
//        $blog->setEmail($params['post_email']);
//        $blog->setImg($params['post_img']);
        $this->_blogRepository->save($blog);
        return $this->_redirect('module/blog/index');
    }
}
