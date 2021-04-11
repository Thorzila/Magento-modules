<?php
namespace OmniPro\Blog\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class BlogViewModel implements ArgumentInterface
{
    protected \Magento\Framework\UrlInterface $_urlInterface;

    /**
     * @param \OmniPro\Blog\Api\BlogRepositoryInterface
     */
    private $blogRepository;

    /**
     * @param \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    public function __construct(
        \Magento\Framework\UrlInterface $urlInterface,
        \OmniPro\Blog\Api\BlogRepositoryInterface $blogRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->_urlInterface = $urlInterface;
        $this->blogRepository = $blogRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function getBlogCollection()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $posts = $this->blogRepository->getList($searchCriteria)->getItems();
        return $posts;
    }

    public function savePost(): string
    {
        return $this->_urlInterface->getUrl('module/blog/save');
    }
}
