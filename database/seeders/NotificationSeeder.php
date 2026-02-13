<?php

namespace Database\Seeders;

use App\Enums\NotificationType;
use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notification::create([
            'icon' => 'info',
            'title' => [
                'en' => 'Daily Forecast Updated',
                'ar' => 'تم تحديث التوقعات اليومية',
                'ku' => 'پێشبینی ڕۆژانە نوێکرایەوە',
            ],
            'description' => [
                'en' => 'The 7-day weather forecast has been updated with the latest meteorological data.',
                'ar' => 'تم تحديث توقعات الطقس لمدة 7 أيام بأحدث البيانات الجوية.',
                'ku' => 'پێشبینی کەشوهەوای 7 ڕۆژ بە نوێترین داتای کەشناسی نوێکرایەوە.',
            ],
            'type' => NotificationType::Info,
        ]);

        Notification::create([
            'icon' => 'warning',
            'title' => [
                'en' => 'Heavy Rainfall Expected',
                'ar' => 'أمطار غزيرة متوقعة',
                'ku' => 'چاوەڕوانی بارانی بەهێز دەکرێت',
            ],
            'description' => [
                'en' => 'Heavy rainfall is expected in the next 48 hours. Risk of flooding in low-lying areas.',
                'ar' => 'من المتوقع هطول أمطار غزيرة خلال الـ 48 ساعة القادمة. خطر الفيضانات في المناطق المنخفضة.',
                'ku' => 'لە 48 کاتژمێری داهاتوودا چاوەڕوانی بارانی بەهێز دەکرێت. مەترسی لافاو لە ناوچە نزمەکان.',
            ],
            'type' => NotificationType::Warning,
        ]);

        Notification::create([
            'icon' => 'alert',
            'title' => [
                'en' => 'Extreme Heat Wave Alert',
                'ar' => 'تنبيه موجة حر شديدة',
                'ku' => 'ئاگاداری شەپۆلی گەرمای سەخت',
            ],
            'description' => [
                'en' => 'Temperatures will exceed 50°C over the next 3 days. Avoid outdoor activities and stay hydrated.',
                'ar' => 'ستتجاوز درجات الحرارة 50 درجة مئوية خلال الأيام الثلاثة القادمة. تجنبوا الأنشطة الخارجية واشربوا الماء.',
                'ku' => 'پلەی گەرمی لە 3 ڕۆژی داهاتوودا لە 50 پلەی سەنتیگراد تێدەپەڕێت. لە چالاکی دەرەوە دووربکەوە و ئاو بخۆرەوە.',
            ],
            'type' => NotificationType::Danger,
        ]);

        Notification::create([
            'icon' => 'bell',
            'title' => [
                'en' => 'New Weather Station Online',
                'ar' => 'محطة طقس جديدة متصلة',
                'ku' => 'وێستگەی نوێی کەشوهەوا کارپێکرا',
            ],
            'description' => [
                'en' => 'A new weather station has been deployed in Erbil and is now reporting live data.',
                'ar' => 'تم نشر محطة طقس جديدة في أربيل وبدأت بإرسال البيانات المباشرة.',
                'ku' => 'وێستگەی نوێی کەشوهەوا لە هەولێر دانرا و ئێستا داتای ڕاستەوخۆ دەنێرێت.',
            ],
            'type' => NotificationType::Info,
        ]);

        Notification::create([
            'icon' => 'warning',
            'title' => [
                'en' => 'Strong Winds Advisory',
                'ar' => 'تحذير من رياح قوية',
                'ku' => 'ئاگاداری بایە بەهێزەکان',
            ],
            'description' => [
                'en' => 'Wind speeds of up to 80 km/h are forecast for tonight. Secure outdoor equipment and avoid travel.',
                'ar' => 'من المتوقع أن تصل سرعة الرياح إلى 80 كم/ساعة الليلة. قم بتأمين المعدات الخارجية وتجنب السفر.',
                'ku' => 'خێرایی با تا 80 کم/کاتژمێر بۆ ئەمشەو پێشبینی دەکرێت. ئامێرەکانی دەرەوە دابنێ و لە گەشتکردن دووربکەوە.',
            ],
            'type' => NotificationType::Warning,
        ]);
    }
}
