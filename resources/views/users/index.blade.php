@extends('layouts.master-layouts2')


@section('title')
    สัญญาเช่า
@endsection

@section('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap');

        h1,
        h2,
        h3,
        .b {
            -webkit-text-stroke-width: 0.1px;
            -webkit-text-stroke-color: rgb(93, 93, 93);
            font-family: 'Kanit', sans-serif;
        }

        #doc-image {
            height: auto;
        }

        @media only screen and (max-width: 300px) {
            #doc-image {
                zoom: .3;
            }
        }

        @media only screen and (max-width: 600px) {
            #doc-image {
                zoom: .4;
            }
        }

        @media only screen and (max-width: 800px) {
            #doc-image {
                zoom: .5;
            }
        }

        @media only screen and (min-width: 1000px) {
            #doc-image {
                zoom: .7;
            }
        }

        @media only screen and (min-width: 1500px) {
            #doc-image {
                zoom: .9;
            }
        }
    </style>
@endsection
@section('content')
    <div class="doc-image">
        <div class="container-fluid">
            <div class="row mt-5">
                <h1 class="text-center mb-5"><b>สัญญาเช่าหอพัก</b></h1>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="button" onclick="sendData(1)">
                        <b class="font-size-24">ฟาริดา อพาร์ทเม้นท์</b>
                    </button>

                    <button class="btn btn-success mt-3" type="button" onclick="sendData(2)">
                        <b class="font-size-24">หอพักวันเทาแก้ว</b>
                    </button>
                </div>
                <div class="container-fluid mt-5">
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4 text-center">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Apartment.
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function sendData(id) {
            fetch('/list-condition', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content') // ส่ง CSRF Token
                    },
                    body: JSON.stringify({
                        id: id
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    console.log(data); // ทดสอบข้อมูลที่ได้กลับมา
                    window.location.href = '/list-condition-page'; // รีไดเรกต์ไปยังหน้าที่ต้องการ
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
