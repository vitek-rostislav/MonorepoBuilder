<?php declare(strict_types=1);

namespace Symplify\MonorepoBuilder\Split\Tests\Process;

use Symplify\MonorepoBuilder\Split\Process\ProcessFactory;
use Symplify\MonorepoBuilder\Split\Tests\AbstractContainerAwareTestCase;

final class ProcessFactoryTest extends AbstractContainerAwareTestCase
{
    /**
     * @var ProcessFactory
     */
    private $processFactory;

    protected function setUp(): void
    {
        $this->processFactory = $this->container->get(ProcessFactory::class);
    }

    public function test(): void
    {
        $subsplitProcess = $this->processFactory->createSubsplit(
            '',
            'localDirectory',
            'git@github.com:Symplify/Symplify.git',
            false
        );

        $subsplitRealpath = realpath(__DIR__ . '/../../bash/subsplit.sh');
        $commandLine = "'" . $subsplitRealpath . "' '--branches=master' '' 'localDirectory:git@github.com:Symplify/Symplify.git' ''";

        $this->assertSame($commandLine, $subsplitProcess->getCommandLine());
    }
}