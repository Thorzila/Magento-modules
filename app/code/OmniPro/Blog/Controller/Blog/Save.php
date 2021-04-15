<?php
namespace OmniPro\Blog\Controller\Blog;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_blogInterfaceFactory;

    protected $_blogRepository;

    protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \OmniPro\Blog\Api\Data\BlogInterfaceFactory $blogInterfaceFactory,
        \OmniPro\Blog\Api\BlogRepositoryInterface $blogRepository,
        UploaderFactory $uploaderFactory,
        AdapterFactory $adapterFactory,
        Filesystem $filesystem
    )
    {
        $this->_blogRepository = $blogRepository;
        $this->_blogInterfaceFactory = $blogInterfaceFactory;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        return parent::__construct($context);
    }
   
    public function execute()
    {
        $params = $this->_request->getParams();
        /**
         * @var \OmniPro\Blog\Model\Blog $blog
         */
        if(isset($_FILES['post_img']['name']) && $_FILES['post_img']['name'] != '') {
            try{
                $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'post_img']);
                $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $imageAdapter = $this->adapterFactory->create();
                $uploaderFactory->addValidateCallback('custom_image_upload',$imageAdapter,'validateUploadFile');
                $uploaderFactory->setAllowRenameFiles(true);
                $uploaderFactory->setFilesDispersion(false);
                $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
                $destinationPath = $mediaDirectory->getAbsolutePath('blog/post');
                $result = $uploaderFactory->save($destinationPath);
                if (!$result) {
                    throw new LocalizedException(
                        __('File cannot be saved to path: $1', $destinationPath)
                    );
                }
            } catch (\Exception $e) {
                $e->getMessage();
            }
        }

        try {
            $blog = $this->_blogInterfaceFactory->create();
            $blog->setTitle($params['post_title'] ?? '');
            $blog->setContent($params['post_content'] ?? '');
            $blog->setEmail($params['post_email'] ?? '');
            $blog->setImg('blog/post/'.$result['file'] ?? '');
            $this->_blogRepository->save($blog);
        } catch (\Throwable $th) {
            $th->getMessage();
        }
        return $this->_redirect('*/*/index');
    }
    
}