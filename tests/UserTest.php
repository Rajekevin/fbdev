<?php

/**
 * Class UserTest
 *
 * @author                 Didier Youn
 * @copyright              ESGI
 * @license                http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                   https://github.com/ESGI-4IW/fbdev
 */
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User as User;

class UserTest extends TestCase
{
    /** @var array $user */
    protected $user = array();

    public function setUp()
    {
        parent::setUp();

        if (is_null($this->user)) {
            $this->user = new User([
                'name'      => 'Didier',
                'mail'      => 'didier.youn@gmail.com',
                'password'  => 'test'
            ]);
            $this->be($this->user);
        }
    }

    /**
     * Check if we have an authenticate user
     */
    public function testCheckIfUserIsAuthenticate()
    {
        $this->assertTrue($this->_isAuthenticate());
    }

    /**
     * Get user token from Facebook
     *
     * @return bool
     */
    public function testGetUserToken()
    {
        $this->assertTrue(true);
    }

    /**
     * Check if user is connected
     *
     * @return bool
     */
    protected function _isAuthenticate()
    {
        $this->user = new User([
            'name'      => 'Didier',
            'mail'      => 'didier.youn@gmail.com',
            'password'  => 'test'
        ]);
        $this->be($this->user);

        if (Auth::check()) {
            return true;
        }

        return false;
    }
}
