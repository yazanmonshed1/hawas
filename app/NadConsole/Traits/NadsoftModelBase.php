<?php

namespace App\NadConsole\Traits;

trait NadsoftModelBase
{

    public function getRelationship($relationship)
    {
        $relationshipOptions = explode(',', $relationship);
        $displayField = count($relationshipOptions) > 1 ? $relationshipOptions[1] : null;
        $relationship = $relationshipOptions[0];
        $relationshipsArr = explode('.', $relationship);

        $value = $this;
        if (count($relationshipsArr)) {
            foreach ($relationshipsArr as $r) {
                $value = $value ? $value->$r : null;
            }
        }
        if ($value && $displayField) {
            if (count($relationshipOptions) >= 3 && $relationshipOptions[2] == 'multiple') {
                $seperator = count($relationshipOptions) == 4 && isset($relationshipOptions[3]) ? $relationshipOptions[3] : ' | ';
                return implode($seperator, $value->pluck($displayField)->toArray());
            }
            return $value->$displayField;
        }
        return $value;
    }

    public static function renderGrid($dataTableRequest)
    {
        $labels = $dataTableRequest['columns'];

        foreach ($dataTableRequest['columns'] as $col) {
            $columns[]['data'] = $col;
        }

        $model = new self;

        $actions = '';

        if ($model->hasPermission('edit')) {
            $actions .= '<button class=\"btn btn-success action-edit mx-1\">' . __('admin.edit') . '</button>';
        }
        if ($model->hasPermission('delete')) {
            $actions .= '<button class=\"btn btn-danger action-delete mx-1\">' . __('admin.delete') . '</button>';
        }

        if (array_key_exists('additional_actions', $dataTableRequest)) {
            foreach ($dataTableRequest['additional_actions'] as $key => $action) {
                $actions .= '<button class=\"' . $action['classes'] . ' mx-1\">' . $action['label'] . '</button>';
            }
        }

        $columns[]['defaultContent'] = $actions;

        $dataTableRequest['columns'] = $columns;
        $dataTableRequest['rowId'] = 'id';

        return view('admin.grid.index')->with([
            'labels' => $labels,
            'model' => $model,
            'dataTableRequest' => $dataTableRequest,
        ]);
    }

    public function hasPermission($action)
    {
        /** @var $user App\Models\User */
        $user = auth()->user();
        return $user->can($action . ' ' . $this->getTable());
    }

    public function getSlug()
    {
        return $this->slug;
    }
}
