<?php

/*
 * This file is part of BookmarkIt.
 *
 * (c) Monofony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Behat\Command;

use Webmozart\Assert\Assert;

class CommandContext extends DefaultContext
{
    /**
     * @Then the command should finish successfully
     */
    public function commandSuccess()
    {
        Assert::same($this->getTester()->getStatusCode(), 0);
    }

    /**
     * @Then I should see output :text
     */
    public function iShouldSeeOutput($text)
    {
        Assert::contains($this->getTester()->getDisplay(), $text);
    }
}
