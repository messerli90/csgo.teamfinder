<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class FillBumpedPosts extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'bumped:fill';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Fill bumped column with created_at timestamp.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$posts = Teampost::all();

		foreach ($posts as $post) {
			$post->bumped_at = $post->created_at;
			$post->save();
		}
	}
}
