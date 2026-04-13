<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('id');
            $table->string('eyebrow')->nullable()->after('title');
            $table->text('intro')->nullable()->after('eyebrow');
            $table->text('card_description')->nullable()->after('intro');
            $table->string('card_icon')->nullable()->after('card_description');
            $table->string('card_image')->nullable()->after('card_icon');
            $table->string('hero_image')->nullable()->after('card_image');
            $table->string('highlight_image')->nullable()->after('hero_image');
            $table->string('hero_suffix')->nullable()->after('highlight_image');
            $table->text('hero_body')->nullable()->after('hero_suffix');
            $table->string('overview_title')->nullable()->after('hero_body');
            $table->json('overview_items')->nullable()->after('overview_title');
            $table->boolean('overview_split_columns')->default(false)->after('overview_items');
            $table->boolean('show_intro')->default(true)->after('overview_split_columns');
            $table->string('custom_layout')->nullable()->after('show_intro');
            $table->string('feature_image')->nullable()->after('custom_layout');
            $table->json('feature_images')->nullable()->after('feature_image');
            $table->json('gallery_images')->nullable()->after('feature_images');
            $table->json('feature_copy')->nullable()->after('gallery_images');
            $table->unsignedInteger('sort_order')->default(0)->after('feature_copy');
            $table->boolean('is_featured')->default(false)->after('sort_order');
        });

        Schema::create('service_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->longText('copy')->nullable();
            $table->json('list_items')->nullable();
            $table->json('copy_blocks')->nullable();
            $table->boolean('split_columns')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_sections');

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'eyebrow',
                'intro',
                'card_description',
                'card_icon',
                'card_image',
                'hero_image',
                'highlight_image',
                'hero_suffix',
                'hero_body',
                'overview_title',
                'overview_items',
                'overview_split_columns',
                'show_intro',
                'custom_layout',
                'feature_image',
                'feature_images',
                'gallery_images',
                'feature_copy',
                'sort_order',
                'is_featured',
            ]);
        });
    }
};
