<?php
namespace OmniPro\Blog\Model;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use OmniPro\Blog\Api\Data\BlogInterface;

class Blog extends AbstractModel implements IdentityInterface, BlogInterface
{
    const CACHE_TAG = 'omnipro_blog_blog';
    const TITLE = 'title';
    const EMAIL = 'email';
    const CONTENT = 'content';
    const IMG = 'img';
    const ID = 'id';

    /**
     * Model cache tag for clear cache in after save and after delete
     *
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'blog';

    /**
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\OmniPro\Blog\Model\ResourceModel\Blog::class);
    }

    /**
     * Return a unique id for the model.
     *
     * @return array
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getId()
    {
        return $this->getData(self::ID);
    }

    public function setId($id)
    {
        $this->setData(self::ID, $id);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->setData(self::TITLE, $title);
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * @param string $content
     * @return void
     */
    public function setContent(string $content)
    {
        $this->setData(self::CONTENT, $content);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @param string $email
     * @return void
     */
    public function setEmail(string $email)
    {
        $this->setData(self::EMAIL, $email);
    }

    /**
     * @return string
     */
    public function getImg(): string
    {
        return $this->getData(self::IMG);
    }

    /**
     * @param string $img
     * @return void
     */
    public function setImg(string $img)
    {
        $this->setData(self::IMG, $img);
    }
}
