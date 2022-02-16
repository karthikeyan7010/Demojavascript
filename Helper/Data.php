<?php
declare(strict_types=1);

namespace Presperse\Checkout\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
	/**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @param \Magento\Catalog\Model\CategoryRepository $categoryRepository
     */
    public function __construct(
        \Magento\Catalog\Model\CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get Category Data
     *
     * @param $categoryId
     */
    public function getItems($categoryId)
    {
        $category = $this->categoryRepository->get($categoryId);
        $subCategories = $category->getChildrenCategories();
        
        if ($subCategories->getSize()) {
            return $subCategories->addFieldToFilter('is_active', 1);
        }

        return '';
    }
}
