<?php
// views/bom/index.php
use yii\helpers\Html;
use yii\helpers\Url;

// Helper function to get indentation and connector
function getTreeConnector($level, $isLast)
{
    $indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level - 1);
    $connector = $level > 1 ? ($isLast ? '└─' : '├─') : '';
    return $indent . $connector;
}
?>

<div class="bom-container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-sitemap"></i>
            Bill of Materials: <?= Html::encode($machine->name) ?>
        </div>
        <div class="card-body">
            <div class="tree-view">
                <?php
                $totalItems = count($bomItems);
                foreach ($bomItems as $index => $item):
                    $isLast = ($index === $totalItems - 1);
                    $connector = getTreeConnector($item->level, $isLast);
                ?>
                    <div class="tree-item level-<?= $item->level ?>">
                        <div class="tree-content">
                            <span class="tree-connector"><?= $connector ?></span>
                            <div class="part-info">
                                <div class="part-name">
                                    <?php if ($item->parentPart): ?>
                                        <i class="fas fa-cube"></i>
                                        <?= Html::encode($item->parentPart->name) ?>
                                    <?php else: ?>
                                        <i class="fas fa-industry"></i>
                                        <?= Html::encode($machine->name) ?>
                                    <?php endif; ?>
                                    <i class="fas fa-arrow-right"></i>
                                    <i class="fas fa-cogs"></i>
                                    <?= Html::encode($item->childPart->name) ?>
                                </div>
                                <div class="part-meta">
                                    <span class="badge badge-info">Level <?= $item->level ?></span>
                                    <span class="badge badge-secondary">Qty: <?= $item->quantity_required ?></span>
                                </div>
                            </div>
                            <div class="part-actions">
                                <a href="<?= Url::to(['view', 'id' => $item->id]) ?>"
                                    class="btn btn-sm btn-info"
                                    title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= Url::to(['update', 'id' => $item->id]) ?>"
                                    class="btn btn-sm btn-warning"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<style>
    
</style>