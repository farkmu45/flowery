@extends('layouts.admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Add Flower</h4>
              <div class="row">
                <div class="col-md-6">
                  <div class="card mb-4">
                    <h5 class="card-header">New Flower</h5>
                    <form action="{{ route('flower.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleInputFlowerName" class="form-label">Flower Name</label>
                                <input
                                type="text"
                                class="form-control  @error('flower_name') is invalid @enderror"
                                id="exampleInputFlowerName"
                                placeholder="Flower name"
                                name="flower_name"
                                value="{{old('flower_name')}}"/>
                                @error('flower_name') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPic" class="form-label">Picture</label>
                                <input 
                                class="form-control @error('picture') is invalid @enderror" 
                                type="file" 
                                id="exampleInputPic" 
                                placeholder="Picture" 
                                name="picture"  
                                value="{{old('picture')}}" />
                                @error('picture') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                            <label class="form-label" for="exampleInputCharacter">Characteristic</label>
                            <textarea
                                id="exampleInputCharacter"
                                class="form-control  @error('character') is invalid @enderror"
                                placeholder="Characteristics of flower"
                                name="character"
                                value="{{old('character')}}"></textarea>
                                @error('character') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                            <label class="form-label" for="exampleInputMeaning">Meaning of Flowers</label>
                            <textarea
                                id="exampleInputMeaning"
                                class="form-control  @error('meaning') is invalid @enderror"
                                placeholder="Meanings of flower"
                                name="meaning"
                                value="{{old('meaning')}}"></textarea>
                                @error('meaning') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                            <label class="form-label" for="exampleInputDetails">Details</label>
                            <textarea
                                id="exampleInputDetails"
                                class="form-control  @error('details') is invalid @enderror"
                                placeholder="Flower Details"
                                name="details"
                                value="{{old('details')}}"></textarea>
                                @error('details') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ route('flower.index')}}" class="btn btn-default">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form> 
                  </div>
                </div>
            </div>
</div>

@stop