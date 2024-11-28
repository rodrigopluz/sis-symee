<?php

namespace Rougin\Combustor\Generator;

use Rougin\Combustor\Common\Tools;

/**
 * View Generator
 *
 * Generates CodeIgniter-based views.
 *
 * @package Combustor
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class ViewGenerator extends BaseGenerator implements GeneratorInterface
{
    /**
     * Prepares the data before generation.
     *
     * @param  array $data
     * @return void
     */
    public function prepareData(array &$data)
    {
        $bootstrap = [
            'label' => 'control-label',
            'textRight' => 'text-right',
            'formGroup' => 'form-group ',
            'button' => 'btn btn-default',
            'formControl' => 'form-control',
            'buttonPrimary' => 'btn btn-primary',
            'col6' => 'col-lg-6 col-md-6 col-sm-6 col-xs-6',
            'table' => 'table table table-striped table-hover',
            'col12' => 'col-lg-12 col-md-12 col-sm-12 col-xs-12',
        ];

        if ($data['isBootstrap']) {
            $data['bootstrap'] = $bootstrap;
        }

        $data['camel'] = [];
        $data['underscore'] = [];
        $data['foreignKeys'] = [];
        $data['primaryKeys'] = [];

        $data['plural'] = plural($data['name']);
        $data['singular'] = singular($data['name']);

        $primaryKey =  $this->describe->getPrimaryKey($data['name']);
        $data['primaryKey'] = $primaryKey;

        if ($this->data['isCamel']) {
            $data['primaryKey'] = camelize($data['primaryKey']);
        }

        $data['columns'] = $this->describe->getTable(
            $data['name']
        );
    }

    /**
     * Generates set of code based on data.
     *
     * @return array
     */
    public function generate()
    {
        $this->prepareData($this->data);

        foreach ($this->data['columns'] as $column) {
            $field = strtolower($column->getField());

            $this->data['camel'][$field] = $this->transformField(
                $field,
                'camelize'
            );

            $this->data['underscore'][$field] = $this->transformField(
                $field,
                'underscore'
            );

            if ($column->isForeignKey()) {
                $referencedTable = Tools::stripTableSchema(
                    $column->getReferencedTable()
                );

                $this->data['foreignKeys'][$field] = plural($referencedTable);

                $singular = $field . '_singular';

                $this->data['foreignKeys'][$singular] = singular(
                    $referencedTable
                );

                $this->data = $this->getPrimaryKey(
                    $this->data,
                    $field,
                    $referencedTable
                );
            }
        }

        return $this->data;
    }
}
