<?php

namespace App\Modules\Infrastructure\Core\Domain;

use App\Modules\Domain\Models\Categories;
use App\Modules\Domain\Models\Content;
use App\Modules\Infrastructure\Core\IForm;

class RepositoryQuery extends Repository
{
    /**
     * Generate Columns as on Database
     *
     * @param $columns
     * @param $class
     * @return array
     * @author nhat_truong
     * @since  2018-01-11
     */
    public function addPrefixKey($columns, $class) {
        $arr = [];
        $className = with(new $class)->getTable();

        foreach ($columns as $key => $value) {
            $arr[$className . '.' . $key] = $value;
        }

        return $arr;
    }

    /**
     * Generate Columns as on Database
     *
     * @param $columns
     * @param $class
     * @return array|string
     * @author nhat_truong
     * @since  2018-01-04
     */
    public function addPrefixValue($columns, $class) {
        $arr = [];
        $className = with(new $class)->getTable();

        if (is_array($columns)) {
            foreach ($columns as $column) {
                $arr[] = $className . '.' . $column;
            }
        } else {
            return $className . '.' . $columns;
        }

        return $arr;
    }

    /**
     * @param $fields
     * @param $input
     * @return array
     * @author nhat_truong
     * @since  2018-01-04
     */
    public function getCondition($fields, $input) {
        if (empty($input)) {
            return [];
        }

        $conditions = [];

        foreach ($fields as $key => $value) {
            if ($value == '') {
                $conditions[$key] = '=';
            } else {
                $conditions[$key] = $value;
            }
        }

        $result = [];

        foreach ($conditions as $key => $value) {
            if (isset($input[$key])) {
                $newValue = ($value == 'like') ? "%$input[$key]%" : $input[$key];
                $result[] = [$key, $conditions[$key], $newValue];
            }
        }

        return $result;
    }

    public function getDisplay($display) {
        $paging = IForm::PAGING;

        if (isset($display)) {
            $paging = $display;

            if ($display == -1) {
                $paging = 1000;
            }
        }

        return $paging;
    }

    /**
     * @param $language
     * @param string $key
     * @return array
     */
    public function getConditionLanguage($language, $key = 'language') {
        $condition = [];

        if (isset($language) && $language != '*') {
            $condition = [$key, '=', $language];
        }

        return $condition;
    }

    /**
     * @param $status
     * @param string $key
     * @return array
     */
    public function getConditionStatus($status, $key = 'status') {
        if (isset($status) && in_array($status, [0, 1, 2])) {
            if ($status != Content::STATUS_TRASH) {
                $condition = [$key, '=', $status];
            } else {
                $condition = [$key, '=', Content::STATUS_TRASH];
            }
        } else {
            $condition = [$key, '<>', Content::STATUS_TRASH];
        }

        return $condition;
    }
}
