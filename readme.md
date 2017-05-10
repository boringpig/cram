敦品補習班網站!
===
開發目的為降低補習班紙本的浪費並將資料整合，做好有效的管理及即時性查詢。讓每天重複性的班級點名、上班打卡的動作，不再因為學生及工讀生的人數流動、出席狀況等等，造成管理上的缺失及紙本的浪費。本網站不僅以改善工作流程為目的，也希望成為完整的網頁，加入了會員帳戶、留言板、張貼公告、行事曆等功能。

## 主要功能
   - 上下班打卡
   - 班級點名

## 開發語言
   - Laravel 5.2
   - MySQL
   - jQuery、Ajax
   - Bootstrap 3

## 套件使用
   - [laravel/socialite](https://github.com/laravel/socialite)(Social Authentication)
   - [spatie/laravel-activitylog](https://github.com/spatie/laravel-activitylog)(紀錄使用者的操作)
   - [zizaco/entrust](https://github.com/Zizaco/entrust)(ACL)
   - [intervention/image](https://github.com/Intervention/image)(圖片上傳處理)
   - [league/flysystem-aws-s3-v3](https://github.com/thephpleague/flysystem-aws-s3-v3)(Amazon S3 橋接設定)
   - [laracasts/presenter](https://github.com/laracasts/Presenter)(顯示邏輯使用)
   - [uxweb/sweet-alert](https://github.com/uxweb/sweet-alert)(SweetAlert使用)
   - [mews/purifier](https://github.com/mewebstudio/Purifier)(過濾使用者的惡意語法)
   - [proengsoft/laravel-jsvalidation](https://github.com/proengsoft/laravel-jsvalidation)(整合 laravel validation 進行 ajax 處理)

## 外部API使用
   - Google Maps API
   - Facebook API
   - Amazon S3

## 資料夾結構
```
cram/
├─ app/
│  ├─ Http
│  │  ├─ Controllers/
│  │  ├─ Middleware/
│  │  ├─ Requests/
│  │  ├─ ViewComposers/    // 樣板組合
│  │  ├─ Kernel.php/
│  │  └─ routes.php/       // 伺服器路由
│  ├─ Models/              // 資料表物件
│  ├─ Presenters/          // 顯示邏輯
│  ├─ Repositories/        // 資料庫邏輯
│  ├─ Services/            // 商業邏輯
│  └─ Traits/
├─ bootstrap/
├─ config/
├─ database/               // migrations 檔案
├─ public/                 // css 及 js 檔案
├─ resources/              // views 樣板
├─ storage/
├─ tests/
├─ vendor/
├─ .env.php/                // 伺服器設定
├─ _ide_helper.php
├─ _ide_helper_models.php
├─ _migration_helper.php
├─ artisan.php
├─ composer.json
├─ package.json
    .
    .
    .
```

## 系統介紹
- <p style="font:14pt"> 帳戶登入 </p>

![](https://i.imgur.com/EYa4pPY.png)

![](https://i.imgur.com/0CBolVV.png)

- <p style="font:14pt"> 會員帳戶 </p>
![](https://i.imgur.com/jdt0dxj.png)

![](https://i.imgur.com/wBAYnSM.png)

- <p style="font:14pt"> 上班打卡 </p>
![](https://i.imgur.com/HjCDWnY.png)

![](https://i.imgur.com/uopzZdu.png)

![](https://i.imgur.com/N46aMhc.png)

![](https://i.imgur.com/Gx7rVGn.png)

- <p style="font:14pt"> 班級點名 </p>
![](https://i.imgur.com/oduUVYP.png)

![](https://i.imgur.com/7Snkr9o.png)

![](https://i.imgur.com/R8ywgAn.png)

- <p style="font:14pt"> 聯絡我們 </p>
![](https://i.imgur.com/iSbZYek.png)

![](https://i.imgur.com/q7gEeHI.png)

- <p style="font:14pt"> 權限管理 </p>
![](https://i.imgur.com/QK7NeDO.png)

![](https://i.imgur.com/TP2jDRf.png)

![](https://i.imgur.com/3XNgOyj.png)

![](https://i.imgur.com/hQVtc8w.png)
