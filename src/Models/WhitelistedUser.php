<?php
namespace Azuriom\Plugin\playerapi\Models;

use Illuminate\Database\Eloquent\Model;
use Azuriom\Models\Traits\HasTablePrefix;
use Azuriom\Models\Traits\HasUser;
use Azuriom\Models\User;
class WhitelistedUser extends Model
{
    use HasUser;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id', 'target_id', 'discord_id'
    ];

    /**
     * The user key associated with this model.
     *
     * @var string
     */
    protected $userKey = 'author_id';

    /**
     * The user key associated with this model.
     *
     * @var string
     */
    protected $targetKey = 'target_id';

    /**
     * Get the user who created this ticket.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function target()
    {
        return $this->belongsTo(User::class, 'target_id');
    }

    public static function getAllFormated()
    {
        $i = WhitelistedUser::all();
        $newArray = [];
        foreach ($i as $v) {
            $associatedUser =  User::firstWhere("id", $v->target_id);
            $v->target_idAsID = $v->target_id;
            $v->target_id = $associatedUser->name;



            $associatedAuthor =  User::firstWhere("id", $v->author_id);
            $v->author_id = $associatedAuthor->name;
            array_push($newArray, $v);
        }

        return $newArray;
    }
}
