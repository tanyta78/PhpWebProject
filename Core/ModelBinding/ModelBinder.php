<?php


namespace Core\ModelBinding;


class ModelBinder implements ModelBinderInterface
{

    public function bind(array $data, $className)
    {
        $bindingModel = new $className();
        $bindingModelInfo = new \ReflectionClass($bindingModel);
        foreach ($bindingModelInfo->getProperties() as $property){
            $fieldName = $property->getName();
            if (!array_key_exists($fieldName,$data)){
                continue;
            }
            $value = $data[$fieldName];
            $setter = 'set'.ucfirst($fieldName);
            $bindingModel->$setter($value);
        }

        return $bindingModel;
    }
}