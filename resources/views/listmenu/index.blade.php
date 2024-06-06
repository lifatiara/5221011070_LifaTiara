@extends('layout.template')
        <!-- START DATA -->
        @section('konten')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
                <!-- FORM PENCARIAN -->
                <div class="pb-3">
                  <form class="d-flex" action="{{url('listmenu')}}" method="get">
                      <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                      <button class="btn btn-secondary" type="submit">Cari</button>
                  </form>
                </div>
                
                <!-- TOMBOL TAMBAH DATA -->
                <div class="pb-3">
                  <a href='{{url('listmenu/create')}}' class="btn btn-primary">+ Tambah Data</a>
                </div>
          
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-3">KODE</th>
                            <th class="col-md-4">HARGA</th>
                            <th class="col-md-2">NAMA</th>
                            <th class="col-md-2">EDIT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $data->firstItem()?>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$item->kode}}</td>
                            <td>{{$item->harga}}</td>
                            <td>{{$item->nama}}</td>
                            <td>
                                <a href='{{url('listmenu/'.$item->kode.'/edit')}}' class="btn btn-warning btn-sm">Edit</a>
                                <form onsubmit="return confirm('Yakin Hapus?')" class='d-inline' action="{{url('listmenu/'.$item->kode)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                                </form>
        
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>
                {{$data->withQueryString()->links()}}
               
          </div>
          <!-- AKHIR DATA -->
    @endsection
   