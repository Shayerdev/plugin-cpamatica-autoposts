<?php

namespace CAP\helpers;

class CreateAssets
{
    protected $type, $options, $forAdmin;

    /**
     * Assets constructor.
     * @param string $type
     * @param array $options
     * @param bool $forAdmin
     */
    public function __construct(string $type, array $options, bool $forAdmin = false)
    {
        $this->type = $type;
        $this->options = $options;
        $this->forAdmin = $forAdmin;

        # Init hook append File
        $this->connect();
    }

    public function connect(): void
    {
        if (is_admin() && !$this->forAdmin) {
            return;
        }
        if ($this->type === 'style') {
            (!$this->forAdmin)
                ? add_action('wp_enqueue_scripts', array($this, 'connectStyle'))
                : add_action('admin_enqueue_scripts', array($this, 'connectStyle'));
        } else {
            (!$this->forAdmin)
                ? add_action('wp_enqueue_scripts', array($this, 'connectScript'))
                : add_action('admin_enqueue_scripts', array($this, 'connectScript'));
        }
    }

    public function connectStyle()
    {
        wp_enqueue_style(
            $this->options['name'],
            $this->options['src'],
            $this->options['deps'],
            $this->options['version'],
            $this->options['media']
        );
    }

    public function connectScript()
    {
        wp_enqueue_script(
            $this->options['name'],
            $this->options['src'],
            $this->options['deps'],
            $this->options['version'],
            $this->options['in_footer']
        );
    }
}
