<?php
/**
 * @category  Bunited
 * @package   Bunited\CustomTabs
 * @author    Berin Kozlic - beringgmu@gmail.com
 * @copyright 2019 Berin Kozlic
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bunited\CustomTabs\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $table = $installer->getConnection()->newTable(
            $installer->getTable('bunited_tabs')
        )->addColumn(
            'entity_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Tab Id'
        )->addColumn(
            'class',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Tab Class Name'
        )->addColumn(
            'title',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Title'
        )->addColumn(
            'content',
            Table::TYPE_TEXT,
            '2M',
            ['nullable' => false],
            'Content'
        )->addColumn(
            'tab_sort',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Tab Sort Number'
        )->addColumn(
            'is_active',
            Table::TYPE_SMALLINT,
            null,
            [],
            'Active Status'
        )->setComment(
            'Bunited Tabs Table'
        );

        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}