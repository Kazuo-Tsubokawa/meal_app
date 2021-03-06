<?php

namespace Database\Factories;

use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $file = $this->faker->image();
        $fileName = basename($file);

        Storage::putFileAs('images/posts', $file, $fileName);
        File::delete($file);


        return [
            'title' => $this->faker->word(),
            'body' => $this->faker->paragraph(),
            'image' => $fileName,
            'user_id' => DB::table('users')->inRandomOrder()->first()->id,
            'category_id' => DB::table('categories')->inRandomOrder()->first()->id,
        ];
    }
}
