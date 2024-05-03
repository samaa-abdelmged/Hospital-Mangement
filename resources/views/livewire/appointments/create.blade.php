<div>

    @if (session()->has('alert'))
        <div class="alert alert-success">
            {{ session()->get('alert') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif


    <form wire:submit.prevent="store">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12 form-group ">
                <input type="text" name="name" wire:model="name" id="name"
                    placeholder={{ trans('website/appointments.name') }}>
                @error('name')
                    <span class="alert alert-danger">{{ $message }}</span>
                @enderror
                <span class="icon fa fa-envelope"></span>
            </div>


            <div class="col-lg-6 col-md-6 col-sm-12 form-group ">
                <input type="email" id="email" name="email" wire:model="email"
                    placeholder={{ trans('website/appointments.email') }}>
                @error('email')
                    <span class="alert alert-danger">{{ $message }}</span>
                @enderror
                <span class="icon fa fa-envelope"></span>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 form-group ">
                <label>{{ trans('website/appointments.section') }}</label>
                <input id ="section_id" class="form-control" wire:model="section_id" type="text" readonly>
                @error('section_id')
                    <span class="alert alert-danger">{{ $message }}</span>
                @enderror
            </div>

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


            <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                <input type="tel" name="phone" wire:model="phone"
                    id="phone"placeholder={{ trans('website/appointments.phone') }}>
                @error('phone')
                    <span class="alert alert-danger">{{ $message }}</span>
                @enderror
                <span class="icon fas fa-phone "></span>
            </div>

            <div class="col-lg-12 col-md-6 col-sm-12 form-group ">
                <label for="exampleFormControlSelect1"> {{ trans('website/appointments.date') }}</label>
                <input id="appointment_patient" type="date" name="appointment_patient"
                    wire:model="appointment_patient" class="form-control">
                @error('appointment_patient')
                    <span class="alert alert-danger">{{ $message }}</span>
                @enderror
            </div>


            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <textarea name="notes" wire:model="notes" placeholder={{ trans('website/appointments.notes') }}></textarea>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <button class="theme-btn btn-style-two" type="submit" name="submit-form">
                    <span class="txt">{{ trans('website/appointments.save') }}</span></button>
            </div>
        </div>
    </form>
</div>
