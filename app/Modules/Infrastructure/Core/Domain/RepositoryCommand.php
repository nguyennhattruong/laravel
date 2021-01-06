<?php

namespace App\Modules\Infrastructure\Core\Domain;

class RepositoryCommand extends Repository
{
    /**
     * Map input to DB
     *
     * @param $object
     * @param $fields
     * @param $input
     * @return Model
     *
     * @author nhat_truong
     * @since  2018-01-16
     */
    function getItems($object, $fields, $input) {
        $objectTemp = $object;

        foreach ($fields as $field) {
            if (!is_null($input[$field])) {
                $objectTemp->$field = $input[$field];
            }
        }

        return $objectTemp;

    }

    function setAttributes($object, $input) {
        if (isset($object->id)) {
            return $this->_setAttributesUpdate($object, $input);
        }

        return $this->_setAttributesInsert($object, $input);
    }

    protected function _setAttributesInsert($object, $input) {
        $attrs = array_keys($object->getAttributes());
        $objectTemp = $object;
        $obj = new $object();

        foreach ($attrs as $field) {
            if (key_exists($field, $input) && !is_null($input[$field])) {
                $objectTemp->$field = $input[$field];
            } else {
                $objectTemp->$field = $obj->$field;
            }
        }

        return $objectTemp;
    }

    protected function _setAttributesUpdate($object, $input) {
        $attrs = array_keys($object->getAttributes());
        $objectTemp = $object;
        $obj = new $object();

        foreach ($attrs as $field) {
            if (key_exists($field, $input) && !is_null($input[$field])) {
                $objectTemp->$field = $input[$field];
            } elseif (key_exists($field, $input) && is_null($input[$field])) {
                $objectTemp->$field = $obj->$field;
            }
        }

        return $objectTemp;
    }

    /**
     * Get inputs have value
     *
     * @param $fields
     * @param $input
     * @return array
     *
     * @author nhat_truong
     * @since  2018-03-27
     */
    function getInput($fields, $input) {
        $items = [];

        foreach ($fields as $field) {
            if (!is_null($input[$field])) {
                $items[$field] = $input[$field];
            }
        }

        return $items;
    }

    /**
     * @param $status
     * @return int
     * @author nhat_truong
     * @since  2018-01-16
     */
    function getStatus($status) {
        return in_array($status, [0, 1]) ? $status : 1;
    }

    /**
     * @param $language
     * @return string
     * @author nhat_truong
     * @since  2018-01-16
     */
    function getLang($language) {
        return is_null($language) ? '*' : $language;
    }
}
