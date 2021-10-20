<?php

namespace Repse\Sa\support;

use Repse\Sa\support\Arr;
use Repse\Sa\support\Str;

class MessageBag
{
    protected array $messages = [];
    protected string $format = ':message';
    //success,info,warning,danger,primary,secondary,dark
    protected string $style = 'primary';

    /**
     * Create a new message bag instance.
     *
     * @param  array  $messages
     * @return void
     */
    public function __construct(array $messages = [])
    {
        foreach ($messages as $key => $value) {
            $this->messages[$key] = $value;
                    
        }
    }

    /**
     * Get the keys present in the message bag.
     *
     * @return array
     */
    public function keys()
    {
        return array_keys($this->messages);
    }

    /**
     * Add a message to the bag.
     *
     * @param  string  $key
     * @param  string  $message
     * @return $this
     */
    public function add($key, $message)
    {
        if ($this->isUnique($key, $message)) {
            $this->messages[$key][] = $message;
        }

        return $this;
    }

    /**
     * Determine if a key and message combination already exists.
     *
     * @param  string  $key
     * @param  string  $message
     * @return bool
     */
    protected function isUnique($key, $message)
    {
        $messages = (array) $this->messages;

        return ! isset($messages[$key]) || ! in_array($message, $messages[$key]);
    }

    
    public function merge($messages)
    {
        if ($messages) {
            $messages = $messages->getMessageBag()->getMessages();
        }

        $this->messages = array_merge_recursive($this->messages, $messages);

        return $this;
    }

    /**
     * Determine if messages exist for all of the given keys.
     *
     * @param  array|string  $key
     * @return bool
     */
    public function has($key)
    {
        if (is_null($key)) {
            return $this->any();
        }

        $keys = is_array($key) ? $key : func_get_args();

        foreach ($keys as $key) {
            if ($this->first($key) === '') {
                return false;
            }
        }

        return true;
    }

    /**
     * Determine if messages exist for any of the given keys.
     *
     * @param  array|string  $keys
     * @return bool
     */
    public function hasAny($keys = [])
    {
        $keys = is_array($keys) ? $keys : func_get_args();

        foreach ($keys as $key) {
            if ($this->has($key)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the first message from the bag for a given key.
     *
     * @param  string  $key
     * @param  string  $format
     * @return string
     */
    public function first($key = null, $format = null)
    {
        $messages = is_null($key) ? $this->all($format) : $this->get($key, $format);

        $firstMessage = Arr::first($messages, null, '');

        return is_array($firstMessage) ? Arr::first($firstMessage) : $firstMessage;
    }

    /**
     * Get all of the messages from the bag for a given key.
     *
     * @param  string  $key
     * @param  string  $format
     * @return array
     */
    public function get($key)
    {
        
        // the message. Otherwise, we'll check if the key is implicit & collect
        // all the messages that match a given key and output it as an array.
        if (array_key_exists($key, $this->messages)) {
            return 
                $this->messages[$key] &&
                $this->checkFormat($format) &&
                $key;
            
        }

        if (Str::contains($key, '*')) {
            return $this->getMessagesForWildcardKey($key, $format);
        }

        return [];
    }

    /**
     * Get all of the messages for every key in the bag.
     *
     * @param  string  $format
     * @return array
     */
    public function all()
    {

        $all = [];

        foreach ($this->messages as $key => $messages) {
            $all = array_merge($all, $messages);
        }

        return $all;
    }

    /**
     * Get all of the unique messages for every key in the bag.
     *
     * @param  string  $format
     * @return array
     */
    public function unique($format = null)
    {
        return array_unique($this->all($format));
    }

    /**
     * Get the appropriate format based on the given format.
     *
     * @param  string  $format
     * @return string
     */
    protected function checkFormat($format)
    {
        return $format ?: $this->format;
    }

    /**
     * Get the raw messages in the container.
     *
     * @return array
     */
    public function messages()
    {
        return $this->messages;
    }

    /**
     * Get the raw messages in the container.
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->messages();
    }

    /**
     * Get the messages for the instance.
     *
     */
    public function getMessageBag()
    {
        return $this;
    }

  
    public function getFormat(): ?string
    {
        return $this->format;
    }

    /**
     * Set the default message format.
     *
     * @param  string  $format
     */
    public function setFormat($format = ':message')
    {
        $this->format = $format;

        return $this;
    }

 
    public function isEmpty(): ?bool
    {
        return ! $this->any();
    }

  
    public function isNotEmpty(): ?bool
    {
        return $this->any();
    }

  
    public function any(): ?bool
    {
        return $this->count() > 0;
    }

   
    public function count(): ?int
    {
        return count($this->messages, COUNT_RECURSIVE) - count($this->messages);
    }

 
    public function toArray(): ?array
    {
        return $this->getMessages();
    }

 
    public function jsonSerialize(): ?array
    {
        return $this->toArray();
    }

 
    public function toJson($options = 0): ?string
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    
    public function __toString()
    {
        return $this->toJson();
    }

    public function style(string $style)
    {
        $this->style = $style;
        return $this;
    }

  
    public function display()
    {
        $args = func_get_args();
        if (!empty($args)) {
            foreach ($args[0] as $key => $value)
            {
                $this->style = $args[1];
        
                foreach ($value as $message){
                    return include_once(dirname(__DIR__,2).'/app/message.php');
                }
            }
        }
        foreach ($this->all() as $key => $message) 
            return include_once(dirname(__DIR__,2).'/app/message.php');
    }
}