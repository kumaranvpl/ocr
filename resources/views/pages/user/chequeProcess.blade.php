<!DOCTYPE html>
<html>

@include('header', array('title' => 'Processing Cheque',))

<body class="fixed-left">

@include('pages.user.userTopBar');

@include('pages.user.userSideBar');

<div class="content-page">
    <!-- ============================================================== -->
    <!-- Start Content here -->
    <!-- ============================================================== -->
    <!-- Trigger the modal with a button -->
    <!-- Modal -->


    <div class="content">
        <!-- Page Heading Start -->
        <div class="page-heading">
            <h1><i class='fa fa-cloud-upload'></i> Processing cheque image </h1>
        </div>
        <div class="row">
            <div class="col-sm-12 portlets">
                <div class="widget">
                    <div class="widget-header transparent">
                        <h2><strong>Select cheque area</strong></h2>
                    </div>
                    <div class="widget-content padding">
                        @if( ! empty($json_res->out))
                            <div class="gallery-wrap">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="inner">
                                        <div class="img-wrap">
                                            <img id="image" src="{{ $json_res->out }}" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-3">
                                    <button onclick="getdatafunc()" id="btnSubmit" type="button" class="btn btn-info" data-method="getCropBoxData" data-option="" >
                                        Get Crop Box Data
                                    </button>
                            </div>

                        @else
                            Error
                            <!--<img id="image" src="http://3.bp.blogspot.com/--Hys3NEOL1s/UKwRTpy1XeI/AAAAAAAAD7I/2IDx2Xqhbps/s1600/can_cts+copy.jpg">
                            <br>
                            <button onclick="getdatafunc()" id="btnSubmit" type="button" class="btn btn-info" data-method="getCropBoxData" data-option="" data-target="#putData">
                                Get Crop Box Data
                            </button>-->
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="md-overlay"></div>
@include('footer');
<link  href="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.0/cropper.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.0/cropper.js"></script>
<script>

    $('#image').cropper({

        crop: function(e) {
            // Output the result data for cropping image.
            /*console.log(e.x);
            console.log(e.y);
            console.log(e.width);
            console.log(e.height);
            console.log(e.rotate);
            console.log(e.scaleX);
            console.log(e.scaleY);*/
        }
    });

    function getdatafunc()
    {
        var $image = $('#image');
        var data = $image.cropper('getCropBoxData');
        data.img_data = img_data;
        //console.log(JSON.stringify(data));
        $.redirect("/user/uploads/cheque/cropped", { response: JSON.stringify(data)});
    }


</script>
</body>
</html>