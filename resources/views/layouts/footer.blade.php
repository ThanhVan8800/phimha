
<!-- /.login-box -->

<!-- jQuery -->
    <script src="/templates/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/templates/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/templates/admin/dist/js/adminlte.min.js"></script>
    <script src="/templates/admin/js/main.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <!-- <script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="/templates/admin/datatables/js/jquery.dataTables.min.js"></script> -->
    <script type="text/javascript">
        $(document).ready( function () {
        $('#myTable').DataTable();
    } );
    </script>
    
    @yield('footer')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
    </script>
    
    
    <script type="text/javascript">
        $('.select-year').change(function() {
            var year = $(this).find(':selected').val();
            var id_phim = $(this).attr('id');
            // alert(year + ' - ' + id_phim);
            // alert(id_phim);
            $.ajax({
                url: "{{route('update-year')}}",
                method: 'GET',
                data: {year:year, id_phim:id_phim},
                success: function(){
                    alert('Thay đổi năm phim theo năm ' + year + ' thành công');
                }
            })
        })
    </script>
    <!-- Upload ảnh  -->
    <script>
        /*Upload File */
        $('#upload').change(function() {
            const form = new FormData();
            form.append('file', $(this)[0].files[0]);

            $.ajax({
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: 'JSON',
                data: form,
                url: '/admin/upload/services',
                success: function(results) {
                    if (results.error === false) {
                        $('#image_show').html('<a href="' + results.url + '" target="_blank">' +
                            '<img src="' + results.url + '" width="100px"></a>');

                        $('#thumb').val(results.url);
                    } else {
                        alert('Upload File Lỗi');
                    }
                }
            });
        });
    </script>
    
    <!-- Tìm kiếm Ajax -->
    <script>
                $(document).ready(function(){
                    $(document).on( 'keyup','#keyword' ,function(){
                        var keyword = $(this).val();
                        $.ajax({
                            type: "GET",
                            url:'/search_ad',
                            data:{keyword:keyword},
                            dataType: "json",
                            success: function(response) {
                                    $('#lst').html(response );
                            }
                        })
                    })
                })
    </script>
    <!-- <script>
                $(document).ready(function(){
                    $(document).on( 'keyup','#keyword' ,function(){
                        var keyword = $(this).val();
                        $.ajax({
                            type: "GET",
                            url:'/search_episode',
                            data:{keyword:keyword},
                            dataType: "json",
                            success: function(response) {
                                    $('#lstt').html(response );
                            }
                        })
                    })
                })
    </script> -->
    <script type="text/javascript">
        $('.select-session').change(function() {
            var session = $(this).find(':selected').val();
            var id_session = $(this).attr('id');
            $.ajax({
                url: "{{route('update-session')}}",
                method: 'GET',
                data: {session:session, id_session:id_session},
                success: function(){
                    alert('Thay đổi mùa phim ' + session + ' thành công');
                }
            })
        })
    </script>
    
        
        <script type="text/javascript">
            function ChangeToSlug()
                {
                    var slug;
                    //Lấy text từ thẻ input title 
                    slug = document.getElementById("slug").value;
                    slug = slug.toLowerCase();
                    //Đổi ký tự có dấu thành không dấu
                        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                        slug = slug.replace(/đ/gi, 'd');
                        //Xóa các ký tự đặt biệt
                        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                        //Đổi khoảng trắng thành ký tự gạch ngang
                        slug = slug.replace(/ /gi, "-");
                        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                        slug = slug.replace(/\-\-\-\-\-/gi, '-');
                        slug = slug.replace(/\-\-\-\-/gi, '-');
                        slug = slug.replace(/\-\-\-/gi, '-');
                        slug = slug.replace(/\-\-/gi, '-');
                        //Xóa các ký tự gạch ngang ở đầu và cuối
                        slug = '@' + slug + '@';
                        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                        //In slug ra textbox có id “slug”
                    document.getElementById('convert_slug').value = slug;
                }
        </script>
    <script type="text/javascript">
            $('.order_position').sortable({
                    placeholder:'ui-state-highlight',
                    update: function(event, ui) {
                        var array_id = [];
                        $('.order_position tr').each(function(){
                            array_id.push($(this).attr('id'));
                        })
                        // alert(array_id);
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name ="csrf-token"]').attr('content'),
                            },
                            url:"{{route('resorting')}}",
                            method: "POST",
                            data:{array_id: array_id},
                            success: function(data) {
                                alert('Sắp xếp thứ tự thành công');
                            }
                        })
                    }
            })
    </script>