<?php
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

class IoServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ArrayInput
     */
    private $input;

    /**
     * @var BufferedOutput
     */
    private $output;

    public function testShouldClearScreenInInteractiveMode()
    {
        $SUT = $this->createSUT();

        $this->input->setInteractive(true);

        $SUT->cls();

        $this->assertEquals(
            chr(27) . "[2J". chr(27) . "[1;1H",
            $this->output->fetch()
        );
    }

    public function testShouldNotClearScreenInNotInteractiveMode()
    {
        $SUT = $this->createSUT();

        $this->input->setInteractive(false);

        $SUT->cls();

        $this->assertEquals(
            '',
            $this->output->fetch()
        );
    }

    /**
     * @return \ShopwareCli\Services\IoService
     */
    private function createSUT()
    {
        $this->input = $input = new ArrayInput([]);
        $this->output = $output = new BufferedOutput();
        $questionHelper = new QuestionHelper();

        return new \ShopwareCli\Services\IoService(
            $input, $output, $questionHelper
        );
    }
}
