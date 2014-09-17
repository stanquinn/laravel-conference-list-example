<?php

//require_once 'PHPUnit/Autoload.php';
require_once 'TestCase.php';

class ConferenceTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$crawler = $this->client->request('GET', '/');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

    /**
     * A basic functional test example.
     *
     * @return void
     */

    public function testCreate()
    {
        $user = new User(array('username' => 'admin', 'password' => 'password'));
        $this->be($user);

        $crawler = $this->client->request('GET', '/admin/create');
        $this->assertTrue($this->client->getResponse()->isOk());
        //$user = $this->getResponseData($response, 'user');
        $this->assertViewHas('user');

    }

    public function getEdit ($user_id)
    {
        $user = new User(array('username' => 'admin', 'password' => 'password'));
        $this->be($user);

        $this->data['user'] = $user = User::find($user_id);

        $this->layout->with($this->data);

        $this->layout->content = \View::make('admin/edit', $this->data);
    }

//my test
    public function testPostEdit (){
        $login = new User(array('username' => 'admin', 'password' => 'password'));
        $this->be($login);

        $user = User::find(parent::ACCOUNT_1_USER_1);

        $this->be($user);

        $response = $this->call('GET', 'admin/edit/'.parent::ACCOUNT_1_USER_1);
        $user = $this->getResponseData($response, 'user');
        //clients is an array.  I want to get this
        //array and use $this->assetArrayContains() or something
        $this->assertViewHas('user');

    }

    protected function getResponseData($response, $key){

        $content = $response->getOriginalContent();

        $content = $content->getData();

        return $content[$key]->all();

    }


}