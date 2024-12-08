<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class MovieSession extends Model
{
    protected $table = "movie_session";
    use HasFactory;

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function cinemaRoom()
    {
        return $this->belongsTo(CinemaRoom::class, "room");
    }


    protected static function booted()
    {
        static::creating(function ($movieSession) {
            $cinemaRoom = \App\Models\CinemaRoom::find($movieSession->room);
            if ($cinemaRoom) {
                $rows = $cinemaRoom->rows;
                $columns = $cinemaRoom->columns;
                $seatMap = array_fill(0, $rows, array_fill(0, $columns, 1));
                $movieSession->seats = $seatMap;
            }
        });
    }

    public function scopeFilter($query, array $filters)
    {
        // Month mapping for Estonian to English translation
        $monthMapping = [
            "dets" => "December",
            "jaanuar" => "January",
            "veebruar" => "February",
            "märts" => "March",
            "aprill" => "April",
            "mai" => "May",
            "juuni" => "June",
            "juuli" => "July",
            "august" => "August",
            "september" => "September",
            "oktoober" => "October",
            "november" => "November",
        ];

        foreach ($filters as $filter => $value) {
            if (empty($value) || $value === "all") {
                continue;
            }

            switch ($filter) {
                case "date":
                    // Translate Estonian month names
                    foreach ($monthMapping as $estonian => $english) {
                        if (stripos($value, $estonian) !== false) {
                            $value = str_ireplace($estonian, $english, $value);
                            break;
                        }
                    }
                    $query->whereDate("start_time", Carbon::parse($value));
                    break;

                case "cinema":
                    $query->where("cinema", $value);
                    break;

                case "language":
                    $query->where("language", $value);
                    break;

                case "subtitles":
                    $query->where("subtitles", $value);
                    break;

                case "format":
                    $query->where("format", $value);
                    break;

                case "categories":
                    $query->whereHas("movie.categories", function ($q) use (
                        $value
                    ) {
                        $q->whereIn("name", $value);
                    });
                    break;

                case "age_rating":
                    $query->whereHas("movie", function ($q) use ($value) {
                        $q->whereIn("age_rating", $value);
                    });
                    break;

                case "time":
                    $hours = $value["hours"] ?? "00";
                    $minutes = $value["minutes"] ?? "00";
                    $earliestTime = Carbon::parse("{$hours}:{$minutes}");
                    $query->whereTime("start_time", ">=", $earliestTime);
                    break;

                default:
                    break;
            }
        }

        return $query;
    }
}
