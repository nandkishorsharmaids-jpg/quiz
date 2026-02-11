<?php

declare(strict_types=1);

namespace Ids\Quiz\Controller\Adminhtml\Quiz;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    public const ADMIN_RESOURCE = 'Ids_Quiz::manage';

    private PageFactory $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute(): Page
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ids_Quiz::manage');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Quizzes'));

        return $resultPage;
    }
}
