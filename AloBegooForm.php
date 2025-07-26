<?php
/**
 * Plugin Name: فرم درخواست تعمیر لوازم خانگی
 * Description: یک فرم کامل برای ثبت درخواست تعمیر لوازم خانگی با API های مختلف.
 * Version: 1.0.0
 * Author: Pooyan & Keyvan(backend)
 */

if (!defined('ABSPATH')) {
    exit; 
}

function tamir_form_shortcode() {
    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="fa" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>فرم درخواست تعمیر لوازم خانگی</title>
        <!-- فونت فارسی Vazirmatn -->
        <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700&display=swap" rel="stylesheet">
        <!-- Font Awesome برای آیکون‌ها -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <style>
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            body {
                font-family: 'Vazirmatn', sans-serif;
                background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
                color: #333;
                line-height: 1.7;
                padding: 20px;
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .container {
				max-width:1140px;
                width: 100%;
                background: #ffffff;
                border-radius: 16px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            .form-header {
                background: #FCA40C;
                color: white;
                padding: 24px;
                text-align: center;
                font-size: 22px;
                font-weight: 600;
            }

            .form-body {
                padding: 30px;
            }

            .form-group {
                margin-bottom: 22px;
            }

            label {
                display: block;
                margin-bottom: 8px;
                font-weight: 600;
                color: #2c3e50;
                font-size: 15px;
            }

            .required {
                color: #e74c3c;
                font-weight: normal;
                margin-right: 4px;
            }

            .optional {
                color: #95a5a6;
                font-size: 13px;
                font-weight: normal;
            }

            input[type="text"],
            input[type="tel"],
            select,
            textarea {
                width: 100%;
                padding: 14px 16px;
                border: 2px solid #ddd;
                border-radius: 8px;
                font-size: 16px;
                transition: all 0.3s ease;
                background-color: #fdfdfd;
            }

            input[type="text"]:focus,
            input[type="tel"]:focus,
            select:focus,
            textarea:focus {
                border-color: #0d6efd;
                outline: none;
                background-color: #ffffff;
                box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
            }

            select {
                cursor: pointer;
            }

            /* Radio Buttons - گارانتی */
            .radio-group {
                display: flex;
                gap: 20px;
                flex-wrap: wrap;
            }

            .radio-option {
                display: flex;
                align-items: center;
                cursor: pointer;
                user-select: none;
                font-size: 15px;
                padding: 8px 14px;
                background: #f8f9fa;
                border-radius: 6px;
                border: 1px solid #dee2e6;
                transition: all 0.2s ease;
            }

            .radio-option:hover {
                background: #e9ecef;
            }

            .radio-option input {
                margin-left: 8px;
                accent-color: #0d6efd;
                transform: scale(1.2);
            }

            /* دکمه‌های موقعیت */
            .location-actions {
                display: flex;
                gap: 12px;
                flex-wrap: wrap;
            }

            .btn {
                padding: 12px 18px;
                border: none;
                border-radius: 8px;
                font-size: 15px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                flex: 1;
                min-width: 130px;
            }

            .btn-location {
                background: #198754;
                color: white;
            }

            .btn-clear {
                background: #dc3545;
                color: white;
            }

            .btn:hover {
                opacity: 0.9;
                transform: translateY(-2px);
            }

            .btn:active {
                transform: translateY(0);
            }

            /* دکمه ثبت درخواست */
            .submit-btn {
                width: 100%;
                padding: 16px;
                background: #FCA40C;
                color: white;
                font-size: 18px;
                font-weight: 700;
                border: none;
                border-radius: 10px;
                cursor: pointer;
                transition: all 0.3s ease;
                margin-top: 10px;
            }

            .submit-btn:hover {
                background: #e69500;
                box-shadow: 0 6px 12px rgba(252, 164, 12, 0.3);
            }

            .submit-btn:active {
                transform: translateY(1px);
            }

            /* فیلد "سایر برند" - فقط وقتی نمایش داده شود */
            #otherBrandField {
                display: none;
                margin-top: 10px;
                animation: fadeIn 0.3s ease;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(-5px); }
                to { opacity: 1; transform: translateY(0); }
            }

            select {
                background-image: url("image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%230d6efd' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
                background-repeat: no-repeat;
                background-position: right 16px center;
                background-size: 16px;
                padding-left: 16px;
                padding-right: 40px;
            }

            /* Loader */
            .loader {
                display: none;
                border: 4px solid #f3f3f3;
                border-top: 4px solid #0d6efd;
                border-radius: 50%;
                width: 24px;
                height: 24px;
                animation: spin 1s linear infinite;
                margin: 0 auto;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
    </head>
    <body>

    <div class="container">
        <div class="form-header">
            درخواست تعمیر لوازم خانگی
        </div>

        <div class="form-body">
            <form id="repairForm">
                <!-- نام -->
                <div class="form-group">
                    <label for="firstName">نام <span class="required">*</span></label>
                    <input type="text" id="firstName" name="firstName" placeholder="نام خود را وارد کنید" required />
                </div>

                <!-- نام خانوادگی -->
                <div class="form-group">
                    <label for="lastName">نام خانوادگی <span class="required">*</span></label>
                    <input type="text" id="lastName" name="lastName" placeholder="نام خانوادگی خود را وارد کنید" required />
                </div>

                <!-- استان -->
                <div class="form-group">
                    <label for="province">استان <span class="required">*</span></label>
                    <select id="province" name="province" required>
                        <option value="">انتخاب استان...</option>
                    </select>
                </div>

                <!-- شهر -->
                <div class="form-group">
                    <label for="city">شهر <span class="required">*</span></label>
                    <select id="city" name="city" required disabled>
                        <option value="">ابتدا استان را انتخاب کنید</option>
                    </select>
                </div>

                <!-- شماره موبایل -->
                <div class="form-group">
                    <label for="phone">شماره موبایل <span class="required">*</span></label>
                    <input type="tel" id="phone" name="phone" placeholder="مثال: 09123456789" required />
                </div>

                <!-- نوع دستگاه -->
                <div class="form-group">
                    <label for="deviceType">نوع دستگاه <span class="required">*</span></label>
                    <select id="deviceType" name="deviceType" required>
                        <option value="">انتخاب نوع دستگاه...</option>
                        <option value="0">یخچال فریزر</option>
                        <option value="1">یخچال ساید بای ساید</option>
                        <option value="2">ماشین لباسشویی</option>
                        <option value="3">ماشین ظرفشویی</option>
                        <option value="4">مایکروفر</option>
                        <option value="5">جاروبرقی</option>
                        <option value="6">تلویزیون</option>
                    </select>
                </div>

                <!-- برند دستگاه -->
                <div class="form-group">
                    <label for="brand">برند دستگاه <span class="required">*</span></label>
                    <select id="brand" name="brand" required>
                        <option value="">انتخاب برند...</option>
                        <option value="8330">آ ا گ</option>
                        <option value="8274">آبسال</option>
                        <option value="81">آرچلیک</option>
                        <option value="361">آریستون</option>
                        <option value="77">آیسان</option>
                        <option value="375">ارج</option>
                        <option value="83">استیلون</option>
                        <option value="259">اسنوا</option>
                        <option value="258">الجی</option>
                        <option value="361">الکترواستیل</option>
                        <option value="88">الکتروجنرال</option>
                        <option value="8331">الگانس</option>
                        <option value="18260">امرسان</option>
                        <option value="375">اوشن</option>
                        <option value="90">اورست</option>
                        <option value="375">ایران شرق</option>
                        <option value="361">ایران رادیاتور</option>
                        <option value="361">ایساتیس</option>
                        <option value="260">ایکس ویژن</option>
                        <option value="350">ایندزیت</option>
                        <option value="250">ایونیوا</option>
                        <option value="375">باگنشت</option>
                        <option value="101">برفاب</option>
                        <option value="8262">بست</option>
                        <option value="4847">بلک اند کر</option>
                        <option value="375">بوست</option>
                        <option value="351">بوش</option>
                        <option value="95">بولومبرگ</option>
                        <option value="8258">بکو</option>
                        <option value="361">بوتان</option>
                        <option value="361">پارس</option>
                        <option value="401">پاکشوما</option>
                        <option value="279">پاناسونیک</option>
                        <option value="246">پات پوینت</option>
                        <option value="99">پروفایل</option>
                        <option value="302">تراست</option>
                        <option value="4845">تکنو</option>
                        <option value="353">تکنوگاز</option>
                        <option value="261">تی سی ال</option>
                        <option value="330">جنرال</option>
                        <option value="31">جنرال ادو</option>
                        <option value="107">جنرال استیل</option>
                        <option value="108">جنرال الکتریک</option>
                        <option value="109">جنرال بست</option>
                        <option value="111">جنرال هوس</option>
                        <option value="262">جی پلاس</option>
                        <option value="18264">داتیس</option>
                        <option value="4850">دلمونتی</option>
                        <option value="263">دوو</option>
                        <option value="8273">دونار</option>
                        <option value="115">دی پوینت</option>
                        <option value="375">زاموس</option>
                        <option value="375">زانوسی</option>
                        <option value="8263">زیرووات</option>
                        <option value="8265">زیمنس</option>
                        <option value="118">زیمس</option>
                        <option value="268">سام</option>
                        <option value="264">سامسونگ</option>
                        <option value="4855">سایر</option>
                        <option value="124">سایوان</option>
                        <option value="18262">سپهر الکتریک</option>
                        <option value="375">سوپرجنرال</option>
                        <option value="125">سوزان</option>
                        <option value="265">سونی</option>
                        <option value="127">سونیا</option>
                        <option value="128">سیلوان</option>
                        <option value="129">سیلور</option>
                        <option value="130">سیلورهوس</option>
                        <option value="283">سینجر</option>
                        <option value="270">شارپ</option>
                        <option value="361">صنام</option>
                        <option value="135">فروزان</option>
                        <option value="136">فریجستار</option>
                        <option value="137">فریجیدر</option>
                        <option value="139">فیلورهوس</option>
                        <option value="248">فلر</option>
                        <option value="411">فیلیپس</option>
                        <option value="324">فوجی</option>
                        <option value="141">گلداستار</option>
                        <option value="407">گوسونیک</option>
                        <option value="325">گرین</option>
                        <option value="311">گلدیران</option>
                        <option value="142">مابه</option>
                        <option value="266">مجیک</option>
                        <option value="144">مجیک شف</option>
                        <option value="283">مدیا</option>
                        <option value="283">متفرقه</option>
                        <option value="328">میتسوبیشی</option>
                        <option value="414">میله</option>
                        <option value="148">میشل</option>
                        <option value="146">مهیان</option>
                        <option value="283">ناسیونال</option>
                        <option value="151">نیکسان</option>
                        <option value="161">وایت هوس</option>
                        <option value="162">وایت وستینگ هوس</option>
                        <option value="322">وست پوینت</option>
                        <option value="164">وست هوم</option>
                        <option value="344">وستینگ هوس</option>
                        <option value="283">وستل</option>
                        <option value="412">ویداس</option>
                        <option value="4853">ویرپول</option>
                        <option value="176">یخساران</option>
                        <option value="179">یوش</option>
                        <option value="8287">های سنس</option>
                        <option value="155">های‌سنس</option>
                        <option value="8289">هایر</option>
                        <option value="4854">هاردستون</option>
                        <option value="157">هوور</option>
                        <option value="8290">هیتاچی</option>
                        <option value="8291">هیوندای</option>
                        <option value="274">هیمالیا</option>
                        <option value="171">کلور</option>
                        <option value="173">کلویناتور</option>
                        <option value="8281">کندی</option>
                        <option value="408">کنوود</option>
                        <option value="175">کنمور</option>
                        <option value="8282">کرال</option>
                        <option value="355">پارادیس</option>
                    </select>
                </div>

                <!-- ورودی "سایر برند" -->
                <div class="form-group" id="otherBrandField">
                    <input type="text" id="otherBrand" name="otherBrand" placeholder="نام برند را وارد کنید" />
                </div>

                <!-- وضعیت گارانتی -->
                <div class="form-group">
                    <label>وضعیت گارانتی <span class="required">*</span></label>
                    <div class="radio-group">
                        <label class="radio-option">
                            <input type="radio" name="warranty" value="0" required> دارد
                        </label>
                        <label class="radio-option">
                            <input type="radio" name="warranty" value="1" required> ندارد
                        </label>
                        <label class="radio-option">
                            <input type="radio" name="warranty" value="2" required> مطمئن نیستم
                        </label>
                    </div>
                </div>

                <!-- آدرس -->
                <div class="form-group">
                    <label for="address">آدرس <span class="optional">(اختیاری)</span></label>
                    <input type="text" id="address" name="address" placeholder="آدرس دقیق محل سکونت" />
                </div>

                <!-- موقعیت فعلی -->
                <div class="form-group">
                    <label>موقعیت من</label>
                    <div class="location-actions">
                        <button type="button" id="getLocation" class="btn btn-location">
                            <i class="fas fa-map-marker-alt"></i> تعیین موقعیت فعلی
                        </button>
                        <button type="button" id="clearLocation" class="btn btn-clear">
                            <i class="fas fa-times"></i> پاک کردن موقعیت
                        </button>
                    </div>
                </div>

                <!-- منطقه -->
                <div class="form-group">
                    <label for="region">منطقه <span class="required">*</span></label>
                    <input type="text" id="region" name="region" placeholder="مثلاً: منطقه 3, شمال شهر" required />
                </div>

                <!-- شرح مشکل -->
                <div class="form-group">
                    <label for="description">شرح مشکل <span class="required">*</span></label>
                    <textarea id="description" name="description" rows="4"
                              placeholder="مشکل دستگاه را به طور کامل توضیح دهید..." required></textarea>
                </div>

                <!-- دکمه ارسال -->
                <button type="submit" class="submit-btn" id="submitBtn">
                    <i class="fas fa-paper-plane"></i> ثبت درخواست تعمیر
                </button>

                <!-- Loader -->
                <div class="loader" id="loader"></div>
            </form>
        </div>
    </div>

    <script>
        const provinces = [{"Id":1,"prvName":"کرمان","prvPriority":10},{"Id":3,"prvName":"فارس","prvPriority":5},{"Id":4,"prvName":"بوشهر","prvPriority":21},{"Id":6,"prvName":"خراسان رضوی","prvPriority":3},{"Id":7,"prvName":"قم","prvPriority":9},{"Id":8,"prvName":"تهران","prvPriority":0},{"Id":9,"prvName":"یزد","prvPriority":14},{"Id":10,"prvName":"اصفهان","prvPriority":4},{"Id":13,"prvName":"گلستان","prvPriority":15},{"Id":14,"prvName":"مازندران","prvPriority":6},{"Id":17,"prvName":"خوزستان","prvPriority":8},{"Id":18,"prvName":"ایلام","prvPriority":23},{"Id":19,"prvName":"لرستان","prvPriority":20},{"Id":20,"prvName":"کرمانشاه","prvPriority":16},{"Id":21,"prvName":"کردستان","prvPriority":16},{"Id":22,"prvName":"زنجان","prvPriority":17},{"Id":23,"prvName":"آذربایجان شرقی","prvPriority":7},{"Id":24,"prvName":"اردبیل","prvPriority":18},{"Id":25,"prvName":"آذربایجان غربی","prvPriority":11},{"Id":26,"prvName":"گیلان","prvPriority":3},{"Id":27,"prvName":"قزوین","prvPriority":12},{"Id":28,"prvName":"مرکزی","prvPriority":19},{"Id":29,"prvName":"همدان","prvPriority":13},{"Id":30,"prvName":"البرز","prvPriority":2},{"Id":31,"prvName":"هرمزگان","prvPriority":22},{"Id":32,"prvName":"چهارمحال و بختیاری","prvPriority":24},{"Id":33,"prvName":"سیستان و بلوچستان","prvPriority":25},{"Id":34,"prvName":"کهگیلویه و بویراحمد","prvPriority":26},{"Id":35,"prvName":"سمنان","prvPriority":20}];

        const cities = [{"Id":1,"prvId":1,"ctyName":"کرمان","ctyPriority":1,"ctyIsActive":true},{"Id":2,"prvId":3,"ctyName":"شیراز","ctyPriority":1,"ctyIsActive":true},{"Id":3,"prvId":4,"ctyName":"بوشهر","ctyPriority":1,"ctyIsActive":true},{"Id":4,"prvId":1,"ctyName":"رفسنجان","ctyPriority":2,"ctyIsActive":true},{"Id":5,"prvId":6,"ctyName":"مشهد","ctyPriority":1,"ctyIsActive":true},{"Id":6,"prvId":6,"ctyName":"سبزوار","ctyPriority":2,"ctyIsActive":true},{"Id":7,"prvId":6,"ctyName":"طرقبه","ctyPriority":4,"ctyIsActive":true},{"Id":8,"prvId":6,"ctyName":"گلبهار","ctyPriority":3,"ctyIsActive":true},{"Id":9,"prvId":7,"ctyName":"قم","ctyPriority":1,"ctyIsActive":true},{"Id":10,"prvId":8,"ctyName":"تهران","ctyPriority":0,"ctyIsActive":true},{"Id":11,"prvId":8,"ctyName":"شهریار","ctyPriority":0,"ctyIsActive":true},{"Id":12,"prvId":8,"ctyName":"\tاسلامشهر","ctyPriority":0,"ctyIsActive":true},{"Id":13,"prvId":8,"ctyName":"\t\tبهارستان","ctyPriority":0,"ctyIsActive":true},{"Id":14,"prvId":8,"ctyName":"ملارد","ctyPriority":0,"ctyIsActive":true},{"Id":15,"prvId":8,"ctyName":"\tپاکدشت","ctyPriority":0,"ctyIsActive":true},{"Id":16,"prvId":8,"ctyName":"ری","ctyPriority":0,"ctyIsActive":true},{"Id":17,"prvId":8,"ctyName":"قدس","ctyPriority":0,"ctyIsActive":true},{"Id":18,"prvId":8,"ctyName":"رباط کریم","ctyPriority":0,"ctyIsActive":true},{"Id":19,"prvId":8,"ctyName":"ورامین","ctyPriority":0,"ctyIsActive":true},{"Id":20,"prvId":8,"ctyName":"قرچک","ctyPriority":0,"ctyIsActive":true},{"Id":21,"prvId":8,"ctyName":"پردیس","ctyPriority":0,"ctyIsActive":true},{"Id":22,"prvId":8,"ctyName":"دماوند","ctyPriority":0,"ctyIsActive":true},{"Id":23,"prvId":8,"ctyName":"پیشوا","ctyPriority":0,"ctyIsActive":true},{"Id":24,"prvId":8,"ctyName":"\tشمیرانات","ctyPriority":0,"ctyIsActive":true},{"Id":25,"prvId":9,"ctyName":"یزد","ctyPriority":0,"ctyIsActive":true},{"Id":26,"prvId":10,"ctyName":"اصفهان","ctyPriority":0,"ctyIsActive":true},{"Id":27,"prvId":10,"ctyName":"کاشان","ctyPriority":0,"ctyIsActive":true},{"Id":29,"prvId":10,"ctyName":"نجف\u200Cآباد","ctyPriority":0,"ctyIsActive":true},{"Id":30,"prvId":10,"ctyName":"زرین\u200Cشهر","ctyPriority":0,"ctyIsActive":true},{"Id":31,"prvId":10,"ctyName":"فلاورجان","ctyPriority":0,"ctyIsActive":true},{"Id":32,"prvId":10,"ctyName":"شاهین\u200Cشهر","ctyPriority":0,"ctyIsActive":true},{"Id":33,"prvId":10,"ctyName":"مبارکه","ctyPriority":0,"ctyIsActive":true},{"Id":34,"prvId":10,"ctyName":"دولت\u200Cآباد","ctyPriority":0,"ctyIsActive":true},{"Id":35,"prvId":13,"ctyName":"گرگان","ctyPriority":0,"ctyIsActive":true},{"Id":36,"prvId":14,"ctyName":"گلوگاه","ctyPriority":0,"ctyIsActive":true},{"Id":37,"prvId":14,"ctyName":"بهشهر","ctyPriority":0,"ctyIsActive":true},{"Id":38,"prvId":14,"ctyName":"نکا","ctyPriority":0,"ctyIsActive":true},{"Id":39,"prvId":14,"ctyName":"میاندورود","ctyPriority":0,"ctyIsActive":true},{"Id":40,"prvId":14,"ctyName":"ساری","ctyPriority":0,"ctyIsActive":true},{"Id":41,"prvId":14,"ctyName":"جویبار","ctyPriority":0,"ctyIsActive":true},{"Id":42,"prvId":14,"ctyName":"سیمرغ","ctyPriority":0,"ctyIsActive":true},{"Id":43,"prvId":14,"ctyName":"قائم\u200Cشهر","ctyPriority":0,"ctyIsActive":true},{"Id":44,"prvId":14,"ctyName":"سواد کوه","ctyPriority":0,"ctyIsActive":true},{"Id":45,"prvId":14,"ctyName":"بابلسر","ctyPriority":0,"ctyIsActive":true},{"Id":46,"prvId":14,"ctyName":"بابل","ctyPriority":0,"ctyIsActive":true},{"Id":47,"prvId":14,"ctyName":"فریدون\u200Cکنار","ctyPriority":0,"ctyIsActive":true},{"Id":48,"prvId":14,"ctyName":"محمود آباد","ctyPriority":0,"ctyIsActive":true},{"Id":49,"prvId":14,"ctyName":"آمل","ctyPriority":0,"ctyIsActive":true},{"Id":50,"prvId":14,"ctyName":"نور","ctyPriority":0,"ctyIsActive":true},{"Id":51,"prvId":14,"ctyName":"نوشهر","ctyPriority":0,"ctyIsActive":true},{"Id":52,"prvId":14,"ctyName":"چالوس","ctyPriority":0,"ctyIsActive":true},{"Id":53,"prvId":14,"ctyName":"کلاردشت","ctyPriority":0,"ctyIsActive":true},{"Id":54,"prvId":14,"ctyName":"عباس\u200Cآباد","ctyPriority":0,"ctyIsActive":true},{"Id":55,"prvId":14,"ctyName":"تنکابن","ctyPriority":0,"ctyIsActive":true},{"Id":56,"prvId":14,"ctyName":"رامسر","ctyPriority":0,"ctyIsActive":true},{"Id":57,"prvId":17,"ctyName":"اهواز","ctyPriority":0,"ctyIsActive":true},{"Id":58,"prvId":17,"ctyName":"آبادان","ctyPriority":0,"ctyIsActive":true},{"Id":59,"prvId":17,"ctyName":"دزفول","ctyPriority":0,"ctyIsActive":true},{"Id":60,"prvId":18,"ctyName":"ایلام","ctyPriority":0,"ctyIsActive":true},{"Id":61,"prvId":19,"ctyName":"خرم\u200Cآباد","ctyPriority":0,"ctyIsActive":true},{"Id":62,"prvId":20,"ctyName":"کرمانشاه","ctyPriority":0,"ctyIsActive":true},{"Id":63,"prvId":21,"ctyName":"\tسنندج","ctyPriority":0,"ctyIsActive":true},{"Id":64,"prvId":22,"ctyName":"\tزنجان","ctyPriority":0,"ctyIsActive":true},{"Id":65,"prvId":22,"ctyName":"\tابهر","ctyPriority":0,"ctyIsActive":true},{"Id":66,"prvId":23,"ctyName":"\tتبریز","ctyPriority":0,"ctyIsActive":true},{"Id":67,"prvId":24,"ctyName":"\tاردبیل","ctyPriority":0,"ctyIsActive":true},{"Id":68,"prvId":25,"ctyName":"\tارومیه","ctyPriority":0,"ctyIsActive":true},{"Id":69,"prvId":26,"ctyName":"رشت","ctyPriority":0,"ctyIsActive":true},{"Id":70,"prvId":26,"ctyName":"\tتالش","ctyPriority":0,"ctyIsActive":true},{"Id":71,"prvId":26,"ctyName":"لاهیجان","ctyPriority":0,"ctyIsActive":true},{"Id":72,"prvId":26,"ctyName":"رودسر","ctyPriority":0,"ctyIsActive":true},{"Id":73,"prvId":26,"ctyName":"لنگرود","ctyPriority":0,"ctyIsActive":true},{"Id":74,"prvId":26,"ctyName":"\tبندر انزلی","ctyPriority":0,"ctyIsActive":true},{"Id":75,"prvId":26,"ctyName":"صومعه\u200Cسرا","ctyPriority":0,"ctyIsActive":true},{"Id":76,"prvId":26,"ctyName":"\tآستانه اشرفیه","ctyPriority":0,"ctyIsActive":true},{"Id":77,"prvId":26,"ctyName":"رودبار","ctyPriority":0,"ctyIsActive":true},{"Id":78,"prvId":26,"ctyName":"فومن","ctyPriority":0,"ctyIsActive":true},{"Id":79,"prvId":26,"ctyName":"رضوانشهر","ctyPriority":0,"ctyIsActive":true},{"Id":80,"prvId":26,"ctyName":"خمام","ctyPriority":0,"ctyIsActive":true},{"Id":81,"prvId":26,"ctyName":"ماسال","ctyPriority":0,"ctyIsActive":true},{"Id":82,"prvId":26,"ctyName":"شفت","ctyPriority":0,"ctyIsActive":true},{"Id":83,"prvId":26,"ctyName":"سیاهکل","ctyPriority":0,"ctyIsActive":true},{"Id":84,"prvId":26,"ctyName":"املش","ctyPriority":0,"ctyIsActive":true},{"Id":85,"prvId":27,"ctyName":"قزوین","ctyPriority":0,"ctyIsActive":true},{"Id":86,"prvId":27,"ctyName":"تاکستان","ctyPriority":0,"ctyIsActive":true},{"Id":87,"prvId":27,"ctyName":"بوئین\u200Cزهرا","ctyPriority":0,"ctyIsActive":true},{"Id":88,"prvId":27,"ctyName":"آبیک","ctyPriority":0,"ctyIsActive":true},{"Id":89,"prvId":28,"ctyName":"اراک","ctyPriority":0,"ctyIsActive":true},{"Id":90,"prvId":29,"ctyName":"همدان","ctyPriority":0,"ctyIsActive":true},{"Id":91,"prvId":29,"ctyName":"کبودرآهنگ","ctyPriority":0,"ctyIsActive":true},{"Id":92,"prvId":30,"ctyName":"کرج","ctyPriority":1,"ctyIsActive":true},{"Id":93,"prvId":30,"ctyName":"فردیس","ctyPriority":2,"ctyIsActive":true},{"Id":94,"prvId":30,"ctyName":"ساوجبلاغ","ctyPriority":4,"ctyIsActive":true},{"Id":95,"prvId":30,"ctyName":"نظرآباد","ctyPriority":5,"ctyIsActive":true},{"Id":96,"prvId":30,"ctyName":"چهارباغ","ctyPriority":6,"ctyIsActive":true},{"Id":97,"prvId":30,"ctyName":"اشتهارد","ctyPriority":7,"ctyIsActive":true},{"Id":98,"prvId":30,"ctyName":"طالقان","ctyPriority":3,"ctyIsActive":true},{"Id":99,"prvId":10,"ctyName":"خمینی شهر","ctyPriority":0,"ctyIsActive":true},{"Id":100,"prvId":14,"ctyName":"سرخرود","ctyPriority":0,"ctyIsActive":true},{"Id":101,"prvId":31,"ctyName":"\tبندرعباس","ctyPriority":1,"ctyIsActive":true},{"Id":103,"prvId":17,"ctyName":"اندیمشک","ctyPriority":0,"ctyIsActive":true},{"Id":104,"prvId":31,"ctyName":"میناب","cty":4,"ctyIsActive":true},{"Id":105,"prvId":31,"ctyName":"قشم","ctyPriority":3,"ctyIsActive":true},{"Id":106,"prvId":31,"ctyName":"کیش","ctyPriority":2,"ctyIsActive":true},{"Id":107,"prvId":31,"ctyName":"\tرودان","ctyPriority":5,"ctyIsActive":true},{"Id":108,"prvId":31,"ctyName":"بندر لنگه","ctyPriority":6,"ctyIsActive":true},{"Id":109,"prvId":31,"ctyName":"بستک","ctyPriority":7,"ctyIsActive":true},{"Id":110,"prvId":31,"ctyName":"حاجی\u200Cآباد","ctyPriority":8,"ctyIsActive":true},{"Id":111,"prvId":31,"ctyName":"\tبندرجاسک","ctyPriority":9,"ctyIsActive":true},{"Id":112,"prvId":32,"ctyName":"شهرکرد","ctyPriority":0,"ctyIsActive":true},{"Id":113,"prvId":33,"ctyName":"زاهدان","ctyPriority":0,"ctyIsActive":true},{"Id":114,"prvId":33,"ctyName":"ایرانشهر","ctyPriority":0,"ctyIsActive":true},{"Id":115,"prvId":33,"ctyName":"چابهار","ctyPriority":0,"ctyIsActive":true},{"Id":116,"prvId":34,"ctyName":"یاسوج","ctyPriority":0,"ctyIsActive":true},{"Id":117,"prvId":35,"ctyName":"سمنان","ctyPriority":0,"ctyIsActive":true},{"Id":118,"prvId":35,"ctyName":"شاهرود","ctyPriority":0,"ctyIsActive":true},{"Id":119,"prvId":30,"ctyName":"هشتگرد","ctyPriority":8,"ctyIsActive":true},{"Id":120,"prvId":32,"ctyName":"لردگان","ctyPriority":0,"ctyIsActive":true},{"Id":121,"prvId":32,"ctyName":"بروجن","ctyPriority":0,"ctyIsActive":true},{"Id":122,"prvId":32,"ctyName":"فارسان","ctyPriority":0,"ctyIsActive":true},{"Id":123,"prvId":32,"ctyName":"آلونی","ctyPriority":0,"ctyIsActive":true},{"Id":124,"prvId":32,"ctyName":"شلمزار","ctyPriority":0,"ctyIsActive":true},{"Id":125,"prvId":32,"ctyName":"اردل","ctyPriority":0,"ctyIsActive":true},{"Id":126,"prvId":32,"ctyName":"چلگرد","ctyPriority":0,"ctyIsActive":true},{"Id":127,"prvId":32,"ctyName":"\tفرخشهر","ctyPriority":0,"ctyIsActive":true},{"Id":128,"prvId":32,"ctyName":"سامان","ctyPriority":0,"ctyIsActive":true},{"Id":129,"prvId":32,"ctyName":"\tمال\u200Cخلیفه\t","ctyPriority":0,"ctyIsActive":true},{"Id":130,"prvId":32,"ctyName":"بن","ctyPriority":0,"ctyIsActive":true}];

        const provinceSelect = document.getElementById('province');
        const citySelect = document.getElementById('city');

        provinces.sort((a, b) => a.prvPriority - b.prvPriority);

        provinces.forEach(province => {
            const option = document.createElement('option');
            option.value = province.Id;
            option.textContent = province.prvName;
            provinceSelect.appendChild(option);
        });

        provinceSelect.addEventListener('change', function () {
            const selectedProvinceId = parseInt(this.value);
            citySelect.innerHTML = '<option value="">انتخاب شهر...</option>';
            citySelect.disabled = !selectedProvinceId;

            if (selectedProvinceId) {
                const filteredCities = cities
                    .filter(city => city.prvId === selectedProvinceId && city.ctyIsActive)
                    .sort((a, b) => a.ctyPriority - b.ctyPriority);

                filteredCities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.Id;
                    option.textContent = city.ctyName.trim(); 
                    citySelect.appendChild(option);
                });
            }
        });

        const brandSelect = document.getElementById('brand');
        const otherBrandField = document.getElementById('otherBrandField');

        brandSelect.addEventListener('change', function () {
            if (this.value === "4855") {
                otherBrandField.style.display = 'block';
            } else {
                otherBrandField.style.display = 'none';
            }
        });

        document.getElementById('getLocation').addEventListener('click', function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (pos) => {
                        alert(`موقعیت یافت شد: طول ${pos.coords.longitude}, عرض ${pos.coords.latitude}`);
                    },
                    () => alert('دسترسی به موقعیت رد شد یا غیرفعال است.')
                );
            } else {
                alert('مرورگر شما از موقعیت مکانی پشتیبانی نمی‌کند.');
            }
        });

        document.getElementById('clearLocation').addEventListener('click', () => {
            alert('موقعیت پاک شد.');
        });

        // ارسال فرم
        document.getElementById('repairForm').addEventListener('submit', async function (e) {
            e.preventDefault();
            const submitBtn = document.getElementById('submitBtn');
            const loader = document.getElementById('loader');
            submitBtn.disabled = true;
            loader.style.display = 'block';

            const formData = {
                firstName: document.getElementById('firstName').value.trim(),
                lastName: document.getElementById('lastName').value.trim(),
                provinceId: parseInt(document.getElementById('province').value),
                cityId: parseInt(document.getElementById('city').value),
                phone: document.getElementById('phone').value.trim(),
                deviceType: parseInt(document.getElementById('deviceType').value),
                brand: parseInt(document.getElementById('brand').value),
                otherBrand: document.getElementById('otherBrand').value?.trim() || null,
                warranty: parseInt(document.querySelector('input[name="warranty"]:checked').value),
                address: document.getElementById('address').value?.trim() || null,
                region: document.getElementById('region').value.trim(),
                description: document.getElementById('description').value.trim()
            };

            try {
                // 1. چک کردن کاربر
                let response = await fetch('https://api.alobegoo.com/customerinfo-noauth/api/v1/customerInfo/getCustomerInfo', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ cstMobile: formData.phone })
                });

                if (!response.ok) {
                    const errorText = await response.text();
                    console.error("خطا در getCustomerInfo - وضعیت:", response.status, "متن:", errorText);
                    throw new Error(`خطا در ارتباط با سرور (کاربر): ${response.status}`);
                }

                let data = await response.json();
                let customerId = 0;

                if (data.statusCode === 0 && data.payload && Array.isArray(data.payload) && data.payload.length > 0) {
                    customerId = data.payload[0].id;
                    console.log("کاربر موجود است. ID:", customerId);
                } else {
                    // 2. ایجاد کاربر جدید
                    console.log("کاربر یافت نشد. در حال ایجاد کاربر جدید...");
                    response = await fetch('https://api.alobegoo.com/customerinfo-noauth/api/v1/customerInfo/createCustomerInfo', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            cstFirstName: formData.firstName,
                            cstLastName: formData.lastName,
                            cstMobile: formData.phone
                        })
                    });

                    if (!response.ok) {
                        const errorText = await response.text();
                        console.error("خطا در createCustomerInfo - وضعیت:", response.status, "متن:", errorText);
                        throw new Error(`خطا در ارتباط با سرور (ایجاد کاربر): ${response.status}`);
                    }

                    data = await response.json();

                    if (data.statusCode === 0 && typeof data.payload === 'number') {
                        customerId = data.payload;
                        console.log("کاربر جدید ایجاد شد. ID:", customerId);
                    } else {
                        console.error("خطا در ایجاد کاربر - پاسخ API:", data);
                        throw new Error('خطا در ایجاد کاربر جدید: ' + (data.message || ''));
                    }
                }

                const finalDataForSubmitApi = {
                    region: formData.region,
                    problem: formData.description,
                    brand: formData.brand,
                    cmpId: 3, 
                    cityId: formData.cityId,
                    provinceId: formData.provinceId,
                    lat: 0,
                    long: 0,
                    userId: customerId,
                    device: formData.deviceType,
                    warranty: formData.warranty
                };

                console.log('--- داده‌های آماده برای ارسال به SubmitAlobegooOrder ---');
                console.log(JSON.stringify(finalDataForSubmitApi, null, 2));

                // --- ارسال به API نهایی ---
                const submitApiResponse = await fetch('https://api.alobegoo.com/order-noauth/api/v1/order/SubmitAlobegooOrder', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(finalDataForSubmitApi)
                });

                if (!submitApiResponse.ok) {
                    const errorText = await submitApiResponse.text();
                    console.error("خطا در SubmitAlobegooOrder - وضعیت:", submitApiResponse.status, "متن:", errorText);
                    throw new Error(`خطا در ارسال درخواست تعمیر: ${submitApiResponse.status}`);
                }

                const submitResult = await submitApiResponse.json();
                console.log('پاسخ API نهایی SubmitAlobegooOrder:', submitResult);

                if(submitResult.statusCode === 0) {
                    alert('درخواست تعمیر با موفقیت ثبت شد!');
                } else {
                    console.error("خطا در ثبت درخواست - پاسخ API:", submitResult);
                    alert('خطا در ثبت درخواست: ' + (submitResult.message || 'خطای نامشخص'));
                }

            } catch (error) {
                console.error('خطا در فرآیند:', error);
                alert('خطا در ارتباط با سرور: ' + error.message);
            } finally {
                submitBtn.disabled = false;
                loader.style.display = 'none';
            }
        });
    </script>
    </body>
    </html>
    <?php
    return ob_get_clean();
}
add_shortcode('tamir_form', 'tamir_form_shortcode');