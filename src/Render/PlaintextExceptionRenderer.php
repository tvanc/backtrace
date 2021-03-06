<?php
/**
 * @author Travis Van Couvering <travis@tvanc.com>
 */

namespace TVanC\Backtrace\Render;

/**
 * Renders exceptions in plaintext format, using only text-based visual
 * formatting, if any.
 */
class PlaintextExceptionRenderer extends AbstractExceptionRenderer
{
    const DEFAULT_DIVIDER_LENGTH = 75;
    const OUTER_DIVIDER_CHAR = '=';
    const INNER_DIVIDER_CHAR = '-';

    /**
     * @var int
     */
    private $maxWidth;


    /**
     * CliExceptionRenderer constructor.
     *
     * @param int $maxWidth
     */
    public function __construct(int $maxWidth = self::DEFAULT_DIVIDER_LENGTH)
    {
        $this->maxWidth = $maxWidth;
    }


    /**
     * Render the exception in CLI-optimized format.
     *
     * @param \Throwable $throwable
     *
     * @return string
     */
    public function render(\Throwable $throwable): string
    {
        ob_start();
        $type      = static::getErrorDisplayType($throwable);
        $outerLine = $this->makeDivider(self::OUTER_DIVIDER_CHAR);
        $innerLine = $this->makeDivider(
            self::INNER_DIVIDER_CHAR,
            min($this->maxWidth, strlen($type))
        );

        echo <<<MSG
$outerLine
$type
$innerLine
{$throwable->getMessage()}

MSG;
        foreach ($throwable->getTrace() as $index => $frame) {
            echo "\n" . $this->makeLine("#$index ") . "\n";
            echo $this->renderFrame($frame);
        }
        echo "\n" . $outerLine . "\n\n";

        return ob_get_clean();
    }


    /**
     * Render an indivual backtrace frame in CLI-optimized format.
     *
     * @param array $frame
     *
     * @return string
     */
    public function renderFrame(array $frame): string
    {
        return <<<FRAME_RENDER
File:  {$frame['file']}
Line:  {$frame['line']}
Calls: {$frame['function']}
FRAME_RENDER;
    }


    private function makeDivider($char = '-', $len = null)
    {
        return $this->makeLine('', $char, $len);
    }


    /**
     * Make a textual divider.
     *
     * @param string $label
     * The text to output at the start of the divider. Optional - defaults to an empty string.
     *
     * @param string $char
     * The character or characters to use for padding.
     *
     * @param int    $len
     * The maximum final length of the string. Leave blank to
     * default to the configured max width.
     *
     * @return string
     */
    private function makeLine(
        string $label = '',
        string $char = '-',
        int $len = null
    ) {
        if (is_null($len)) {
            $len = $this->maxWidth;
        }

        return str_pad($label, $len, $char, STR_PAD_RIGHT);
    }
}
