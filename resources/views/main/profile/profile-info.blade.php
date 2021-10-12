{!! Form::open(array('route' => $route,'method'=>'POST','class'=>'form-profile-account','id'=>'form-profile','role'=>'form','enctype'=>'multipart/form-data')) !!}
    <div class="form-group col-md-3 {{ $errors->has('username') ? ' has-error' : '' }}">
        <label for="">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="{{ $model->username }}" >
        @if ($errors->has('username'))
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-md-3 {{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $model->email }}" >
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-md-3 {{ $errors->has('phone') ? ' has-error' : '' }}">
        <label for="">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ $model->phone }}" >
        @if ($errors->has('phone'))
            <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>
     <div class="form-group col-md-3 {{ $errors->has('mobile') ? ' has-error' : '' }}">
        <label for="">Mobile</label>
        <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $model->mobile }}" >
        @if ($errors->has('mobile'))
            <span class="help-block">
                <strong>{{ $errors->first('mobile') }}</strong>
            </span>
        @endif
    </div>
    <div class='clearfix'></div>
    <div class="form-group col-md-3 {{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="">Password</label>
        <input type="password" class="form-control" id="password" name="password" value="" >
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-md-3 {{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="">First Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $model->first_name }}" >
    </div>
    <div class="form-group col-md-3">
        <label for="">Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $model->last_name }}" >
    </div>
     <div class="form-group col-md-3">
        <label for="">Gender</label>
        <select id="gender" name="gender" class="select2 form-control">
            <option selected disabled>-- Choose Gender --</option>
            <option value="1" {{ (int)$model->gender == 1 ? 'selected' : null }}>Male</option>
            <option value="2" {{ (int)$model->gender == 2 ? 'selected' : null }}>Female</option>
        </select>
    </div>
    <div class='clearfix'></div>
    <div class="form-group col-md-3">
        <label for="">Postal Code</label>
        <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $model->postal_code }}" >
    </div>
    <div class="form-group col-md-3">
        <label for="">Fax Number</label>
        <input type="text" class="form-control" id="fax_number" name="fax_number" value="{{ $model->fax_number }}" >
    </div>
    <div class="form-group col-md-3">
        <label for="">Birth Place</label>
        <input type="text" class="form-control" id="birth_place" name="birth_place" value="{{ $model->birth_place }}" >
    </div>
    <div class="form-group col-md-3">
        <label for="">Birth Date</label>
        <input type="text" class="form-control input-datepicker" id="birth_date" name="birth_date" value="{{ $model->birth_date }}" >
    </div>
    <div class='clearfix'></div>
    <div class="form-group col-md-6">
        <label for="">Street Address</label>
        <textarea class="form-control" rows="7" id="address" name="address">{{ $model->address }}</textarea>
    </div>
{!! Form::close() !!}