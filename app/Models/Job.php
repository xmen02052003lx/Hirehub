<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;
    // because by default Model will look at the table called "job" but we had the default "job" table created by Laravel (refer to background job like email,...), so we have our table named "job_listings" to refer to our "real" job, we need to specify it here for Laravel to know
    protected $table = 'job_listings';
    // this is a security feature agains "Mass Assignment vulnerability", it help you NOT to modify the columns that you SHOULDN'T modify by specifying the columns that you want to modify. For example, a malicious user might send an is_admin parameter through an HTTP request, which is then passed into your model's create method, allowing the user to escalate themselves to an administrator.
    protected $fillable = [
        'title',
        'description',
        'salary',
        'tags',
        'job_type',
        'remote',
        'requirements',
        'benefits',
        'address',
        'city',
        'state',
        'zipcode',
        'contact_email',
        'contact_phone',
        'company_name',
        'company_description',
        'company_logo',
        'company_website',
        'user_id'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function bookMarkedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'job_user_bookmarks')->withTimestamps();
    }
    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class);
    }
}
