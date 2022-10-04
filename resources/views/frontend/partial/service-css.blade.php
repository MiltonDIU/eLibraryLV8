@push('style')
    <style>
        .service_box {
            margin: 10px 0;
            padding: 50px 10px;
            text-align: center;
            border-radius: 5px;
            background: rgba(59, 63, 66, 0.7);
            transition: all 0.30s ease 0s;
            height: 200px;
            width:200px;
            border-radius: 50% !important;
        }

        .service_box:hover {
            background: #00BFF3;
        }

        .service_box .service_icon {
            width: 90px;
            height: 90px;
            margin: 0 auto;
            font-size: 35px;
            line-height: 70px;
            border-radius: 50px;
            transform: translateY(0);
            transition: all 0.30s ease 0s;
        }

        .service_box:hover .service_icon {
            transform: translateY(-50%);
        }

        .service_box .service_icon i {
            color: #333;
        }

        .service_box h3 {
            position: relative;
            top: 0px;
            margin: 0;
            color: #fff;
            font-size: 14px;
            text-transform: uppercase;
            transform: translateY(0%);
            transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55) 0s;
        }

        .service_box:hover h3 {
            top: -20px;
        }
        .service_box p {
            color: #fff;
            margin: 0;
            opacity: 0;
            transition: all 0.30s linear 0s;
        }
        .service_box:hover p {
            opacity: 1;
        }
    </style>
@endpush