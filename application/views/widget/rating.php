<div class="panel panel-default" style="width:100%;">
    <div class="panel-heading" style="border-radius:5px;background-color: #45678d;height:50px;margin-bottom:5px">
        <center>
            <label style="color: #fff;margin-top:10px">Indeks Kepuasan Masyarakat</label>
        </center>
    </div>
    <div class="panel-body" style="background-color:#fff;border: 2px solid #D2D6DE;">
        <div id="result_komentar">
            <center>
                <div class="alert alert-success mb-4 text-success-utama" style="display:none" id="alert_success" role="alert">Data berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button></div>
            </center>
        </div>
        <div class="container proj-progress-card">
            <div class="row">
                <div class="col">
                    <div class="text-center">
                        <div class="donut-chart-block block">
                            <div class="donut-chart">
                                <div id="part1" class="portion-block">
                                    <div class="circle"></div>
                                </div>
                                <div id="part2" class="portion-block">
                                    <div class="circle"></div>
                                </div>
                                <div id="part3" class="portion-block">
                                    <div class="circle"></div>
                                </div>
                                <div class="mt-3">
                                    <p class="center">
                                        <b><span id="average_rating" style="font-size: 30pt; "></span></b>/5
                                        <br>
                                        <span style="font-size:10pt; ">Total Review (<span id="total_review">0</span>)</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <!-- <i class="fa fa-star star-light mr-1 main_star"></i>
                            <i class="fa fa-star star-light mr-1 main_star"></i>
                            <i class="fa fa-star star-light mr-1 main_star"></i>
                            <i class="fa fa-star star-light mr-1 main_star"></i>
                            <i class="fa fa-star star-light mr-1 main_star"></i> -->
                            <div class="rating text-warning">
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-2 mb-4 prog-bar" style="padding: 0 40px;">
                        <p>
                        <div class="progress-label-left"><b>5</b> <i class=" fa fa-star text-warning"></i></div>
                        <div class="progress-label-right"><span id="total_five_star_review">0</span></div>
                        <div class="progress">
                            <div class="progress-bar bg-c-green" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>4</b> <i class="fa fa-star text-warning"></i></div>

                        <div class="progress-label-right"><span id="total_four_star_review">0</span></div>
                        <div class="progress">
                            <div class="progress-bar bg-c-yellow" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>3</b> <i class="fa fa-star text-warning"></i></div>

                        <div class="progress-label-right"><span id="total_three_star_review">0</span></div>
                        <div class="progress">
                            <div class="progress-bar bg-c-yellow-dark" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>2</b> <i class="fa fa-star text-warning"></i></div>

                        <div class="progress-label-right"><span id="total_two_star_review">0</span></div>
                        <div class="progress">
                            <div class="progress-bar bg-c-orange" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>1</b> <i class="fa fa-star text-warning"></i></div>

                        <div class="progress-label-right"><span id="total_one_star_review">0</span></div>
                        <div class="progress">
                            <div class="progress-bar bg-c-red" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                        </div>
                        </p>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="text-right">
                        <h6 class="mt-5 mb-3 judul">Indeks Kepuasan Masyarakat</h6>
                        <div class="ml-3">Terima kasih telah mengirim indeks kepuasan masyarakat.</div>
                        <button type="button" class="btn mt-2 button1" data-toggle="modal" data-target="#exampleModal">
                            Review
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Indeks Kepuasan Masyarakat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="result_komentar">
                            <center>
                                <div class="alert alert-danger mb-4" style="display:none" id="alert-danger" role="alert"><span class="text-error" id="text-error"></span><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button></div>
                                <div class="alert alert-success mb-4" style="display:none" id="alert-success" role="alert"><span class="text-success" id="text-success"></span><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button></div>
                            </center>
                        </div>
                        <label for="">Rating</label>
                        <h4 class="text-center mt-2 mb-4">
                            <i class="fa fa-star star-light submit_star bintang-1 mr-1" id="submit_star_1" data-rating="1"></i>
                            <i class="fa fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                            <i class="fa fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                            <i class="fa fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                            <i class="fa fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                        </h4>
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="user_name" id="user_name" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="">Saran / Komentar</label>
                            <textarea name="user_review" id="user_review" class="form-control" required></textarea>
                        </div>
                        <input id="tanggal" name="tanggal" type="hidden" value="<?= date('d/m/Y') ?>">
                        <div class="form-group text-center mt-4">
                            <button type="button" class="btn button1" id="save_review">Submit</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div id="modal-ikm" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notifikasi Indeks Kepuasan Masyarakat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-ikm"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="javascript:window.location.reload()">Baik</button>
            </div>
        </div>
    </div>
</div>
<style>
    .donut-chart {
        position: relative;
        width: 200px;
        height: 200px;
        margin: 0 auto 1rem;
        border-radius: 100%
    }

    p.center {
        background: #ffff;
        position: absolute;
        text-align: center;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 130px;
        height: 130px;
        margin: auto;
        border-radius: 50%;
        line-height: 35px;
        padding: 15% 0 0;
    }


    .portion-block {
        border-radius: 50%;
        clip: rect(0px, 200px, 200px, 100px);
        height: 100%;
        position: absolute;
        width: 100%;
    }

    .circle {
        border-radius: 50%;
        clip: rect(0px, 100px, 200px, 0px);
        height: 100%;
        position: absolute;
        width: 100%;
        font-size: 1.5rem;
    }


    #part1 {
        transform: rotate(0deg);
    }

    #part1 .circle {
        background-color: #ade8f4;
        animation: first 1s 1 forwards;
    }


    #part2 {
        transform: rotate(100deg);
    }

    #part2 .circle {
        background-color: #90e0ef;
        animation: second 1s 1 forwards 1s;
    }

    #part3 {
        transform: rotate(250deg);
    }

    #part3 .circle {
        background-color: #48cae4;
        animation: third 0.5s 1 forwards 2s;
    }


    /* Animation */
    @keyframes first {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(100deg);
        }
    }

    @keyframes second {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(150deg);
        }
    }

    @keyframes third {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(111deg);
        }
    }


    .prog-bar {
        font-size: 12px;
    }

    .angka_rate {
        font-weight: bold;
        font-size: 35pt;
    }


    .progress .progress-bar {
        border-radius: 10px;
    }

    .progress {
        height: 10px;
    }


    .bg-c-green {
        background: #a1ff0a
    }

    .bg-c-yellow {
        background: #deff0a
    }

    .bg-c-yellow-dark {
        background: #ffd300
    }

    .bg-c-orange {
        background: #ff8700
    }

    .bg-c-red {
        background: #ff0000
    }

    .progress-label-left {
        float: left;
        margin-right: 0.5em;
        line-height: 0.8em;
    }

    .progress-label-right {
        float: right;
        margin-left: 0.5em;
        line-height: 0.8em;
    }

    .star-light {
        color: #e9ecef;
    }

    .judul {
        color: #45678d;
        font-weight: bold;
        font-size: 16pt;
    }

    .button1 {
        border-radius: 16px;
        background-color: #5DC6E9;
        color: white;
    }

    .button1:hover {
        background-color: #1DA9D7;
        color: white;
    }
</style>
<script>
    $(document).ready(function() {
        var rating_data = 0;
        $(document).on('mouseenter', '.submit_star', function() {
            var rating = $(this).data('rating');
            reset_background();
            for (var count = 1; count <= rating; count++) {
                $('#submit_star_' + count).addClass('text-warning');
            }
        });

        function reset_background() {
            for (var count = 1; count <= 5; count++) {
                $('#submit_star_' + count).addClass('star-light');
                $('#submit_star_' + count).removeClass('text-warning');
            }
        }

        $(document).on('mouseleave', '.submit_star', function() {
            reset_background();
            for (var count = 1; count <= rating_data; count++) {
                $('#submit_star_' + count).removeClass('star-light');
                $('#submit_star_' + count).addClass('text-warning');
            }
        });

        $(document).on('click', '.submit_star', function() {
            rating_data = $(this).data('rating');
        });

        $('#save_review').click(function() {
            var user_name = $('#user_name').val();
            var user_review = $('#user_review').val();
            var tanggal = $('#tanggal').val();
            var email = $('#email').val();

            if (rating_data == '0') {
                $('#text-error').text('Rating harus diisi!');
                $('#alert-danger').show();
            } else if (user_name == '') {
                $('#text-error').text('Nama harus diisi!');
                $('#alert-danger').show();
            } else if (email == '') {
                $('#text-error').text('Email harus diisi!');
                $('#alert-danger').show();
            } else if ((email.indexOf('@', 0) == -1) || (email.indexOf('.', 0) == -1)) {
                $('#text-error').text('Format email salah!');
                $('#alert-danger').show();
            } else {
                console.log("<?php echo base_url(); ?>home/post_rating?rating_data="+rating_data+"&user_name="+user_name+"&user_review="+user_review+"&email="+email+"&tanggal="+tanggal+"")
                $.ajax({
                    url: "<?php echo base_url(); ?>home/post_rating",
                    method: "POST",
                    data: {
                        rating_data: rating_data,
                        user_name: user_name,
                        user_review: user_review,
                        email: email,
                        tanggal: tanggal,
                    },
                    success: function(data) {
                        $('#exampleModal').modal('hide');
                        $('#modal-ikm').modal('show');
                        $('.text-ikm').text('Terima kasih, review Anda telah berhasil disimpan.');
                        // $(document).ajaxStop(function() {
                        //     window.location.reload();
                        // });
                        // $('.text-success-utama').show();
                    },
                    error: function(data) {
                        $('#exampleModal').modal('hide');
                        $('#modal-ikm').modal('show');
                        $('.text-ikm').text('Review Anda gagal disimpan.');
                    }
                })
            }
        });
        load_rating_data();

        function load_rating_data() {
            $.ajax({
                url: "<?php echo base_url(); ?>home/post_rating",
                type:'POST',
                dataType:'json',
                data: {
                    action: "load_data"
                },
                success: function(data) {
                    $('#average_rating').text(data.average_rating);
                    $('#total_review').text(data.total_review);

                    // var count_star = 0;
                    // var ratingValue = data.average_rating;
                    //alert(ratingValue);

                    var ratingValue = data.average_rating,
                        rounded = (ratingValue | 0),
                        str;

                    for (var j = 0; j < 5; j++) {
                        str = '<i class="fa ';
                        if (j < rounded) {
                            str += "fa-star fa-lg";
                        } else if ((ratingValue - j) > 0 && (ratingValue - j) < 1) {
                            str += "fa-star-half-o fa-lg";
                        } else {
                            str += "fa-star-o fa-lg";
                        }
                        str += '" aria-hidden="true"></i>';
                        $(".rating").append(str);
                    }

                    // $('.main_star').each(function() {
                    //     count_star++;
                    //     if (Math.floor(data.average_rating) >= count_star) {
                    //         $(this).addClass('text-warning');
                    //         $(this).addClass('star-light');
                    //     }
                    // });

                    $('#total_five_star_review').text(data.five_star_review);

                    $('#total_four_star_review').text(data.four_star_review);

                    $('#total_three_star_review').text(data.three_star_review);

                    $('#total_two_star_review').text(data.two_star_review);

                    $('#total_one_star_review').text(data.one_star_review);

                    $('#five_star_progress').css('width', (data.five_star_review / data.total_review) * 100 + '%');

                    $('#four_star_progress').css('width', (data.four_star_review / data.total_review) * 100 + '%');

                    $('#three_star_progress').css('width', (data.three_star_review / data.total_review) * 100 + '%');

                    $('#two_star_progress').css('width', (data.two_star_review / data.total_review) * 100 + '%');

                    $('#one_star_progress').css('width', (data.one_star_review / data.total_review) * 100 + '%');

                },
                error: function(data) {
                    alert('error');
                }
            })
        }
    });
</script>