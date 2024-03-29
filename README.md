<h1>Hello Everyone!</h1><br>
<p>In this project, users will create their own accounts, log in, and create their own blog posts after verification with the token given through Sanctum.
I wrote the services that they can list, edit and delete.
Postman document link is attached.</p>
<a href="https://documenter.getpostman.com/view/33934273/2sA35G3gzF" target="_blank">Click here for the link</a>

<h1>How to use the project?</h1>
<p>
MySql was used in the project, database information is contained in the .env file. After running the database migration commands with the "php artisan migrate" command, the tables will be created.
After the tables are created, run the project with the "php artisan serve" command and go to Postman.
Then create your account with the Register service, a new User model will be created in the background and a token will be returned as a response.
You need to buy the token and paste the token into the box that appears by selecting the "bearer token" option from the "authorization" section in other services, otherwise the services will not work correctly.
You can log in from the login service, create a new record from the create service, update your record according to its ID number from the update service, and delete your record according to its ID number from the delete service.   
</p>
<h1>Herkese Merhaba!</h1>
<p>
Bu projede kullanıcıların kendilerine hesap oluşturup, giriş yaptıktan sonra Sanctum aracılığıyla verilen tokenle doğrulama işlemi gerçekleştikten sonra kendi blog yazılarını oluşturacakları,
listeleyebilecekleri, düzenleyebileceği ve silebileceği servisleri yazdım.
Postman döküman linki ektedir.
</p>
<a href="https://documenter.getpostman.com/view/33934273/2sA35G3gzF" target="_blank">Link için buraya tıklayın</a>
<p>Proje nasıl kullanılır? <br>
Projede MySql kullanılmıştır, .env dosyasında veritabanı bilgileri yer almaktadır. Database migration komutlarını "php artisan migrate" komutuyla çalıştırdıktan sonra tablolar oluşacaktır. 
Tablolar oluştuktan sonra "php artisan serve" komutuyla projeyi çalıştırın ve Postman'e gidin.
Daha sonra Register servisiyle hesabınızı oluşturun, arkaplanda yeni bir User modeli oluşacaktır ve response olarak bir token döndürülecektir.
Tokeni alıp diğer servislerde "authorization" bölümünden "bearer token" seçeneğini seçerek çıkan kutucuğa tokeni yapıştırmanız gereklidir, aksi takdirde servisler doğru çalışmayacaktır. 
Login servisinden giriş sağlayabilir, create servisinden yeni kayıt oluşturabilir, update servisinden kaydınızın ID numarasına göre güncelleme sağlayabilir ve delete servisinden kaydınızın ID numarasına göre silme işlemlerini gerçekleştirebilirsiniz.
</p>
