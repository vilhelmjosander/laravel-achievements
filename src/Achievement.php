<?php

namespace tehwave\Achievements;

use Illuminate\Support\Str;
use tehwave\Achievements\Contracts\AchievementContract;

abstract class Achievement implements AchievementContract
{
    /**
     * The unique identifier for the achievement.
     *
     * @var string
     */
    public $id;

    /**
     * The name of this achievement.
     *
     * @var string
     */
    public $name;

    /**
     * The description of this achievement.
     *
     * @var string
     */
    public $description;

    /**
     * Get the data of the achievement.
     *
     * @param  mixed  $achievement
     * @return array
     *
     * @throws \RuntimeException
     */
    protected function getData($achievement)
    {
        if (method_exists($achievement, 'toDatabase')) {
            return is_array($data = $achievement->toDatabase())
                                ? $data : $data->data;
        }

        throw new RuntimeException('Achievement is missing toDatabase method.');
    }

    /**
     * Unlocks an achievement.
     *
     * @param  mixed  $achievers
     * @param  mixed  $achievement
     *
     * @return void
     */
    public static function unlock($achiever, $achievement)
    {
        $achiever->achievements()->create([
            'id' => Str::uuid()->toString(),
            'type' => get_class($achievement),
            'data' => $achievement->getData(),
        ]);
    }
}
