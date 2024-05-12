<div>
    <a href="{{ route('/') }}">
        <i class="fa fa-close" style="font-size:48px;color:red;display: inline-flex; align-items: center;"></i>
        <span aria-hidden="true">&times;</span>
    </a>


    <div class="col-lg-6 col-md-6 col-sm-12 form-group ">

        <div class="col-lg-6 col-md-6 col-sm-12 form-group ">
            <label> {{ trans('website/appointments.doctor_name') }}</label>
            <select id="doctor_id" class="form-select" wire:model="doctor_id" wire:change="get_section">
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">
                        {{ $doctor->name }}</option>
                @endforeach
            </select>
            @error('doctor_id')
                <span class="alert alert-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-lg-6 col-md-6 col-sm-12 form-group ">
            <label>{{ trans('website/appointments.section') }}</label>
            <input id ="section_id" class="form-control" wire:model="section_id" type="text" readonly>
            @error('section_id')
                <span class="alert alert-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="card-body">
        @if (isset($id))
            <table class="table" id="appointments">
                <thead>
                    <tr>
                        <th>الايام</th>
                        <th>من الساعة</th>
                        <th>الي الساعة</th>
                    </tr>
                </thead>
                <tbody>
                    <td>السبت</td>
                    <td>{{ $id->day_start['1'] }}</td>
                    <td>{{ $id->day_end['1'] }}</td>

                </tbody>
                <tbody>
                    <td>الاحد</td>
                    <td>{{ $id->day_start['2'] }}</td>
                    <td>{{ $id->day_end['2'] }}</td>


                </tbody>
                <tbody>
                    <td>الاثنين</td>
                    <td>{{ $id->day_start['3'] }}</td>
                    <td>{{ $id->day_end['3'] }}</td>

                </tbody>
                <tbody>
                    <td>الثلاثاء</td>
                    <td>{{ $id->day_start['4'] }}</td>
                    <td>{{ $id->day_end['4'] }}</td>

                </tbody>
                <tbody>
                    <td>الاربعاء</td>
                    <td>{{ $id->day_start['5'] }}</td>
                    <td>{{ $id->day_end['5'] }}</td>

                </tbody>
                <tbody>
                    <td>الخميس</td>
                    <td>{{ $id->day_start['6'] }}</td>
                    <td>{{ $id->day_end['6'] }}</td>

                </tbody>
                <tbody>
                    <td>الجمعة</td>
                    <td>{{ $id->day_start['7'] }}</td>
                    <td>{{ $id->day_end['7'] }}</td>

                </tbody>
            </table>
        @endif

    </div>

</div>
