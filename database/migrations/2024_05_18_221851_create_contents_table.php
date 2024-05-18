<?php

use App\Models\Course;
use App\Models\TypeContent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TypeContent::class)->constrained();
            $table->foreignIdFor(Course::class)->constrained();
            $table->string("title");
            $table->string("url");
            $table->decimal("duration_second")->default(60);
            $table->string("orden");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
