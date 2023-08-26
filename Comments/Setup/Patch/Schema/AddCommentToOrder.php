<?php

namespace Mostafa\Comments\Setup\Patch\Schema;

use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Sales\Setup\SalesSetup;

class AddCommentToOrder implements SchemaPatchInterface
{

    public function __construct(
        private readonly SalesSetup $salesSetup,
    )
    {
    }

    /**
     * Get array of patches that have to be executed prior to this.
     *
     * Example of implementation:
     *
     * [
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch1::class,
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch2::class
     * ]
     *
     * @return string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * Get aliases (previous names) for the patch.
     *
     * @return string[]
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * Run code inside patch
     * If code fails, patch must be reverted, in case when we are speaking about schema - then under revert
     * means run PatchInterface::revert()
     *
     * If we speak about data, under revert means: $transaction->rollback()
     *
     * @return $this
     */
    public function apply()
    {
        $attributeCode = 'customer_comment';
        $this->salesSetup->addAttribute(
            'order',
            $attributeCode,
            [
                'type' => 'text',
                'nullable' => 0,
                'comment' => 'Customer Comment'
            ]
        );
        return $this;
    }
}
