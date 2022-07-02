<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
        ]);

        $permissions = config('auth.permissions');

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $user->givePermissionTo($permissions);

        $category = Category::create([
            'name' => __('Genel'),
            'slug' => Str::slug(__('genel')),
        ]);

        $post = Post::create([
            'user_id' => $user->id,
            'subject' => __('Hoşgeldiniz'),
            'slug' => Str::slug(__('Hoşgeldiniz')),
            'content' => __('Bu blog, dünyada en çok kullanılan blog sistemlerinden biri değildir, hatta dumanı üstünde, fırından yeni çıktı! Ayrıca açık kaynaklı ve ücretsiz olarak dağıtılmaktadır. Github reposuna ulaşmak için tıklayın: <a href="https://github.com/sdkakcy/blog">https://github.com/sdkakcy/blog</a>'),
        ]);

        $post->categories()->sync([$category->id]);
    }
}
