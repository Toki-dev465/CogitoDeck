<x-layout>

<form action="/login" method="POST">
    @csrf

<fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 mx-auto">
  <legend class="fieldset-legend">login</legend>

  

  <label class="label">Email</label>
  <input type="email" name = "email" class="input" placeholder="Email" required />
  
  @error('email')
  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
  @enderror 

  <label class="label">Password</label>
  <input type="password" name = "password" class="input" placeholder="Password" required/>
        @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror




  <button class="btn btn-neutral mt-4">login</button>
</fieldset>
</form> 

</x-layout>