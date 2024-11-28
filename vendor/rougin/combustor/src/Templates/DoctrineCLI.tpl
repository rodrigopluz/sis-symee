<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

use Symfony\Component\Console\Helper\HelperSet;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

(@include_once __DIR__ . '/../vendor/autoload.php') || @include_once __DIR__ . '/../../../autoload.php';

/**
 * Path to the root folder
 */

define('ROOT', __DIR__ . '/../../../../');

/**
 * Path to the "system" folder
 */

define('BASEPATH', str_replace('\\\\', '/', ROOT . 'system/'));

/**
 * The path to the "application" folder
 */

define('APPPATH', ROOT . 'application/');

/**
 * Load the Doctrine Library
 */

require APPPATH . '/libraries/Doctrine.php';

$doctrine = new Doctrine();

$helperSet = require $doctrine->cli();

if ( ! ($helperSet instanceof HelperSet)) {
    foreach ($GLOBALS as $helperSetCandidate) {
        if ($helperSetCandidate instanceof HelperSet) {
            $helperSet = $helperSetCandidate;
            break;
        }
    }
}

\Doctrine\ORM\Tools\Console\ConsoleRunner::run($helperSet, $commands);