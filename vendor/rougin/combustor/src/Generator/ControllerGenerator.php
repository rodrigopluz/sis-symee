<?php

namespace Rougin\Combustor\Generator;

use Rougin\Combustor\Common\Tools;

/**
 * Controller Generator
 *
 * Generates CodeIgniter-based controllers.
 *
 * @package Combustor
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class ControllerGenerator extends BaseGenerator implements GeneratorInterface
{
    /**
     * Prepares the data before generation.
     *
     * @param  array &$data
     * @return void
     */
    public function prepareData(array &$data)
    {
        $data['camel'] = [];
        $data['columns'] = [];
        $data['dropdowns'] = [];
        $data['foreignKeys'] = [];
        $data['models'] = [$data['model']];
        $data['plural'] = plural($data['name']);
        $data['singular'] = singular($data['name']);
        $data['underscore'] = [];
    }

    /**
     * Generates set of code based on data.
     *
     * @return array
     */
    public function generate()
    {
        $this->prepareData($this->data);

        $columnFields = ['name', 'description', 'label'];

        $table = $this->describe->getTable($this->data['tabela']);

        foreach ($table as $column) {
            if ($column->isAutoIncrement()) {
                continue;
            }

            $field = strtolower($column->getField());
            $method = 'set_' . $field;

            $this->data['camel'][$field] = lcfirst(camelize($method));
            $this->data['underscore'][$field] = underscore($method);

            array_push($this->data['columns'], $field);

            if ($column->isForeignKey()) {
                $referencedTable = Tools::stripTableSchema(
                    $column->getReferencedTable()
                );
                
                $this->data['foreignKeys'][$field] = $referencedTable;
                
                $referencedTables = ucwords(str_replace('_', ' ', $referencedTable));
                array_push($this->data['models'], str_replace(' ', '', $referencedTables));
                
                $dropdown = [
                    'list' => plural(str_replace(' ', '', $referencedTables)),
                    'table' => $referencedTable,
                    'field' => $field
                ];

                if (!in_array($field, $columnFields)) {
                    $field = $this->describe->getPrimaryKey($referencedTable);

                    $dropdown['field'] = $field;
                }

                array_push($this->data['dropdowns'], $dropdown);
            }
        }

        return $this->data;
    }
}
