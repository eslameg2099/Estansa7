<?php

namespace App\Models;

use Parental\HasChildren;
use App\Http\Filters\Filterable;
use App\Http\Filters\UserFilter;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use App\Support\Traits\Selectable;
use App\Models\Helpers\UserHelpers;
use Spatie\Permission\Traits\HasRoles;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\providerResource;

use App\Models\Presenters\UserPresenter;
use Illuminate\Notifications\Notifiable;
use Laracasts\Presenter\PresentableTrait;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Contracts\NotificationTarget;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use Illuminate\Validation\ValidationException;
use ChristianKuri\LaravelFavorite\Models\Favorite;
use ChristianKuri\LaravelFavorite\Traits\Favoriteability;
class User extends Authenticatable implements HasMedia, NotificationTarget
{
    use HasFactory;
    use Notifiable;
    use UserHelpers;
    use HasChildren;
    use InteractsWithMedia;
    use HasApiTokens;
    use HasChildren;
    use PresentableTrait;
    use Filterable;
    use Selectable;
    use HasUploader;
    use Impersonate;
    use HasRoles;
    use Favoriteability;
    
    /**
     * The code of admin type.
     *
     * @var string
     */
    const ADMIN_TYPE = 'admin';

    /**
     * The code of supervisor type.
     *
     * @var string
     */
    const SUPERVISOR_TYPE = 'supervisor';

    /**
     * The code of customer type.
     *
     * @var string
     */
    const CUSTOMER_TYPE = 'customer';



    const Provider_TYPE = 'provider';


    /**
     * The guard name of the user permissions.
     *
     * @var string
     */
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'password',
        'remember_token',
        'address',
        'bio',
        'linkedin',
        'category_id',
        'skills',
        'unit_price',
        'experience',
        'rate',
        'provider_verified_at',
        'wallet',
        'bank_name',
        'iban',
        'account_bank',
        'free_session',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['media'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $childTypes = [
        self::ADMIN_TYPE => Admin::class,
        self::SUPERVISOR_TYPE => Supervisor::class,
        self::CUSTOMER_TYPE => Customer::class,
        self::Provider_TYPE => Provider::class,

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The presenter class name.
     *
     * @var string
     */
    protected $presenter = UserPresenter::class;

    /**
     * The model filter name.
     *
     * @var string
     */
    protected $filter = UserFilter::class;

    /**
     * Get the dashboard profile link.
     *
     * @return string
     */
    public function dashboardProfile(): string
    {
        return '#';
    }

    /**
     * Get the number of models to return per page.
     *
     * @return int
     */
    public function getPerPage()
    {
        return request('perPage', parent::getPerPage());
    }

    public function category()
    {
        return $this->belongsTo(CategoryProvider::class, 'category_id')->withTrashed();
    }

    public function userused()
    {
        return $this->hasMany(Userused::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(CategoryProvider::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function Reservations()
    {
        return $this->hasMany(Reservation::class, 'user_id');
    }

    public function availabletimes()
    {
        return $this->hasMany(AvailableTime::class, 'user_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

   
    
    /**
     * Get the resource for customer type.
     *
     * @return \App\Http\Resources\CustomerResource
     */
    public function getResource()
    {
        if($this->type == "provider")
        {
            return new providerResource($this);
        }
        else
            return new CustomerResource($this);
    }

    /**
     * Get the access token currently associated with the user. Create a new.
     *
     * @param string|null $device
     * @return string
     */
    public function createTokenForDevice($device = null)
    {
        $device = $device ?: 'Unknown Device';

        $this->tokens()->where('name', $device)->delete();

        return $this->createToken($device)->plainTextToken;
    }

    /**
     * Define the media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatars')
            ->useFallbackUrl('https://www.gravatar.com/avatar/'.md5($this->email).'?d=mm')
            ->singleFile();
    }


   

    /**
     * Determine whither the user can impersonate another user.
     *
     * @return bool
     */
    public function canImpersonate()
    {
        return $this->isAdmin();
    }

    /**
     * Determine whither the user can be impersonated by the admin.
     *
     * @return bool
     */
    public function canBeImpersonated()
    {
        return $this->isSupervisor();
    }

    /**
     * Get the entity's notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notifications()
    {
        return $this->morphMany(NotificationModel::class, 'notifiable')->orderBy('created_at', 'desc');
    }

    /**
     * The title of the notification.
     *
     * @param \App\Models\NotificationModel $notification
     * @return string
     */
    public function getNotificationTitle(NotificationModel $notification): string
    {
        return $this->name;
    }

    /**
     * The body of the notification.
     *
     * @param \App\Models\NotificationModel $notification
     * @return string
     */
    public function getNotificationBody(NotificationModel $notification): string
    {
        if ($notification->user->isCustomer()) {
            return trans('notifications.new-customer', [
                'user' => $this->name,
            ]);
        }

        return __('New user has been registered.');
    }

    /**
     * The image of the notification.
     *
     * @param \App\Models\NotificationModel $notification
     * @return string
     */
    public function getNotificationImage(NotificationModel $notification): string
    {
        return $this->getAvatar();
    }

    /**
     * The data of the notification.
     *
     * @param \App\Models\NotificationModel $notification
     * @return mixed|void
     */
    public function getNotificationData(NotificationModel $notification)
    {
        return $this->getResource();
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id');
    }

    /**
     * The dashboard url of the notification.
     *
     * @param \App\Models\NotificationModel $notification
     * @return string
     */
    public function getNotificationDashboardUrl(NotificationModel $notification): string
    {
        $parameters = [
            $this,
            'notification_id' => $notification->id,
            'action' => 'delete',
        ];

        if ($this->isAdmin()) {
            return route('dashboard.admins.show', $parameters);
        }

        if ($this->isSupervisor()) {
            return route('dashboard.supervisors.show', $parameters);
        }

        return route('dashboard.customers.show', $parameters);
    }
}
