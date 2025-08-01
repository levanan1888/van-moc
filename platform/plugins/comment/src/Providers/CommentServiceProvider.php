<?php

namespace Botble\Comment\Providers;

use EmailHandler;
use Illuminate\Routing\Events\RouteMatched;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Comment\Repositories\Interfaces\CommentInterface;
use Botble\Comment\Models\Comment;
use Botble\Comment\Repositories\Caches\CommentCacheDecorator;
use Botble\Comment\Repositories\Eloquent\CommentRepository;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(CommentInterface::class, function () {
            return new CommentCacheDecorator(new CommentRepository(new Comment()));
        });
    }

    public function boot()
    {
        $this
            ->setNamespace('plugins/comment')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions', 'email'])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations()
            ->publishAssets();

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id' => 'cms-plugins-comment',
                'priority' => 130,
                'parent_id' => null,
                'name' => 'plugins/comment::comment.menu',
                'icon' => 'far fa-comment',
                'url' => route('comments.index'),
                'permissions' => ['comments.index'],
            ]);

            EmailHandler::addTemplateSettings(COMMENT_MODULE_SCREEN_NAME, config('plugins.comment.email', []));
        });

        $this->app->booted(function () {
            $this->app->register(HookServiceProvider::class);
        });
    }
}
