<?php
namespace OmniPro\Blog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use \OmniPro\Blog\Api\Data\BlogInterface;
use OmniPro\Blog\Api\Data\BlogSearchResultInterface;

interface BlogRepositoryInterface
{
    /**
     * @param int $id
     * @return BlogInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): BlogInterface;

    /**
     * @param BlogInterface $blog
     * @return BlogInterface
     */
    public function save(BlogInterface $blog): BlogInterface;

    /**
     * @param BlogInterface $blog
     * @return void
     */
    public function delete(BlogInterface $blog);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return BlogSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): BlogSearchResultInterface;
}
