<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class ContentAgeProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }


    public static function calAge(Model $content): string
    {
        $contentCreatedAt = \Carbon\Carbon::parse($content->created_at);
        $currentTime = \Carbon\Carbon::now();
        $timeDiff = $contentCreatedAt->diff($currentTime);


        $timeAgo = '';

        if ($timeDiff->y > 0) {
            $timeAgo .= $timeDiff->y . ' year' . ($timeDiff->y > 1 ? 's' : '') . ' ';
        }

        elseif ($timeDiff->m > 0) {
            $timeAgo .= $timeDiff->m . ' month' . ($timeDiff->m > 1 ? 's' : '') . ' ';
        }

        elseif ($timeDiff->d > 0) {
            $timeAgo .= $timeDiff->d . ' day' . ($timeDiff->d > 1 ? 's' : '') . ' ';
        }

        elseif ($timeDiff->h > 0) {
            $timeAgo .= $timeDiff->h . ' hour' . ($timeDiff->h > 1 ? 's' : '') . ' ';
        }

        elseif ($timeDiff->i > 0) {
            $timeAgo .= $timeDiff->i . ' minute' . ($timeDiff->i > 1 ? 's' : '') . ' ';
        }

        elseif ($timeDiff->s > 0) {
            $timeAgo .= $timeDiff->s . ' second' . ($timeDiff->s > 1 ? 's' : '') . ' ';
        }


        $timeAgo = trim($timeAgo.' ago');

        return $timeAgo;
    }
}
