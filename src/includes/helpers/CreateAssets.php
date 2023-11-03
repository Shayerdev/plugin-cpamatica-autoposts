<?php


    namespace CAP\helpers;

    class CreateAssets {

        protected $type, $options;

        /**
         * Assets constructor.
         * @param $type
         * @param $options
         */
        public function __construct($type, $options)
        {
            $this->type = $type;
            $this->options = $options;

            # Init hook append File
            $this->connect();
        }

        public function connect()
        {
            if(is_admin()) return false;
            $this->type === 'style' ? self::connectStyle() : $this->connectScript();
        }

        public function connectStyle(){
            wp_enqueue_style(
                $this->options['name'],
                $this->options['src'],
                $this->options['deps'],
                $this->options['version'],
                $this->options['media']
            );
        }

        public function connectScript(){
            wp_enqueue_script(
                $this->options['name'],
                $this->options['src'],
                $this->options['deps'],
                $this->options['version'],
                $this->options['in_footer']
            );
        }
    }
