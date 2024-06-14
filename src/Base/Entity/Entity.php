<?php
namespace AllSrvs\Base;

class Entity
{
    protected array $properties = [];
        private function isAssoc(array $array): bool
        {
            return array_keys($array) !== range(0, count($array) - 1);
        }
        protected function setProperty(string $name, $value): void {
            // Check if it's an associative array. If it is, create a new Entity object.
            if (is_array($value) && $this->isAssoc($value)) {
                $this->properties[$name] = new Entity($value);
                return;
            }

            // If it's not an associative array, check if it's an array of associative arrays.
            if (is_array($value)) {

            }
                if ($this->isAssoc($value)) {
                    $this->properties[$name] = new Entity($value);
                    return;
                } else {
                    $entities = [];
                    foreach ($value as $entity) {
                        $entities[] = new Entity($entity);
                    }
                    $this->properties[$name] = $entities;
                    return;
                }
            }
            $this->properties[$name] = $value;
        }

        public function __get(string $name)
        {
            return $this->properties[$name] ?? null;
        }
        public function __set(string $name, $value): void
        {
            $this->properties[$name] = $value;
        }

}