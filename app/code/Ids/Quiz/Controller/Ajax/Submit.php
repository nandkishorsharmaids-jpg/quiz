<?php

declare(strict_types=1);

namespace Ids\Quiz\Controller\Ajax;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;

class Submit extends Action
{
    private JsonFactory $resultJsonFactory;

    public function __construct(Context $context, JsonFactory $resultJsonFactory)
    {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
    }

    public function execute(): Json
    {
        $result = $this->resultJsonFactory->create();

        if (!$this->getRequest()->isAjax()) {
            return $result->setData([
                'success' => false,
                'message' => __('Invalid request type.')
            ]);
        }

        $answers = (array)$this->getRequest()->getParam('answers', []);
        $correctMap = [
            'q1' => 'paris',
            'q2' => '4',
        ];

        $score = 0;
        foreach ($correctMap as $question => $correctAnswer) {
            if (($answers[$question] ?? null) === $correctAnswer) {
                $score++;
            }
        }

        return $result->setData([
            'success' => true,
            'score' => $score,
            'total' => count($correctMap),
            'message' => __('Quiz submitted successfully.')
        ]);
    }
}
