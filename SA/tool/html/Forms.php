<?php

namespace Repse\Sa\tool\html;

use eftec\bladeone\BladeOne;

class Forms {

    public function __construct(
                private string $class = 'text-center',
                private string $method = 'POST',
                private ?string $target = null,
                private array $values = [],
                private string $autocomplete = 'off',
                private string $enctype = 'url-encoded'){}

    public function options(array $options)
    {
        $this->class = isset($options['class']) ? $options['class'] : $this->class;
        $this->method = isset($options['method']) ? $options['method'] : $this->method;
        $this->target = isset($options['target']) ? $options['target'] : $this->target;
        $this->autocomplete = isset($options['autocomplete']) ? $options['autocomplete'] : $this->autocomplete;
        $this->enctype = isset($options['enctype']) ? $options['enctype'] : $this->enctype;
        return $this;
    }

    public function vars(array $values)
    {
        $this->values = !empty($values) ? $values : $this->values;
        return $this;
    }

    public function run(BladeOne $blade)
    {
        if(!empty($this->target)){
            return "<form method='$this->method' target='".$blade->run($this->target,$this->values)."' class='$this->class' autocomplete='$this->autocomplete' enctype='$this->enctype'>";
        }
    }

}


