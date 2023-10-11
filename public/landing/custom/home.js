function base_url(string_url) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/' + string_url; // http://localhost/myproject/
    } else {
        var url = location.origin + '/' + string_url; // http://stackoverflow.com
    }
    return url;
}

// var itemsPerPage = 2; // Jumlah item per halaman
// var currentPage = 1; // Halaman saat ini

// function showData(data) {
//     var startIndex = (currentPage - 1) * itemsPerPage;
//     var endIndex = startIndex + itemsPerPage;
//     var dataContainer = document.querySelector('.data-container');
//     var paginationContainer = document.querySelector('.pagination ul');
//     var totalPages = Math.ceil(data.length / itemsPerPage);

//     dataContainer.innerHTML = ''; // Mengosongkan kontainer data

//     for (var i = startIndex; i < endIndex && i < data.length; i++) {
//         var item = data[i];
//         var article = document.createElement('article');
//         article.innerHTML = `
//                         <div class="col-md-6 col-sm-12 " id="">
//                             <div class="card">
//                                 <div class="card-body">
//                                     <article class="mu-blog-single-item">
//                                         <figure class="mu-blog-single-img">
//                                             <a href="#"><img src="${base_url()}public/upload/berita/${item.file_img}" alt="img"></a>
//                                             <figcaption class="mu-blog-caption">
//                                                 <h3><a href="#">Lorem ipsum dolor sit amet.</a></h3>
//                                             </figcaption>
//                                         </figure>
//                                         <div class="mu-blog-meta">
//                                             <a href="#">By Admin</a>
//                                             <a href="#">02 June 2016</a>
//                                             <span><i class="fa fa-comments-o"></i>87</span>
//                                         </div>
//                                         <div class="mu-blog-description">
//                                             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
//                                                 Beatae
//                                                 ipsum non voluptatum eum repellendus quod aliquid. Vitae,
//                                                 dolorum
//                                                 voluptate quis repudiandae eos molestiae dolores enim.</p>
//                                             <a class="mu-read-more-btn" href="#">Read More</a>
//                                         </div>
//                                     </article>
//                                 </div>
//                             </div>
//                     </div>
//                 `;
//         dataContainer.appendChild(article);
//     }

//     paginationContainer.innerHTML = ''; // Mengosongkan kontainer paginasi

//     for (var page = 1; page <= totalPages; page++) {
//         var li = document.createElement('li');
//         var a = document.createElement('a');
//         a.href = '#';
//         a.innerText = page;
//         a.addEventListener('click', function () {
//             currentPage = parseInt(this.innerText);
//             showData(data);
//         });
//         li.appendChild(a);
//         if (page === currentPage) {
//             li.classList.add('active');
//         }
//         paginationContainer.appendChild(li);
//     }
// }

var app = angular.module('HomeAppProfile', []);

app.controller('HomeAppProfileController', function ($scope, $http) {
    $scope.LoadHomeProfileBerita = function () {
        // Ganti URL dengan URL yang sesuai
        $http.get(base_url('home/getdata_berita'))
            .then(function (response) {
                // Menampilkan data halaman pertama saat data diterima
                $scope.LoadData = response.data;
                $scope.currentPage = 1;
                $scope.itemsPerPage = 2; // Ubah sesuai dengan jumlah item yang ingin ditampilkan per halaman
                $scope.totalItems = $scope.LoadData.length;

                $scope.setPage = function (page) {
                    if (page < 1 || page > $scope.pageCount()) return;
                    $scope.currentPage = page;
                };

                $scope.prevPage = function () {
                    $scope.setPage($scope.currentPage - 1);
                };

                $scope.nextPage = function () {
                    $scope.setPage($scope.currentPage + 1);
                };

                $scope.pageCount = function () {
                    return Math.ceil($scope.totalItems / $scope.itemsPerPage);
                };

                $scope.pages = [];
                for (var i = 1; i <= $scope.pageCount(); i++) {
                    $scope.pages.push(i);
                }
            })
            .catch(function (error) {
                console.error('Terjadi kesalahan:', error);
            });
    };
    $scope.LoadHomeProfileBerita();
});
app.filter('startFrom', function () {
    return function (input, start) {
        start = +start;
        return input.slice(start);
    };
});
