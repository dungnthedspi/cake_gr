<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $agency->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $agency->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Agencies'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="agencies form large-9 medium-8 columns content">
    <?= $this->Form->create($agency) ?>
    <fieldset>
        <legend><?= __('Edit Agency') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('address');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
