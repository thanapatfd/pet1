@extends('layouts.master')
@section('title') ระบบสัตว์เลี้ยง @stop
@section('content')
    <div class="container" ng-app="app" ng-controller="ctrl">


        <div class="row">
            <div class="col-md-3">
                <h1 style="margin: 0 0 30px 0">สัตว์เลี้ยงในร้าน</h1>
            </div>
            <div class="col-md-9">
                <div class="pull-right" style="margin-top:10px">
                    <input type="text" class="form-control" ng-model="query" ng-keyup="searchPet($event)"
                        style="width:190px" placeholder="พิมพ์ชื่อสัตว์เลี้ยงเพื่อค้นหา">
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <a href="#" class="list-group-item" ng-class="{'active': type == null}"
                    ng-click="getPetList(null)">ทั้งหมด</a>
                <a href="#" class="list-group-item" ng-repeat="c in types" ng-click="getPetList(c)"
                    ng-class="{'active': type.id == c.id}">@{c.name}</a>
            </div>

            <div class="col-md-9">
                <div class="row">

                    <h3 ng-if="!pets.length">ไม่พบข้อมูลสัตว์เลี้ยง </h3>

                    <div class="col-md-3" ng-repeat="p in pets">
                        <!-- product card -->
                        <div class="panel panel-default bs-product-card">
                            <div class="panel-body">

                                <div class="panel panel-default">
                                    <img ng-src="@{p.image_url}" class="img-responsive">
                                </div>

                                <h4><a href="#">@{ p.name }</a></h4>

                                <div class="form-group">
                                    <div>คงเหลือ: @{p.stock_qty}</div>
                                    <div>ราคา <strong>@{p.price}</strong> บาท</div>
                                </div> @guest

                                    <a href="#" class="btn btn-success btn-block">
                                    @else
                                        <a href="#" class="btn btn-success btn-block" ng-click="addToCart(p)">
                                        @endguest
                                        <i class="fa fa-shopping-cart"></i> หยิบใส่ตะกร้า</a>

                            </div>
                        </div>

                        <!-- end product card -->
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script type="text/javascript">
        var app = angular.module('app', []).config(function($interpolateProvider) {
            $interpolateProvider.startSymbol('@{').endSymbol('}');
        });
        app.controller('ctrl', function($scope, petService) {

            $scope.pets = [];
            $scope.getPetList = function(type) {

                $scope.type = type;
                type_id = type != null ? type.id : '';

                petService.getPetList(type_id).then(function(res) {
                    if (!res.data.ok) return;
                    $scope.pets = res.data.pets;
                });
            };
            $scope.getPetList(null);


            $scope.types = [];
            $scope.getTypeList = function() {
                petService.getTypeList().then(function(res) {
                    if (!res.data.ok) return;
                    $scope.types = res.data.types;
                });
            };
            $scope.getTypeList();

            $scope.searchPet = function(e) {
                petService.searchPet($scope.query).then(function(res) {
                    if (!res.data.ok) return;
                    $scope.pets = res.data.pets;
                });
            };

            $scope.addToCart = function(p) {
                window.location.href = '/cart/add/' + p.id;
            };

        });

        app.service('petService', function($http) {
            this.getPetList = function(type_id) {
                if (type_id) {
                    return $http.get('/api/pet/' + type_id);
                }
                return $http.get('/api/pet');
            };

            this.getTypeList = function() {
                return $http.get('/api/type');
            }
            this.searchPet = function(query) {
                return $http({
                    url: '/api/pet/search',
                    method: 'post',
                    data: {
                        'search_query': query
                    },
                });
            }
        });
    </script>
@endsection
