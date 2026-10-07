<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AcademicCalendarController;
use App\Http\Controllers\Admin\AcademicController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GalleryController;           // Galeri Alumni
use App\Http\Controllers\Admin\GaleriKegiatanController;    // Galeri Kegiatan Harian
use App\Http\Controllers\Admin\KalenderController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PpdbController;
use App\Http\Controllers\Admin\PpdbRegistrationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SambutanKepsekController;    // Sambutan Kepsek
use App\Http\Controllers\Frontend\AcademicController as FrontendAcademicController;
use App\Http\Controllers\Frontend\GaleriController as FrontendGaleriController;          // Frontend Alumni
use App\Http\Controllers\Frontend\GaleriKegiatanController as FrontendKegiatanController; // Frontend Kegiatan
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\KontakaController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\PpdbController as FrontendPpdbController;
use App\Http\Controllers\Frontend\ProfileController as FrontendProfileController;
use App\Http\Controllers\ProfileController as UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Profile Routes Frontend
Route::prefix('profil')->name('profile.')->group(function () {
    Route::get('/sejarah', [FrontendProfileController::class, 'history'])->name('history');
    Route::get('/visi-misi', [FrontendProfileController::class, 'visionMission'])->name('vision-mission');
    Route::get('/guru', [FrontendProfileController::class, 'teachers'])->name('teachers');
    Route::get('/staf', [FrontendProfileController::class, 'staff'])->name('staff');
    Route::get('/fasilitas', [FrontendProfileController::class, 'facilities'])->name('facilities');
});

// route kalender akademik frontend
// Routes untuk frontend user
Route::get('/kalender-akademik', [AcademicCalendarController::class, 'index'])->name('academic-calendars.index');
Route::get('/kalender-akademik/filter', [AcademicCalendarController::class, 'filterByYear'])->name('academic-calendars.filter');
Route::get('/kalender-akademik/current', [AcademicCalendarController::class, 'current'])->name('academic-calendars.current');
Route::get('/kalender-akademik/{academicCalendar}', [AcademicCalendarController::class, 'show'])->name('academic-calendars.show');
Route::get('/kalender-akademik/{academicCalendar}/download', [AcademicCalendarController::class, 'download'])->name('academic-calendars.download');
Route::get('/kalender-akademik/{academicCalendar}/preview', [AcademicCalendarController::class, 'preview'])->name('academic-calendars.preview');


// Academic Routes Frontend
Route::prefix('akademik')->name('academic.')->group(function () {
    Route::get('/kurikulum', [FrontendAcademicController::class, 'curriculum'])->name('curriculum');
    Route::get('/ekstrakurikuler', [FrontendAcademicController::class, 'extracurricular'])->name('extracurricular');
    Route::get('/prestasi', [FrontendAcademicController::class, 'achievement'])->name('achievement');
});

// Blog routes lama dihapus — digantikan oleh news.* routes di bawah

// PPDB Routes Frontend
Route::prefix('ppdb')->name('ppdb.')->group(function () {
    Route::get('/', [FrontendPpdbController::class, 'index'])->name('index');        // Tentang PPDB
    Route::get('/info', [FrontendPpdbController::class, 'info'])->name('info');      // Informasi & Persyaratan
    Route::get('/form', [FrontendPpdbController::class, 'form'])->name('form');      // Form Pendaftaran
    Route::post('/form', [FrontendPpdbController::class, 'store'])->name('store');   // Submit pendaftaran
    Route::get('/status', [FrontendPpdbController::class, 'status'])->name('status');
    Route::post('/status', [FrontendPpdbController::class, 'checkStatus'])->name('check-status');
});

// News Routes Frontend
Route::prefix('berita')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/kategori/{slug}', [NewsController::class, 'category'])->name('category');
    // detail harus setelah /kategori agar tidak tertangkap duluan
    Route::get('/{slug}', [NewsController::class, 'show'])->name('detail');
    // alias news.show → redirect ke news.detail agar view lama tidak 404
    Route::get('/show/{slug}', fn($slug) => redirect()->route('news.detail', $slug))->name('show');
});

// ── Galeri Kegiatan Harian (publik) ──────────────────────────────────────
Route::prefix('galeri')->name('gallery.')->group(function () {
    Route::get('/', [FrontendKegiatanController::class, 'index'])->name('index');
    Route::get('/{galeriKegiatan}', [FrontendKegiatanController::class, 'show'])->name('show');
});

// ── Galeri Alumni (publik) ────────────────────────────────────────────────
Route::prefix('alumni/galeri')->name('alumni.galeri.')->group(function () {
    Route::get('/', [FrontendGaleriController::class, 'index'])->name('index');
    Route::get('/{galeri:slug}', [FrontendGaleriController::class, 'show'])->name('show');
});

Route::prefix('kontak')->name('contact.')->group(function () {
    Route::get('/kontak', [KontakaController::class, 'create'])->name('contact');
    Route::post('/kontak', [KontakaController::class, 'store'])->name('store');
});

// Dashboard route untuk Breeze compatibility
Route::get('/dashboard', function () {
    /** @var \App\Models\User $user */
    $user = Auth::user();
    return redirect()->route($user ? $user->dashboardRoute() : 'login');
})->middleware(['auth', 'verified'])->name('dashboard');

// ─── Dashboard per Role ─────────────────────────────────────────────────────
// Satu controller (AdminController::dashboard) yang mendispatch ke view berbeda.
// Setiap route dilindungi middleware 'role' — tidak bisa diakses role lain.

Route::middleware(['auth', 'verified'])->group(function () {

    // Kepala Sekolah
    Route::get('/portal/kepala-sekolah', [AdminController::class, 'dashboard'])
        ->middleware('role:kepala_sekolah')
        ->name('dashboard.kepala_sekolah');

    // Guru Kelas (Wali Kelas)
    Route::get('/portal/guru-kelas', [AdminController::class, 'dashboard'])
        ->middleware('role:guru_kelas')
        ->name('dashboard.guru_kelas');

    // Guru Mata Pelajaran
    Route::get('/portal/guru-mapel', [AdminController::class, 'dashboard'])
        ->middleware('role:guru_mapel')
        ->name('dashboard.guru_mapel');

    // Siswa
    Route::get('/portal/siswa', [AdminController::class, 'dashboard'])
        ->middleware('role:siswa')
        ->name('dashboard.siswa');
});

// Admin Routes Group - HANYA SATU GROUP
Route::middleware(['auth', 'verified', 'role:admin,super_admin,kepala_sekolah'])
    ->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->withoutMiddleware('role:admin,super_admin,kepala_sekolah')
        ->middleware('role:admin,super_admin')
        ->name('dashboard');


    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');
    Route::get('/kontak/{id}', [KontakController::class, 'show'])->name('kontak.show');
    Route::delete('/kontak/{id}', [KontakController::class, 'destroy'])->name('kontak.destroy');
    Route::post('/kontak/rate-limit', [KontakController::class, 'updateRateLimit'])->name('kontak.update-rate-limit');
    
    // Profile Management Routes — hanya super_admin
    Route::middleware('role:super_admin')->group(function () {

    Route::prefix('profile')->name('profile.')->group(function () {
        // Sejarah Sekolah
        Route::get('/history', [ProfileController::class, 'history'])->name('history');
        Route::post('/history', [ProfileController::class, 'historyUpdate'])->name('history.update');
        
        // Visi & Misi
        Route::get('/vision-mission', [ProfileController::class, 'visionMission'])->name('vision-mission');
        Route::post('/vision-mission', [ProfileController::class, 'visionMissionUpdate'])->name('vision-mission.update');
        
        // Staff Management Routes
        Route::get('/staff', [ProfileController::class, 'staffIndex'])->name('staff.index');
        Route::get('/staff/create', [ProfileController::class, 'staffCreate'])->name('staff.create');
        Route::post('/staff', [ProfileController::class, 'staffStore'])->name('staff.store');
        Route::get('/staff/{staff}/edit', [ProfileController::class, 'staffEdit'])->name('staff.edit');
        Route::put('/staff/{staff}', [ProfileController::class, 'staffUpdate'])->name('staff.update');
        Route::delete('/staff/{staff}', [ProfileController::class, 'staffDestroy'])->name('staff.destroy');
        
        // Facilities Management Routes
        Route::get('/facilities', [ProfileController::class, 'facilitiesIndex'])->name('facilities.index');
        Route::get('/facilities/create', [ProfileController::class, 'facilitiesCreate'])->name('facilities.create');
        Route::post('/facilities', [ProfileController::class, 'facilitiesStore'])->name('facilities.store');
        Route::get('/facilities/{facility}/edit', [ProfileController::class, 'facilitiesEdit'])->name('facilities.edit');
        Route::put('/facilities/{facility}', [ProfileController::class, 'facilitiesUpdate'])->name('facilities.update');
        Route::delete('/facilities/{facility}', [ProfileController::class, 'facilitiesDestroy'])->name('facilities.destroy');
    });

    // manajemen kalender akademik — hanya super_admin
    Route::prefix('academic')->name('academic.')->group(function () {
        Route::resource('academic-calendars', KalenderController::class);
        Route::get('/academic-calendars/{academicCalendar}/download', [KalenderController::class, 'download'])->name('academic-calendars.download');
        Route::post('/academic-calendars/{academicCalendar}/activate', [KalenderController::class, 'activate'])->name('academic-calendars.activate');
        Route::post('/academic-calendars/{id}/restore', [KalenderController::class, 'restore'])->name('academic-calendars.restore');
        Route::delete('/academic-calendars/{id}/force-delete', [KalenderController::class, 'forceDestroy'])->name('academic-calendars.force-delete');
    });

    // Academic Management Routes — hanya super_admin
    Route::prefix('academic')->name('academic.')->group(function () {
        // Curriculum Routes
        Route::get('/curriculum', [AcademicController::class, 'curriculumIndex'])->name('curriculum.index');
        Route::get('/curriculum/create', [AcademicController::class, 'curriculumCreate'])->name('curriculum.create');
        Route::post('/curriculum', [AcademicController::class, 'curriculumStore'])->name('curriculum.store');
        Route::get('/curriculum/{curriculum}/edit', [AcademicController::class, 'curriculumEdit'])->name('curriculum.edit');
        Route::put('/curriculum/{curriculum}', [AcademicController::class, 'curriculumUpdate'])->name('curriculum.update');
        Route::delete('/curriculum/{curriculum}', [AcademicController::class, 'curriculumDestroy'])->name('curriculum.destroy');
        
        // Extracurricular Routes
        Route::get('/extracurricular', [AcademicController::class, 'extracurricularIndex'])->name('extracurricular.index');
        Route::get('/extracurricular/create', [AcademicController::class, 'extracurricularCreate'])->name('extracurricular.create');
        Route::post('/extracurricular', [AcademicController::class, 'extracurricularStore'])->name('extracurricular.store');
        Route::get('/extracurricular/{extracurricular}/edit', [AcademicController::class, 'extracurricularEdit'])->name('extracurricular.edit');
        Route::put('/extracurricular/{extracurricular}', [AcademicController::class, 'extracurricularUpdate'])->name('extracurricular.update');
        Route::delete('/extracurricular/{extracurricular}', [AcademicController::class, 'extracurricularDestroy'])->name('extracurricular.destroy');
        
        // Achievement Routes
        Route::get('/achievement', [AcademicController::class, 'achievementIndex'])->name('achievement.index');
        Route::get('/achievement/create', [AcademicController::class, 'achievementCreate'])->name('achievement.create');
        Route::post('/achievement', [AcademicController::class, 'achievementStore'])->name('achievement.store');
        Route::get('/achievement/{achievement}/edit', [AcademicController::class, 'achievementEdit'])->name('achievement.edit');
        Route::put('/achievement/{achievement}', [AcademicController::class, 'achievementUpdate'])->name('achievement.update');
        Route::delete('/achievement/{achievement}', [AcademicController::class, 'achievementDestroy'])->name('achievement.destroy');
    });

    }); // end role:super_admin

    // PPDB Management Routes
    Route::prefix('ppdb')->name('ppdb.')->group(function () {
        // Info Routes
        Route::get('/info', [PpdbController::class, 'infoIndex'])->name('info.index');
        Route::get('/info/create', [PpdbController::class, 'infoCreate'])->name('info.create');
        Route::post('/info', [PpdbController::class, 'infoStore'])->name('info.store');
        Route::get('/info/{info}/edit', [PpdbController::class, 'infoEdit'])->name('info.edit');
        Route::put('/info/{info}', [PpdbController::class, 'infoUpdate'])->name('info.update');
        Route::delete('/info/{info}', [PpdbController::class, 'infoDestroy'])->name('info.destroy');
        
        // Registration Routes
        Route::get('/registration', [PpdbRegistrationController::class, 'index'])->name('registration.index');
        Route::get('/registration/{registration}', [PpdbRegistrationController::class, 'show'])->name('registration.show');
        Route::get('/registration/{registration}/edit', [PpdbRegistrationController::class, 'edit'])->name('registration.edit');
        
        // PUT/POST Routes
        Route::put('/registration/{registration}', [PpdbRegistrationController::class, 'update'])->name('registration.update');
        Route::post('/registration/{registration}/status', [PpdbRegistrationController::class, 'updateStatus'])->name('registration.update-status');
        
        Route::get('/ppdb/registration/{id}/download/{documentType}', [PpdbRegistrationController::class, 'downloadDocument'])->name('ppdb.registration.download');
        // DELETE Route
        Route::delete('/registration/{registration}', [PpdbRegistrationController::class, 'destroy'])->name('registration.destroy');
    });


    // News Management Routes - DIPINDAHKAN KE DALAM GROUP YANG BENAR
    Route::prefix('news')->name('news.')->group(function () {
        // Categories Routes
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        
        // Posts Routes
        Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
        Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });

    // Breeze Profile Routes (untuk edit profile user)
    Route::get('/akun', [UserProfileController::class, 'edit'])->name('account.edit');
    Route::patch('/akun', [UserProfileController::class, 'update'])->name('account.update');
    Route::delete('/akun', [UserProfileController::class, 'destroy'])->name('account.destroy');

    // ── Kelola Pengguna — hanya kepala sekolah ────────────────────────────
    Route::middleware('role:kepala_sekolah')
        ->prefix('pengguna')->name('users.')
        ->group(function () {
            Route::get('/',          [UserController::class, 'index'])->name('index');
            Route::get('/tambah',    [UserController::class, 'create'])->name('create');
            Route::post('/',         [UserController::class, 'store'])->name('store');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
            Route::patch('/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('toggle-active');
        });

    // ── Galeri Alumni (wisuda/angkatan) ────────────────────────────────
    Route::prefix('galeri-alumni')->name('galeri.')->group(function () {
        Route::get('/', [GalleryController::class, 'index'])->name('index');
        Route::get('/create', [GalleryController::class, 'create'])->name('create');
        Route::post('/', [GalleryController::class, 'store'])->name('store');
        Route::get('/{galeri}/edit', [GalleryController::class, 'edit'])->name('edit');
        Route::put('/{galeri}', [GalleryController::class, 'update'])->name('update');
        Route::delete('/{galeri}', [GalleryController::class, 'destroy'])->name('destroy');
        Route::delete('/foto/{foto}', [GalleryController::class, 'destroyFoto'])->name('foto.destroy');
    });

    // ── Galeri Kegiatan Harian ─────────────────────────────────────────
    Route::prefix('galeri-kegiatan')->name('galeri-kegiatan.')->group(function () {
        Route::get('/', [GaleriKegiatanController::class, 'index'])->name('index');
        Route::get('/create', [GaleriKegiatanController::class, 'create'])->name('create');
        Route::post('/', [GaleriKegiatanController::class, 'store'])->name('store');
        Route::get('/{galeriKegiatan}/edit', [GaleriKegiatanController::class, 'edit'])->name('edit');
        Route::put('/{galeriKegiatan}', [GaleriKegiatanController::class, 'update'])->name('update');
        Route::delete('/{galeriKegiatan}', [GaleriKegiatanController::class, 'destroy'])->name('destroy');
        Route::delete('/foto/{foto}', [GaleriKegiatanController::class, 'destroyFoto'])->name('foto.destroy');
    });

    // ── Sambutan Kepala Sekolah ────────────────────────────────────────
    Route::prefix('sambutan-kepsek')->name('sambutan.')->group(function () {
        Route::get('/', [SambutanKepsekController::class, 'index'])->name('index');
        Route::get('/create', [SambutanKepsekController::class, 'create'])->name('create');
        Route::post('/', [SambutanKepsekController::class, 'store'])->name('store');
        Route::get('/{sambutan}/edit', [SambutanKepsekController::class, 'edit'])->name('edit');
        Route::put('/{sambutan}', [SambutanKepsekController::class, 'update'])->name('update');
        Route::delete('/{sambutan}', [SambutanKepsekController::class, 'destroy'])->name('destroy');
    });
});

// Breeze Authentication Routes
require __DIR__.'/auth.php';