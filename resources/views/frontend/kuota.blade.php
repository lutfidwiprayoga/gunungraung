@extends('frontend.layout.template')
@section('title', 'Info Kuota - Booking Online Gunung Raung')

@section('content')
    <div class="gtco-services gtco-section">
        <div class="gtco-container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="info-kuota">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group" id="periode">
                                    <label class="form-control-label col-sm-2" for="input-first-name">Bulan &
                                        Tahun</label>
                                    <div class="col-sm-10">
                                        <select name="periode_id" class="form-control" id="periode_id">
                                            <option value="" selected>-</option>
                                            @foreach ($periode as $data)
                                                <option value="{{ $data->id }}">{{ $data->bulan }}</option>
                                            @endforeach
                                        </select>
                                        <div class="text-danger">
                                            @error('periode_id')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id="tabel-kuota">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col" class="text-center">Tanggal Pendakian</th>
                                                    <th scope="col" class="text-center">Kuota Pendakian</th>
                                                </tr>
                                            </thead>
                                            <tbody id="kuota_id">
                                                @foreach ($kuota as $item)
                                                    <form action="{{ route('booking.create') }}" method="GET">
                                                        <tr class="alt">
                                                            <td class="text-center">
                                                                {{ date('l, d F Y', strtotime($item->tanggal_pendakian)) }}
                                                            </td>
                                                            <input type="text" name="id" value="{{ $item->id }}" hidden>
                                                            <input type="date" name="tanggal_id"
                                                                value="{{ $item->tanggal_pendakian }}" hidden>
                                                            <td class="text-center">
                                                                <button type="submit"
                                                                    class="btn btn-link btn-md">{{ $item->kuota }}</button>
                                                            </td>
                                                        </tr>
                                                    </form>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kuota -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#periode_id').on('change', function(e) {
                var id = e.target.value;
                $.get('{{ url('infokuota') }}/' + id, function(data) {
                    console.log(id);
                    console.log(data);
                    if (data) {
                        $('#kuota_id').empty();
                        $.each(data, function(index, element) {
                            $('#kuota_id').append(
                                "<tr><td class='text-center'>" + moment(element
                                    .tanggal_pendakian).format('dddd, D MMMM YYYY') +
                                "</td><td class='text-center'><button type='submit' class='btn btn-link btn-md'>" +
                                element.kuota +
                                "</button></td><input type='text' name='id' value=" +
                                element
                                .id +
                                " hidden><input type='date' name='tanggal_id' value=" +
                                element.tanggal_pendakian + " hidden></tr>");
                        });
                    } else {
                        $('#kuota_id').empty();
                    }
                });
            });
        });
    </script>
@endsection
