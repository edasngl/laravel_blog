<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;

class BlogController extends Controller
{
    public function create(Request $request)
    {
        // Gelen isteği kontrol et
        $token = $request->bearerToken();

        // Eğer token yoksa veya geçersizse hata döndür
        if (!$token || !auth()->user()) {
            return response()->json([
                'status' => 'error'
            ]);
        }
        #kullanıcı kontrolü yapıyoruz

        $userControl = User::where('email', $request->email)->first();
        if ($userControl && \Hash::check($request->password, $userControl->password)) {
            #form verilerini bir arraye alıyoruz
            $BlogData = [
                "title" => $request->title,
                "contents" => $request->content,
                "user_id" => $userControl->id
            ];
            #eğer oluşturulamazsa ekrana response döndürüyoruz
            if (!Blog::create($BlogData)) {
                return response()->json([
                    "status" => "error",
                    "message" => "Blog yazınız kaydedilirken bir hata meydana geldi"
                ]);
            }
            #kullanıcı varsa
            return response()->json([
                "status" => "success",
                "message" => "Kayıt başarılı!"
            ]);
        }
        #kullanıcı bulunamadıysa
        return response()->json([
            "status" => "error",
            "message" => "Kullanıcı bilgilerinizi kontrol ediniz"
        ]);
    }
    public function index(Request $request)
    {

        // Gelen isteği kontrol et
        $token = $request->bearerToken();

        // Eğer token yoksa veya geçersizse hata döndür
        if (!$token || !auth()->user()) {
            return response()->json(
                [
                    'status' => 'error'
                ]
            );
        }
        #önce kullanıcıyı kontrol ediyoruz
        $controlUser = User::where('email', $request->email)->first();
        #eğer böyle bir kullanıcı varsa ve bilgiler doğruysa
        if ($controlUser && \Hash::check($request->password, $controlUser->password)) {
            #bu kullanıcıya ait blog verilerini listele
            $BlogData = Blog::where('user_id', $controlUser->id)->get();
            #eğer yoksa ekrana çıktı ver

            if (!$BlogData) {

                return response()->json([
                    "status" => "error",
                    "message" => "Girdiğiniz kullanıcı bilgilerine ait bir veri bulunamadı"
                ]);
            }
            #eğer varsa modelden tüm verileri çekiyoruz
            return response()->json([
                "status" => "success",
                "data" => $BlogData
            ]);
        }
        #kullanıcı bilgileri hatalıysa
        return response()->json([
            "status" => "error",
            "message" => "Kullanıcı bilgilerinizi kontrol ediniz"
        ]);
    }

    public function update(Request $request)
    {
        // Gelen isteği kontrol et
        $token = $request->bearerToken();

        // Eğer token yoksa veya geçersizse hata döndür
        if (!$token || !auth()->user()) {
            return response()->json(
                [
                    'status' => 'error'
                ]
            );
        }
        #önce kullanıcıyı kontrol ediyoruz
        $controlUser = User::where('email', $request->email)->first();
        #eğer böyle bir kullanıcı varsa ve bilgiler doğruysa
        if ($controlUser && \Hash::check($request->password, $controlUser->password)) {
            $blog = Blog::where('id', $request->content_id)->where('user_id', $controlUser->id)->first(); //güncellenecek yazı
            if ($blog) {
                #yazıyı güncelle
                $blog->update(['title' => $request->title, 'content' => $request->content]);
                return response()->json([
                    "status" => "success",
                    "message" => "Güncelleme başarılı!",
                    "newData" => $blog
                ]);
            }
            #kayıt bulunamadıysa
            return response()->json([
                "status" => "error",
                "message" => "ID'ye ait kayıt bulunamadı ya da kullanıcıya ait değil"
            ]);
        }
        #bilgiler yanlışsa
        return response()->json([
            "status" => "error",
            "message" => "Kullanıcı bilgilerinizi kontrol ediniz"
        ]);
    }

    public function delete(Request $request)
    {
        // Gelen isteği kontrol et
        $token = $request->bearerToken();

        // Eğer token yoksa veya geçersizse hata döndür
        if (!$token || !auth()->user()) {
            return response()->json(
                [
                    'status' => 'error'
                ]
            );
        }
        #önce kullanıcıyı kontrol ediyoruz
        $controlUser = User::where('email', $request->email)->first();
        #eğer böyle bir kullanıcı varsa ve bilgiler doğruysa
        if ($controlUser && \Hash::check($request->password, $controlUser->password)) {
            $blog = Blog::where('id', $request->content_id)->where('user_id', $controlUser->id)->first(); // silinecek kaydı bul
            if ($blog) {
                $blog->delete(); // kaydı sil
                return response()->json([
                    "status" => "success",
                    "message" => "Kayıt silinmiştir"
                ]);
            }
            return response()->json([
                "status" => "error",
                "message" => "ID'ye ait kayıt bulunamadı ya da kullanıcıya ait değil"
            ]);
        }
        return response()->json([
            "status" => "error",
            "message" => "Kullanıcı bilgilerinizi kontrol ediniz"
        ]);
    }
}
