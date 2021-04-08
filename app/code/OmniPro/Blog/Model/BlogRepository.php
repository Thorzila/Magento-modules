<?php
namespace OmniPro\Blog\Model;

use Exception;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use OmniPro\Blog\Api\BlogRepositoryInterface;
use OmniPro\Blog\Api\Data\BlogInterface;
use OmniPro\Blog\Api\Data\BlogSearchResultInterface;

class BlogRepository implements BlogRepositoryInterface
{

    protected \OmniPro\Blog\Api\Data\BlogInterfaceFactory $_blogInterfaceFactory;
    protected \OmniPro\Blog\Api\Data\BlogSearchResultInterfaceFactory $_blogSearchResultFactory;
    protected ResourceModel\Blog\CollectionFactory $_blogCollectionFactory;

    public function __construct(
        \OmniPro\Blog\Api\Data\BlogInterfaceFactory $blogInterfaceFactory,
        \OmniPro\Blog\Api\Data\BlogSearchResultInterfaceFactory $blogSearchResultInterfaceFactory,
        \OmniPro\Blog\Model\ResourceModel\Blog\CollectionFactory $blogCollectionFactory
    )
    {
        $this->_blogInterfaceFactory = $blogInterfaceFactory;
        $this->_blogSearchResultFactory = $blogSearchResultInterfaceFactory;
        $this->_blogCollectionFactory = $blogCollectionFactory;
    }

    /**
     * @param int $id
     * @return BlogInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): BlogInterface
    {
        $blog = $this->_blogInterfaceFactory->create();
        $blog->getResource()->load($blog, $id);
        if(!$blog->getId()) {
            throw new NoSuchEntityException(__('Unable to load blog with id "%1"', $id));
        }
        return $blog;
    }

    /**
     * @param BlogInterface $blog
     * @return BlogInterface
     * @throws AlreadyExistsException
     */
    public function save(BlogInterface $blog): BlogInterface
    {
        $blog->getResource()->save($blog);
        return $blog;
    }

    /**
     * @param BlogInterface $blog
     * @throws Exception
     */
    public function delete(BlogInterface $blog)
    {
        $blog->getResource()->delete($blog);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return BlogSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): BlogSearchResultInterface
    {
        $collection = $this->_blogCollectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }

    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $searchResults = $this->_blogSearchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
