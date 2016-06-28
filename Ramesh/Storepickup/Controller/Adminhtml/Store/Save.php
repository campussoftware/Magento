<?php

namespace Ramesh\Storepickup\Controller\Adminhtml\Store;

use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Backend\App\Action {

    protected $_resource;
    public $storeModel;

    /**
     * @var \Magento\Framework\Image\AdapterFactory
     */
    protected $adapterFactory;

    /**
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    protected $uploader;

    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $filesystem;

    /**
     *     
     * @param \Ramesh\Connect\Model\StoreFactory $entitytypemodel
     */
    public function __construct(
    \Magento\Backend\App\Action\Context $context
    , \Magento\Framework\App\ResourceConnection $resource
    , \Ramesh\Storepickup\Model\StoreFactory $storeModel
    , \Magento\Framework\Image\AdapterFactory $adapterFactory
    , \Magento\MediaStorage\Model\File\UploaderFactory $uploader
    , \Magento\Framework\Filesystem $filesystem) {
        parent::__construct($context);
        $this->storeModel = $storeModel;
        $this->_resource = $resource;
        $this->adapterFactory = $adapterFactory;
        $this->uploader = $uploader;
        $this->filesystem = $filesystem;
    }

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute() {

        $data = $this->getRequest()->getParams();
        $removeimage = 0;
        if (isset($data['image'])) {
            if (isset($data['image']['delete'])) {
                $removeimage = 1;
            }
        }
        $existingpath="";
        if (isset($data['image'])) {
            if (isset($data['image']['delete'])) {
                $removeimage = 1;
            }
            if (isset($data['image']['value'])) {
                $existingpath = $data['image']['value'];
            }
            
        }
        $fileupload=0;
        $base_media_path = 'stores/images';
        if (isset($_FILES['image']) && isset($_FILES['image']['name']) && strlen($_FILES['image']['name'])) {
            try {
                
                $uploader = $this->uploader->create(
                        ['fileId' => 'image']
                );
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $imageAdapter = $this->adapterFactory->create();
                $uploader->addValidateCallback('image', $imageAdapter, 'validateUploadFile');
                $uploader->setAllowRenameFiles(false);
                $uploader->setFilesDispersion(true);
                
                $mediaDirectory = $this->filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
                $result = $uploader->save($mediaDirectory->getAbsolutePath($base_media_path),$data['short_code'].".".$uploader->getFileExtension());
                $data['image'] = $base_media_path . $result['file'];
                $fileupload=1;
            } catch (Exception $ex) {
                unset($data['image']);
            }
        } else {
            unset($data['image']);
        }
        
        if ($removeimage == 1) {
            if ($fileupload==0) {
                $mediaDirectory = $this->filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
                $base_media_path=$mediaDirectory->getAbsolutePath($existingpath);
                @unlink($base_media_path);                
                $data['image'] = "";
                
            }
        } 
        
        if ($data) {
            $model = $this->storeModel->create();
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }
            if (!isset($data['is_active'])) {
                $data['is_active'] = 0;
            }
            if (!isset($data['is_pos'])) {
                $data['is_pos'] = 0;
            }
            $model->setData($data);

            try {
                $model->save();
                $id = $model->getId();
                if ($data['is_active'] == 1) {
                    $connection = $this->_resource->getConnection();
                    $table = $this->_resource->getTableName('storepickup_store');
                    $sql = "update " . $table . " set is_active='0' where id!='" . $id . "' ;";
                    $connection->query($sql);
                }
                $this->messageManager->addSuccess(__('The Record Has been Saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId(), '_current' => true));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (\Magento\Framework\Model\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Store.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array('banner_id' => $this->getRequest()->getParam('banner_id')));
            return;
        }
        $this->_redirect('*/*/');
    }

}
