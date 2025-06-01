@extends('layouts.admin')

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold mb-4 py-3"><span class="text-muted fw-light">Forms /</span> Add Flower</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="card mb-4">
          <h5 class="card-header">New Flower</h5>
          <form action="{{ route('flower.update', $flower) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label" for="exampleInputFlowerName">Flower Name</label>
                <input class="form-control @error('flower_name') is invalid @enderror" id="exampleInputFlowerName"
                  name="flower_name" type="text" value="{{ $flower->flower_name ?? old('flower_name') }}"
                  placeholder="Flower name" />
                @error('flower_name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label" for="exampleInputPic">Picture</label>
                @if ($flower->picture)
                  <img class="img-preview img-fluid col-sm-5 d-block mb-3"
                    src="{{ Storage::disk('s3')->url($flower->picture) }}" alt="" style="width: 100px">
                @else
                @endif
                <input class="form-control @error('picture') is invalid @enderror" id="exampleInputPic" name="picture"
                  type="file" value="{{ $flower->picture ?? old('picture') }}" placeholder="Picture" />
                @error('picture')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label" for="exampleInputCharacter">Characteristic</label>
                <textarea class="form-control @error('character') is invalid @enderror" id="exampleInputCharacter" name="character"
                  placeholder="Characteristics of flower">{{ $flower->character ?? old('character') }}</textarea>
                @error('character')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label" for="exampleInputMeaning">Meaning of Flowers</label>
                <textarea class="form-control @error('meaning') is invalid @enderror" id="exampleInputMeaning" name="meaning"
                  placeholder="Meanings of flower">{{ $flower->meaning ?? old('meaning') }}</textarea>
                @error('meaning')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label" for="exampleInputDetails">Details</label>
                <textarea class="form-control @error('details') is invalid @enderror" id="exampleInputDetails" name="details"
                  placeholder="Flower Details">{{ $flower->details ?? old('details') }}</textarea>
                @error('details')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="card-footer">
                <button class="btn btn-primary" type="submit">Save</button>
                <a class="btn btn-default" href="{{ route('flower.index') }}">
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
