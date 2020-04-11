<?php

namespace App;

use App\Services\FilesService\FilesService;
use App\Services\ToggleModelService\EnabledModelInterface;
use App\Services\ToggleModelService\ToggleStatusModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Languages extends Model implements EnabledModelInterface
{
    use ToggleStatusModelTrait;

    const MAIN = 1;
    const NOT_MAIN = 0;

    protected $table = 'languages';

    public $timestamps = false;

    protected $fillable = [
        'code',
        'main',
        'enable',
    ];

    public function getPrimaryName()
    {
        return $this->primaryKey;
    }

    /**
     * @return array
     */
    public static function getMainFlags(): array
    {
        return [
            self::MAIN,
            self::NOT_MAIN,
        ];
    }

    /**
     * @param $request
     * @return bool
     * @throws \Throwable
     */
    public function builder($request): bool
    {
        $this->code = $request->post('code');
        $this->main = strtolower($request->post('main'));
        $this->enable = (int)filter_var($request->post('enable'), FILTER_VALIDATE_BOOLEAN) ?? self::$enableFlag;

        return $this->save();
    }

    /**
     * @param array $options
     * @return bool
     * @throws \Throwable
     */
    public function save(array $options = [])
    {
        DB::beginTransaction();

        $status = parent::save($options);
        if ($status && $this->isMain()) {
            self::where('id', '!=', $this->id)->update([
                'main' => self::NOT_MAIN
            ]);
        }

        $status ? DB::commit() : DB::rollBack();

        return $status;
    }

    /**
     * @return bool
     */
    public function isMain(): bool
    {
        return (int)$this->main === (int)self::MAIN;
    }
}
