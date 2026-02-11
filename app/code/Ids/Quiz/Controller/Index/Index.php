<?php

declare(strict_types=1);

namespace Ids\Quiz\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    private PageFactory $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute(): Page
    {
        return $this->resultPageFactory->create();
    }
}
