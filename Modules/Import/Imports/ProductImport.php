<?php

namespace Modules\Import\Imports;

use Maatwebsite\Excel\Row;
use Illuminate\Support\Collection;
use Modules\Product\Entities\Product;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductImport implements OnEachRow, WithChunkReading, WithHeadingRow
{
    public function chunkSize(): int
    {
        return 200;
    }

    public function onRow(Row $row)
    {
        $data = $this->normalize($row->toArray());

        request()->merge($data);

        try {
            Product::create($data);
        } catch (QueryException | ValidationException $e) {
            session()->push('importer_errors', $row->getIndex());
        }
    }

    private function normalize(array $data)
    {
        return array_filter([
            'name' => $data['name'],
            'sku' => $data['sku'],
            'description' => $data['description'],
            'short_description' => $data['short_description'],
            'is_active' => $data['active'],
            'brand_id' => $data['brand'],
            'categories' => $this->explode($data['categories']),
            'tax_class_id' => $data['tax_class'],
            'tags' => $this->explode($data['tags']),
            'price' => $data['price'],
            'special_price' => $data['special_price'],
            'special_price_type' => $data['special_price_type'],
            'special_price_start' => $data['special_price_start'],
            'special_price_end' => $data['special_price_end'],
            'manage_stock' => $data['manage_stock'],
            'qty' => $data['quantity'],
            'in_stock' => $data['in_stock'],
            'new_from' => $data['new_from'],
            'new_to' => $data['new_to'],
            'up_sells' => $this->explode($data['up_sells']),
            'cross_sells' => $this->explode($data['cross_sells']),
            'related_products' => $this->explode($data['related_products']),
            'files' => $this->normalizeFiles($data),
            'meta' => $this->normalizeMetaData($data),
            'attributes' => $this->normalizeAttributes($data),
            'options' => $this->normalizeOptions($data),
        ], function ($value) {
            return $value || is_numeric($value);
        });
    }

    private function explode($values)
    {
        if (trim($values) == '') {
            return false;
        }

        return array_map('trim', explode(',', $values));
    }

    private function normalizeFiles(array $data)
    {
        return [
            'base_image' => $data['base_image'],
            'additional_images' => $this->explode($data['additional_images']),
        ];
    }

    private function normalizeMetaData($data)
    {
        return [
            'meta_title' => $data['meta_title'],
            'meta_description' => $data['meta_description'],
        ];
    }

    private function normalizeAttributes(array $data)
    {
        $attributes = [];

        foreach ($this->findAttributes($data) as $attributeNumber => $attributeId) {
            $attributes[] = [
                'attribute_id' => $attributeId,
                'values' => $this->findAttributeValues($data, $attributeNumber),
            ];
        }

        return $attributes;
    }

    private function findAttributes(array $data)
    {
        return collect($data)->filter(function ($value, $column) {
            preg_match('/^attribute_\d$/', $column, $matches);

            return ! empty($matches);
        })->filter();
    }

    private function findAttributeValues(array $data, $attributeNumber)
    {
        return collect($data)->filter(function ($value, $column) use ($attributeNumber) {
            return $column === "{$attributeNumber}_values";
        })->map(function ($values) {
            return $this->explode($values);
        })->flatten()->toArray();
    }

    private function normalizeOptions(array $data)
    {
        $options = [];

        foreach ($this->findOptionPrefixes($data) as $optionPrefix) {
            $option = $this->findOptionAttributes($data, $optionPrefix);

            if (is_null($option['name'])) {
                continue;
            }

            $options[] = [
                'name' => $option['name'],
                'type' => $option['type'],
                'is_required' => $option['is_required'],
                'values' => $this->findOptionValues($option),
            ];
        }

        return $options;
    }

    private function findOptionPrefixes(array $data)
    {
        return collect($data)->filter(function ($value, $column) {
            preg_match('/^option_\d_name$/', $column, $matches);

            return ! empty($matches);
        })->keys()->map(function ($column) {
            return str_replace('_name', '', $column);
        });
    }

    private function findOptionAttributes(array $data, $optionPrefix)
    {
        return collect($data)->filter(function ($value, $column) use ($optionPrefix) {
            preg_match("/{$optionPrefix}_.*/", $column, $matches);

            return ! empty($matches);
        })->mapWithKeys(function ($value, $column) use ($optionPrefix) {
            $column = str_replace("{$optionPrefix}_", '', $column);

            return [$column => $value];
        });
    }

    private function findOptionValues(Collection $option)
    {
        $values = [];

        foreach ($this->findOptionValuePrefixes($option) as $valuePrefix) {
            $value = $this->findOptionValueAttributes($option, $valuePrefix);

            if (is_null($value['label'])) {
                continue;
            }

            $values[] = [
                'label' => $value['label'],
                'price' => $value['price'],
                'price_type' => $value['price_type'],
            ];
        }

        return $values;
    }

    private function findOptionValuePrefixes(Collection $option)
    {
        return $option->filter(function ($value, $column) {
            preg_match('/value_\d_.+/', $column, $matches);

            return ! empty($matches);
        })->keys()->map(function ($column) {
            preg_match('/value_\d/', $column, $matches);

            return $matches[0];
        })->unique();
    }

    private function findOptionValueAttributes(Collection $option, $valuePrefix)
    {
        return $option->filter(function ($value, $column) use ($valuePrefix) {
            preg_match("/{$valuePrefix}_.*/", $column, $matches);

            return ! empty($matches);
        })->mapWithKeys(function ($value, $column) use ($valuePrefix) {
            $column = str_replace("{$valuePrefix}_", '', $column);

            return [$column => $value];
        })->toArray();
    }
}
